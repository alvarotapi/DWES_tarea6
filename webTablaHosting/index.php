<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea 6 - DWES</title>
    <style>
        div {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-49%, -49%);
        }
    
        table {
            font-family: "Courier New", Courier, monospace;
            border: 4px solid #000000;
            background-color: #3377ff;
            width: 400px;
            height: 240px;
            text-align: center;
        }

        table td, table th {
            border: 1px solid #FFFF3F;
            padding: 5px 10px;
        }

        table tbody td {
            font-size: 12px;
            font-weight: bold;
            color: #FFFF3F;
        }
        
        table td:nth-child(even) {
            background: #398AA4;
        }

        h2, h3 {
            font-family: "Courier New", Courier, monospace;
        }
    </style>
</head>
<body>
    <div>
        <h2>Tarea 6 - DWES</h2>
        <table>
            <tr>
                <th>ID Autor</th>	
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Nacionalidad</th>
                <th>ID Libro</th>
                <th>Título Libro</th>
                <th>Publicación</th>
            </tr>        
                <?php
                    include "claseLibros.php";
    
                    $libros = new claseLibros();
                    $pdo = $libros->conexion("sql104.byethost4.com", "b4_33087174_libros", "b4_33087174", "iNDEPENDIENT1");
    
                    echo $libros->mostrarAutorLibros($pdo);
                ?>
        </table>
        <h3>Álvaro Tapiador de la Torre</h3>
    </div>
</body>
</html>