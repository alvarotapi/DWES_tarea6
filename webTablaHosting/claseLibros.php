<?php
    /** 
    * Clase que gestiona la aplicación
    *
    * @author Álvaro Tapiador <alvarotapiador@gmail.com>
    * @version 1.0.0 Estable
    */
    class claseLibros {
        /** 
        * Función que se encarga de hacer la conexión con la base de datos
        *
        * @param string $servidor Nombre del servidor de la BD
        * @param string $bd Nombre de la BD
        * @param string $usuario Nombre del usuario de la BD
        * @param string $contrasenia Contraseña de la BD
        * @return string $pdo Variable de conexión con la BD
        * @return null En caso de error de conexión
        * @author Álvaro Tapiador <alvarotapiador@gmail.com>
        * @version 1.0.0 Estable
        */
        public function conexion($servidor, $bd, $usuario, $contrasenia){
            try {
                $cadenaConexion = "mysql:dbname=$bd;host=$servidor";
                $pdo = new PDO($cadenaConexion, $usuario, $contrasenia, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                return $pdo;
            }
            catch (PDOException $e) {
               return null;
            }
        }

        /** 
        * Función que ayuda a mostrar en el index.php los datos todos los autores y todos los libros
        *
        * @param string $pdo Variable de conexión con la BD
        * @return string Tabla que se imprimirá en pantalla
        * @return string Excepción capturada en caso de error.
        * @author Álvaro Tapiador <alvarotapiador@gmail.com>
        * @version 1.0.0 Estable
        */
        public function mostrarAutorLibros($pdo){
            try {                        
                $sql = "SELECT autor.id, nombre, apellidos, nacionalidad, libro.id, titulo, f_publicacion 
                    FROM autor JOIN libro ON autor.id = libro.id_autor";
                $resultado = $pdo->query($sql);

                if ($resultado->rowCount() > 0){
                    while ($fila = $resultado->fetchObject()){
                        echo "<tr>";
                        echo "<td>" . $fila->id . "</td>"
                        . "<td>" . $fila->nombre . "</td>"
                        . "<td>" . $fila->apellidos . "</td>"				
                        . "<td>" . $fila->nacionalidad . "</td>"		
                        . "<td>" . $fila->id . "</td>"	
                        . "<td>" . $fila->titulo . "</td>"
                        . "<td>" . $fila->f_publicacion . "</td>";
                        echo "</tr>";
                    }        
                }
                else echo "No se han cargado datos";
            }
            catch (PDOException $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }
        }

    }
?>