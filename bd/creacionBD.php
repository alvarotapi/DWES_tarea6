<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Creación de la BD</title>
</head>
<body>
    <?php
        try {
            //Conexión con la BD
            $cadenaConexion = "mysql:host=localhost";
            $usuario = "alvaro";
            $clave = "alvaro1234";
            $bd = new PDO($cadenaConexion, $usuario, $clave, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            echo "Conexión establecida<br>";

            //Creación de la BD
            $sql = "CREATE DATABASE IF NOT EXISTS `libros` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;";
            
            if ($bd->query($sql)){
                echo "BD creada con éxito<br>";

                //Selección de la base de datos
                $bd->query("use libros");

                //Crear tabla 1
                $sql = "CREATE TABLE IF NOT EXISTS autor (
                    id INTEGER NOT NULL,
                    nombre VARCHAR(15),
                    apellidos VARCHAR(25),
                    nacionalidad VARCHAR(10),
                    PRIMARY KEY (id)
                )";

                if ($bd->query($sql)){
                    echo "Tabla 'Autor'creada correctamente<br>";

                    //Insertar datos iniciales
                    $sql1 = "INSERT INTO autor (id, nombre, apellidos, nacionalidad) VALUES ('0', 'J. R. R.','Tolkien','Inglaterra')";
                    $sql2 = "INSERT INTO autor (id, nombre, apellidos, nacionalidad) VALUES ('1', 'Isaac','Asimov','Rusia')";

                    if ($bd->query($sql1) && $bd->query($sql2)) {
                            echo "Inserción realizada con éxito<br>";
                    }
                    else echo "Error insertando datos";                 
                    
                }
                else echo "Error creando tabla 'Autor'";
            
                //Crear tabla 2
                $sql = "CREATE TABLE IF NOT EXISTS libro (
                    id INTEGER NOT NULL,
                    titulo VARCHAR(50),
                    f_publicacion DATE,
                    id_autor INTEGER,
                    PRIMARY KEY (id),
                    FOREIGN KEY (id_autor) REFERENCES autor(id) ON DELETE CASCADE
                )";
                        
                if ($bd->query($sql)){
                    echo "Tabla 'Libro' creada correctamente<br>";

                    //Insertar datos iniciales
                    $sql1 = "INSERT INTO libro (id, titulo, f_publicacion, id_autor) VALUES ('0', 'El Hobbit','1937-09-21','0')";
                    $sql2 = "INSERT INTO libro (id, titulo, f_publicacion, id_autor) VALUES ('1', 'La Comunidad del Anillo','1954-07-29','0')";
                    $sql3 = "INSERT INTO libro (id, titulo, f_publicacion, id_autor) VALUES ('2', 'Las dos torres','1954-11-11','0')";
                    $sql4 = "INSERT INTO libro (id, titulo, f_publicacion, id_autor) VALUES ('3', 'El retorno del Rey','1955-10-20','0')";
                    $sql5 = "INSERT INTO libro (id, titulo, f_publicacion, id_autor) VALUES ('4', 'Un guijarro en el cielo','1950-01-19','1')";
                    $sql6 = "INSERT INTO libro (id, titulo, f_publicacion, id_autor) VALUES ('5', 'Fundación','1951-06-01','1')";
                    $sql7 = "INSERT INTO libro (id, titulo, f_publicacion, id_autor) VALUES ('6', 'Yo, robot','1950-12-02','1')";

                    if ($bd->query($sql1) && $bd->query($sql2) && $bd->query($sql3) && $bd->query($sql4) && $bd->query($sql5) 
                        && $bd->query($sql6) && $bd->query($sql7)) {
                            echo "Inserción realizada con éxito<br>";
                    }
                    else echo "Error insertando datos";                 
                    
                }
                else echo "Error creando tabla 'Libro'";    
           
            } 
            
            else echo "Error creando base de datos";
        }
        
        catch (PDOException $e) {
		    echo 'Excepción capturada: ',  $e->getMessage();
	    };
    ?>
</body>
</html>