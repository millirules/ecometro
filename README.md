Proyecto Ecometro

Symfony 6.2

Api de CRUD de Materiales
Esquema de la base de datos en /public/data/

Arrancar el proyecto: symfony serve
Datos de prueba: php bin/console doctrine:fixtures:load

Llamadas API:
- Obtener todos los materiales: GET http://localhost:8000/api/materials
- Obtener todos los materiales filtrando por nombre: GET http://localhost:8000/api/materials?name=name
- Obtener un material: GET http://localhost:8000/api/material/{material_id}
- Borrar un material: DELETE http://localhost:8000/api/material/{material_id}
- Crear un material: POST http://localhost:8000/api/materials
      params: {
        "name": "el nombre",
        "cost": 23,
        "supplier_id": 13,
        "material_type_id": 32,
        "metric_id": 26
      }
- Actualizar un material: PUT/PATCH http://localhost:8000/api/materials/{material_id}
      params: {
        "name": "el nombre",
        "cost": 23,
        "supplier_id": 13,
        "material_type_id": 32,
        "metric_id": 26
      }
  
TODO:
Ampliar Test Unitarios al resto de Repositorios
Resolver problema Proxy en las relaciones ManyToMany
Agregar mas filtros posibles

