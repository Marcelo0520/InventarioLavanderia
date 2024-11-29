
## Sentencias SQL para ejecutar en la base de datos

Estas sentencias son para tener más claridad de las tablas de nuestra base de datos y como se relacionan


### Obtener todos los movimientos y su información 
<pre>
SELECT movimiento.fecha,
        movimiento.tipoMov,
        movimiento.cantidad,
        movimiento.tipoRopa,
        CONCAT(ubicacion.nombre,' - ',ubicacion.tipoArea,' - ',ubicacion.departamento,' en el piso ',ubicacion.nivelPiso) as "Ubicacion",
        concat('Movimiento hecho por: ',usuarios.username) as "Responsable"
FROM movimiento 
    INNER JOIN usuarios ON movimiento.usuario_id = usuarios.id INNER JOIN ubicacion ON movimiento.ubicacion_id = ubicacion.id
ORDER BY movimiento.fecha ASC
</pre>

### Obtener inventario por tipo de ropa y sus cantidades

<pre>SELECT 
    CONCAT(ubicacion.nombre, ' - ', ubicacion.tipoArea, ' - ', ubicacion.departamento) AS "Ubicacion",
    ropa.tipo AS "Tipo de ropa",
    ropa.cantidad AS "Cantidad Restante",
    CASE 
        WHEN ropa.estado = 1 THEN 'Limpia'
        WHEN ropa.estado = 0 THEN 'Sucia'
        ELSE 'Desconocido' -- Opcional, por si hay un valor no esperado
    END AS "Estado de la ropa"
FROM ubicacion
    INNER JOIN inventario ON ubicacion.id = inventario.ubicacion_id
    INNER JOIN ropa ON inventario.id = ropa.inventario_id;
</pre>
