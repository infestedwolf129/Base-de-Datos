import pyodbc
import pandas as pd
from datetime import datetime

#Se realiza la conexion a la base de datos
conx_string = 'DRIVER={SQL Server};SERVER=localhost\SQLEXPRESS;DATABASE=Spot_USM;Trusted_Connection=yes;'
conx = pyodbc.connect(conx_string)
#Se genera un cursor con el cual interactuar en la base de datos
cursor = conx.cursor()

#Se lee el csv y se guarda en una lista
data = pd.read_csv ("song.csv")
Lista_valores=data.values.tolist()

#Se guarda la fecha actual en una variable
cursor.execute('''SELECT CAST( GETDATE() AS Date )''')
fecha = cursor.fetchone()
fecha = fecha[0]

#se crea la tabla para el repertorion de la musica del csv
if not cursor.tables(tableType = 'TABLE',table='repositorio_musica').fetchone():
    cursor.execute('''
            CREATE TABLE repositorio_musica (
                id int IDENTITY(1,1) PRIMARY KEY,
                position int,
                artist_name nvarchar(50),
                song_name nvarchar(100),
                days int,
                top_10 int,
                peak_position int,
                peak_position_time nvarchar(50),
                peak_streams int,
                total_streams int
                )
                ''')

    #se suben los datos del csv a la base de datos
    print("Cargando datos a la base de datos...")
    for row in Lista_valores:
        actual=row[0].strip().split(";")
        
        cursor.execute('''
                    INSERT INTO Spot_USM.dbo.repositorio_musica (position, artist_name, song_name, days, top_10, peak_position, peak_position_time, peak_streams, total_streams)
                    VALUES (?,?,?,?,?,?,?,?,?)
                    ''',
                    actual[0],
                    actual[1],
                    actual[2],
                    actual[3],
                    actual[4],
                    actual[5],
                    actual[6],
                    actual[7],
                    actual[8])
    

#Creamos tabla de reproduccion
if not cursor.tables(tableType = 'TABLE',table='reproduccion').fetchone():
    print("Creando tablas de reproduccion...")
    table= '''
        CREATE TABLE reproduccion(
            id int PRIMARY KEY,
            song_name nvarchar(100),
            artist_name nvarchar(50),
            fecha_reproduccion DATE,
            cant_reproduccion int,
            favorito bit,
        );
    '''
    cursor.execute(table)
else:
    print("Cargando tablas de reproduccion...")

#Creamos tabla de lista_favoritos
if not cursor.tables(tableType = 'TABLE',table='lista_favoritos').fetchone():
    print("Creando tablas de favoritos...")
    table= '''
        CREATE TABLE lista_favoritos(
            id int PRIMARY KEY,
            song_name nvarchar(100),
            artist_name nvarchar(50),
            fecha_agregada DATE,
        );
    '''
    cursor.execute(table)
else:
    print("Cargando tablas de favoritos...")





#Revisamos si existe la vista de reproduccion
cursor.execute('''SELECT * FROM information_schema.views WHERE table_name = 'Data Reproduccion'; ''') 
if cursor.fetchone() is None:
    #Creamos vista de reproduccion
    print("Creando vistas...")
    cursor.execute('''CREATE VIEW [Data Reproduccion] AS SELECT *
                                    FROM Spot_USM.dbo.reproduccion
                                    ''')
else:
    print("Cargando vistas...")

#Revisamos si existe la funcion de obtener_valores_tabla_favoritos
cursor.execute('''SELECT * FROM information_schema.routines WHERE routine_name = 'obtener_valores_tabla_favoritos' AND routine_type = 'FUNCTION';''')
if cursor.fetchone() is None:
    #Creamos una funcion para mostrar por consola python las canciones favoritas
    print("Creando funciones...\n")
    cursor.execute('''
        CREATE FUNCTION obtener_valores_tabla_favoritos ()
        RETURNS @favoritos TABLE (id int PRIMARY KEY, song_name nvarchar(50), artist_name nvarchar(50), fecha_agregada DATE)
        AS
        BEGIN
            INSERT INTO @favoritos (id, song_name, artist_name, fecha_agregada)
            SELECT id, song_name, artist_name, fecha_agregada FROM lista_favoritos
            RETURN 
        END
    ''')
else:
    print("Cargando funciones...")

print("Carga exitosa\n")

#Iniciamos valor de decision para el menu en uno que no afecte a su funcionamiento
decision = -1

#Menu de opciones
print("Bienvenido a la interfaz")
while(decision != 12):
    print("\nQue desea hacer?")
    print("1.- Mostrar reproduccion")
    print("2.- Mostrar canciones favoritas")
    print("3.- Hacer favorita una cancion")
    print("4.- Sacar cancion de favoritos")
    print("5.- Reproducir una cancion")
    print("6.- Buscar cancion en tabla reproduccion")
    print("7.- Mostrar canciones canciones reproducidas por primera vez")
    print("8.- Buscar canciones por titulo y artista")
    print("9.- Top 15 artistas con mas canciones en el top 10")
    print("10.- Peak posicion de un artista")
    print("11.- Promedio de streams de un artista")
    print("12.- Salir")

    user = input("ingrese el numero de la opcion deseada: ")
    print("")
    if user.isdigit() == False:
        print("Opcion invalida\n")
    else:
        decision = int(user)
        
        #Mostrar todas las canciones en tabla reproduccion ordenadas por cantidad de reproducciones o por fecha de reproduccion
        if decision == 1:
            print("MOSTRAR REPRODUCCIONES : ")
            print("1.- Mostrar reproduccion ordenada por cantidad de reproducciones")
            print("2.- Mostrar reproduccion ordenada por fecha de reproduccion\n")
            sub_decision = input("ingrese el numero de la opcion deseada: ")
            print("")

            #Se muestran las canciones de la tabla de reproduccion ordenadas por cantidad de reproducciones
            if (sub_decision == '1'):
                cursor.execute('''SELECT *
                                FROM [Data Reproduccion]
                                ORDER BY cant_reproduccion DESC
                                ''')
                
            #Se muestran las canciones de la tabla de reproduccion ordenadas por fecha de reproduccion
            elif (sub_decision == '2'):
                cursor.execute('''SELECT *
                                FROM [Data Reproduccion]
                                ORDER BY fecha_reproduccion DESC
                                ''')
            
            for row in cursor.fetchall():
                print(row[1]+ " - "+ row[2] + " | Agregada el " + row[3] +" | Total de reproducciones: " + str(row[4]) + " | Favorita?: " + str(row[5]))

        #Se muestran las canciones de la tabla de favoritos
        elif decision== 2:
            print("MOSTRAR CANCIONES FAVORITAS")
            cursor.execute('''SELECT * FROM dbo.obtener_valores_tabla_favoritos() ''')
            resultados = cursor.fetchall()

            if (len(resultados) >= 1):
                for row in resultados:
                    print(row[1]+ " - "+ row[2] + " | Agregada el " + row[3])
        
            else:
                print("Actualmente no tienes canciones favoritas")

        #Se agrega la cancion deseada a la tabla de favoritos
        elif decision== 3:
            print("HACER FAVORITA UNA CANCION")
            busqueda = input("Ingrese el nombre de la cancion: ")
            cursor.execute(f'''SELECT * FROM Spot_USM.dbo.repositorio_musica WHERE song_name LIKE '%{busqueda}%' ''') 
            resultados = cursor.fetchall()

            #Se analiza el caso en que exista mas de una cancion con el nombre ingresado
            if (len(resultados) > 1):
                print("Se encontraron varias canciones con ese nombre o uno parecido, por favor seleccione una de las siguientes opciones: ")
                for i in range(len(resultados)):
                    print(f"{i+1}. {resultados[i][3]} {'-'} {resultados[i][2]}")
                
                opcion = int(input("\nIngrese el numero de la opcion que desea: "))
                busqueda = resultados[opcion-1]

                #Comprobamos que la cancion no este ya en la tabla de favoritos
                comprobacion = cursor.execute(f'''SELECT id FROM Spot_USM.dbo.lista_favoritos''')
                for row in comprobacion:

                    #Si la cancion ya esta en favoritos, se muestra un mensaje
                    if row[0] == busqueda[0]:
                        print("La cancion ya esta agregada a tus favoritos")
                        comprobacion = 1
                        break

                    #Si la cancion no esta en favoritos, se agrega a la tabla
                    if comprobacion != 1:
                        print("Se ha agregado a favoritos: " + busqueda[3] + " de " + busqueda[2])
                        cursor.execute('''INSERT INTO Spot_USM.dbo.lista_favoritos (id, song_name, artist_name, fecha_agregada)
                        VALUES (?,?,?,?)
                        ''',
                        busqueda[0],
                        busqueda[3],
                        busqueda[2],
                        fecha,)
                        break

            #Se analiza el caso en que solo exista una cancion con el nombre ingresado
            elif (len(resultados) == 1):
                    cursor.execute(f'''SELECT id FROM Spot_USM.dbo.lista_favoritos''')
                    #Se comprueba que la cancion no este ya en la tabla de favoritos
                    comprobacion = cursor.fetchall()
                    for row in comprobacion:
                        if row[0] == resultados[0][0]:
                            print("La cancion ya esta agregada a tus favoritos")
                            comprobacion = 1
                            break
                    #Si la cancion no esta en favoritos, se agrega a la tabla
                    if comprobacion != 1:  
                        print("Se ha agregado a favoritos: " + resultados[0][3] + " de " + resultados[0][2])
                        cursor.execute('''INSERT INTO Spot_USM.dbo.lista_favoritos (id, song_name, artist_name, fecha_agregada)
                        VALUES (?,?,?,?)
                        ''',
                        resultados[0][0],
                        resultados[0][3],
                        resultados[0][2],
                        fecha,)

            else:
                print("Cancion no encontrada")

        #Se elimina una canicion de la tabla de favoritos
        elif decision== 4:
            print("SACAR CANCION DE FAVORITOS")
            busqueda = input("Ingrese el nombre de la cancion: ")
            cursor.execute(f'''SELECT * FROM Spot_USM.dbo.lista_favoritos WHERE song_name LIKE '%{busqueda}%' ''') 
            resultados = cursor.fetchall()

            #Se analiza el caso en que exista mas de una cancion con el nombre ingresado
            if (len(resultados) > 1):
                print("Se encontraron varias canciones con ese nombre o uno parecido, por favor seleccione una de las siguientes opciones: ")
                for i in range(len(resultados)):
                    print(f"{i+1}. {resultados[i][1]} {'-'} {resultados[i][2]}")

                opcion = int(input("\nIngrese el numero de la opcion que desea: "))
                busqueda = resultados[opcion-1]
                print("Se ha eliminado de favoritos: " + busqueda[1] + " de " + busqueda[2])
                SongID = int(busqueda[0])

                cursor.execute(f'''
                    DELETE FROM Spot_USM.dbo.lista_favoritos 
                    WHERE id = {SongID}
                ''')
            
            #Se analiza el caso en que solo exista una cancion con el nombre ingresado
            elif (len(resultados) == 1):
                print("Se ha eliminado de favoritos: " + resultados[0][1] + " de " + resultados[0][2])
                SongID =int(resultados[0][0])
                cursor.execute(f'''
                    DELETE FROM Spot_USM.dbo.lista_favoritos 
                    WHERE id = {SongID}
                ''')

            else:
                print("Cancion no encontrada")

        #Se simula la reproduccion de la cancion buscada
        elif decision== 5:
            print("REPRODUCIR UNA CANCION")
            busqueda = input("Ingrese el nombre de la cancion: ")
            cursor.execute(f'''SELECT * FROM Spot_USM.dbo.repositorio_musica WHERE song_name LIKE '%{busqueda}%' ''') 
            resultados = cursor.fetchall()
            
            #Se analiza el caso en que exista mas de una cancion con el nombre ingresado
            if (len(resultados) > 1):
                print("Se encontraron varias canciones con ese nombre o uno parecido, por favor seleccione una de las siguientes opciones: \n")
                for i in range(len(resultados)):
                    print(f"{i+1}. {resultados[i][3]} {'-'} {resultados[i][2]}")
                
                print("")
                opcion = int(input("Ingrese el numero de la opcion que desea: "))
                busqueda = resultados[opcion-1]
                print("Se reproducira la cancion: " + busqueda[3] + " de " + busqueda[2])

                #Se busca si la cancion esta en la tabla de favoritos
                favorito= -1
                favoritos = cursor.execute(f'''SELECT id FROM Spot_USM.dbo.lista_favoritos ''')
                for row in favoritos:
                    if (busqueda[0] == row[0]):
                        favorito = 1
                        break
                    else:
                        favorito = 0
                
                #Se busca verificar si la cancion esta agregada en la tabla de reproducciones
                verificar = cursor.execute(f'''SELECT id FROM Spot_USM.dbo.reproduccion ''')
                for row in verificar:
                    if (busqueda[0] == row[0]):
                        verificar = 1
                        break
                    else:
                        verificar = 0

                
                #Se actualiza la tabla de reproducciones en caso de estar agregada
                if (verificar == 1):
                    cursor.execute(f'''
                        UPDATE Spot_USM.dbo.reproduccion
                        SET cant_reproduccion = cant_reproduccion + 1
                        WHERE id = {busqueda[0]}
                    ''')
                #Caso contrario se agrega a la tabla de reproducciones
                else:
                    cursor.execute('''INSERT INTO Spot_USM.dbo.reproduccion (id, song_name, artist_name, fecha_reproduccion, cant_reproduccion, favorito)
                    VALUES (?,?,?,?,?,?)
                    ''',
                    busqueda[0],
                    busqueda[3],
                    busqueda[2],
                    fecha,
                    1,
                    favorito)
            
            #Se analiza el caso en que solo exista una cancion con el nombre ingresado
            elif (len(resultados) == 1):
                print("Se reproducira la cancion: " + resultados[0][3] + " de " + resultados[0][2])
                #Se busca si la cancion esta en la tabla de favoritos
                favorito_1 = 0
                favorito = cursor.execute(f'''SELECT id FROM Spot_USM.dbo.lista_favoritos ''')
                for row in favorito:
                    if (resultados[0][0] == row[0]):
                        favorito_1 = 1
                        break
                    else:
                        favorito_1 = 0
                
                #Se busca verificar si la cancion esta agregada en la tabla de reproducciones
                verificar = cursor.execute(f'''SELECT id FROM Spot_USM.dbo.reproduccion ''')
                for row in verificar:
                    if (resultados[0][0] == row[0]):
                        verificar = 1
                        break
                    else:
                        verificar = 0

                
                #Se actualiza la tabla de reproducciones en caso de estar agregada
                if (verificar == 1):
                    cursor.execute(f'''
                        UPDATE Spot_USM.dbo.reproduccion
                        SET cant_reproduccion = cant_reproduccion + 1
                        WHERE id = {resultados[0][0]}
                    ''')
                #Caso contrario se agrega a la tabla de reproducciones
                else:
                    cursor.execute('INSERT INTO Spot_USM.dbo.reproduccion (id, song_name, artist_name, fecha_reproduccion, cant_reproduccion, favorito) VALUES (?,?,?,?,?,?)', resultados[0][0], resultados[0][3], resultados[0][2], fecha, 1, favorito_1)
            
            else:
                print("Cancion no encontrada")

        #Se busca una cancion en la tabla de reproduccion
        elif decision== 6:
            print("BUSCAR CANCION EN TABLA REPRODUCCION")

            busqueda = input("Ingrese el nombre de la cancion a buscar: ")
            cursor.execute(f'''SELECT * FROM Spot_USM.dbo.reproduccion WHERE song_name LIKE '%{busqueda}%' ''') 
            resultados = cursor.fetchall()

            #Se analiza el caso en que exista mas de una cancion con el nombre ingresado
            if (len(resultados) > 1):
                print("Se encontraron varias canciones con ese nombre o uno parecido: \n")
                for row in resultados:
                    print(row[1]+ " - "+ row[2] + " | agregada el " + row[3] +" | total de reproducciones: " + str(row[4]))

            #Se analiza el caso en que solo exista una cancion con el nombre ingresado
            elif (len(resultados) == 1):
                print("Cancion encontrada: \n")
                print(resultados[0][1]+ " - "+ resultados[0][2] + " | agregada el " + resultados[0][3] +" | total de reproducciones: " + str(resultados[0][4]))
            else:
                print("Cancion no encontrada")

        elif decision== 7:
            print("MOSTRAR CANCIONES REPRODUCIDAS POR PRIMERA VEZ DESDE UNA FECHA")
            fecha_input  = input("Ingrese la fecha en formato YYYY-MM-DD: ")

            #Convertimos el input en una fecha valida para buscar en la base de datos
            fecha_input = datetime.strptime(fecha_input, '%Y-%m-%d')

            cursor.execute(f'''SELECT * FROM Spot_USM.dbo.reproduccion WHERE fecha_reproduccion >= '{fecha_input}' ''')
            resultados = cursor.fetchall()

            
            if (len(resultados) > 0):
                print(f"Mostrando todas las canciones reproducidas por primera vez desde {fecha} hasta ahora: \n")
                for row in resultados:
                    print(row[1]+ " - "+ row[2] + " | agregada el " + row[3])
            else:
                print("No hay canciones reproducidas por primera vez desde esa fecha")


        elif decision== 8:
            print("BUSCAR CANCIONES POR ARTISTA O NOMBRE")
            #Se consulta a la tabla repositorio por artista o cancion, devolviendo todas las canciones del artista o todas las canciones con el nombre ingresado
            busqueda = input("Ingrese el nombre exacto del artista o la cancion : ")

            #Se busca en la tabla de repositorio por nombre de cancion
            cursor.execute(f'''SELECT * FROM Spot_USM.dbo.repositorio_musica WHERE song_name LIKE '{busqueda}%' ''')
            resultados_canciones= cursor.fetchall()
            
            #En caso de encontrar resultados en canciones se muestran todas las que contengan el nombre ingresado
            if resultados_canciones != []:
                print("\nArtistas que contienen " + busqueda + " en el titulo de la cancion:")
                for row in resultados_canciones:
                    print(row[2] + " | " + row[3]) 
            
            #Se busca en la tabla de repositorio por nombre de artista
            cursor.execute(f'''SELECT * FROM Spot_USM.dbo.repositorio_musica WHERE artist_name LIKE '{busqueda}%' ''')
            resultados_artistas = cursor.fetchall()

            #En caso de encontrar resultados en artistas se muestran todas las canciones de ese artista
            if resultados_artistas != []:
                print("\nCanciones de " + resultados_artistas[0][2] + ": ")
                for row in resultados_artistas:
                    print(row[3])

            #En caso de no encontrar resultados en canciones y artistas se muestra un mensaje de error
            if(resultados_canciones == [] and resultados_artistas == []):
                print("Cancion o artista no encontrado")
            
            



        elif decision== 9:
            print("TOP 15 ARTISTAS CON MAS CANCIONES EN EL TOP 10")
            artistas = []
            top_10 = []
            cursor.execute(f'''SELECT artist_name,top_10 FROM Spot_USM.dbo.repositorio_musica''')
            resultados = cursor.fetchall()

            #Se recorre la tabla de repositorio y se almacenan los artistas y sus canciones en el top 10
            for row in resultados:    
                if(row[1] >= 1):
                    if(row[0] in artistas):
                        indice = artistas.index(row[0])
                        top_10[indice] += row[1]
                    else:
                        artistas.append(row[0])
                        top_10.append(row[1])

            #Se muestran por pantalla los 15 artistas con mas canciones en el top 10
            for i in range(15):
                index = top_10.index(max(top_10))
                top_10.pop(index)
                print(f'{i+1}. '+artistas[index])
                artistas.pop(index)
               
                    

        #Se consulta a la tabla del repositorio por la posicion mas alta del artista, devolviendo solo 1 valor
        elif decision== 10:
            print("BUSCAR PEAK POSITION DE UN ARTISTA")
            busqueda = input("Ingrese el nombre del artista: ")
            cursor.execute(f'''SELECT MIN(peak_position) FROM Spot_USM.dbo.repositorio_musica WHERE artist_name = '{busqueda}' ''') 
            resultados = cursor.fetchone()

            #En caso de encontrar resultados se muestran por pantalla
            if (str(resultados[0]) != "None"):
                print("Su Peak position ha sido: " + str(resultados[0]))
            
            else:
                print("Artista no encontrado")

        elif decision== 11:
            print("BUSCAR PROMEDIO DE STREAMS DE UN ARTISTA")
            busqueda = input("Ingrese el nombre del artista a buscar: ")
            cursor.execute(f'''SELECT total_streams FROM Spot_USM.dbo.repositorio_musica WHERE artist_name = '{busqueda}' ''') 
            resultados = cursor.fetchall()

            #Se calcula el promedio de streams de todas las canciones del artista
            if (len(resultados) >= 1):
                contador = 0
                for row in resultados:
                    contador +=row[0]
                print("Su promedio de streams por cancion es de: " + str(int(contador/len(resultados))))

            else:
                print("Artista no encontrado") 


        elif decision== 12:
            print("SEE YOU NEX TIME\n")

        else:
            print("Opcion invalida")
            decision=-1

#Se ejecutan los cambios y cierra la conexion con la base de datos
conx.commit()
conx.close()
print("Conexion finalizada...")