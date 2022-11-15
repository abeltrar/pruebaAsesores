La aplicación está desarrollada en el back con PHP y front con Angula.js
TENER EN CUENTA: El front en Angular se encuentra en la carpeta Cafeteria.

Tener en cuenta para realizar pruebas a la API.

Para obtener todos los datos en GET: 
RUTA; http://localhost/AppCafeteria/productos?page=1

Para realizar un UPDATE;

- Ruta: http://localhost/AppCafeteria/productos

Body; 
 "Nombre": "Empanada",
     "Referencia":"AS1321",
     "Precio": 1300,
     "Peso":1,
     "IdCategoria":1,
     "Stock":20,
     "FechaCreacion":"2022-11-02"

- Para insertar: 
Ruta: http://localhost/AppCafeteria/productos

Body:
 "Nombre": "XXX",
     "Referencia":"AS1321",
     "Precio": 1300,
     "Peso":1,
     "IdCategoria":1,
     "Stock":20,
     "FechaCreacion":"2022-11-02"

- Para eliminar
Body;
{
 
 "IDProducto": 1,
  "Stock":21
      
}


Las rutas se probaron de manera local, de ser necesario configurar el puerto del local en el archivo de la API: config
