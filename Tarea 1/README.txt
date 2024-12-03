Nombre 1 :José Manzano
Rol : 202173581-k

Nombre 2: Thomas Rodriguez
Rol : 202173593-3

Las librerías usadas fueron panda para el manejo del csv y la librería de datetime para transformar el input del usuario a datos de 
tipo date

Para que funcione correctamente hay que modificar el codigo y cambiar el nombre del servidor y la base de datos en la linea donde se
hace la conexion a SQL y reemplazarlo con los nombres que uno les haya puesto a su server y database respectivamente, ademas de 
dejar el archivo song.csv en el mismo directorio que el archivo T1.py

Una vez en el menu se verifica que el usuario haya elegido una de las opciones disponibles y en caso contrario se le volverá a preguntar

En las operaciones del menu donde pidan buscar una cancion y se encuentren más de un resultado se le mostrarán al usuario las canciones
que tengan nombre similar y se le dará la opción de elegir cual era la canción a la que se refería

Por ultimo para fines de buen funcionamiento del programa y que logre conectar con la base de datos en vez de usar "Spot-USM" usamos el nombre de "Spot_USM"
haciendo la diferencia en el guion ya que este nos generaba errores de conexion

versiones de librerias y sql server:

pyodbc 4.0.35
pandas 1.5.3
Microsoft SQL Server 2022 (RTM) - 16.0.1000.6 (X64)  Copyright (C) 2022 Microsoft Corporation  Express Edition (64-bit) on Windows 10 Pro 10.0 <X64> (Build 19045: ) 