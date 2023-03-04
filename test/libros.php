<?php
    /** 
    * Clase que gestiona la aplicación
    *
    * @author Álvaro Tapiador <alvarotapiador@gmail.com>
    * @version 1.0.0 Estable
    */
    class libros {
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
        * Función que consulta los autores presentes en la BD
        *
        * @param string $pdo Variable de conexión con la BD
        * @param string $id_autor ID del autor a consultar
        * @return object $fila Objeto con el autor encontrado
        * @return null En caso de error de conexión
        * @author Álvaro Tapiador <alvarotapiador@gmail.com>
        * @version 1.0.0 Estable
        */
        public function consultarAutores($pdo, $id_autor){
            try {
                    $sql = "SELECT * FROM autor WHERE id = '$id_autor'";
                    $resultado = $pdo->query($sql);

                    if ($resultado->rowCount() > 0) {
                        return $resultado->fetchObject();
                    }
                    else return null;
            }
            catch (PDOException $e) {
               return null;
            }
        }

        /** 
        * Función que consulta los libros presentes en la BD según el ID del autor
        *
        * @param string $pdo Variable de conexión con la BD
        * @param string $id_autor ID del autor a consultar para obtener los libros
        * @return array $array_libros Array con los libros encontrado
        * @return null En caso de error de conexión
        * @author Álvaro Tapiador <alvarotapiador@gmail.com>
        * @version 1.0.0 Estable
        */
        public function consultaLibros($pdo, $id_autor){
            try {
                    $sql = "SELECT * FROM libro WHERE id_autor = '$id_autor'";
                    $resultado = $pdo->query($sql);

                    if ($resultado->rowCount() > 0) {
                        $array_libros = array();

                        while ($fila = $resultado->fetchObject()) {
                            array_push($array_libros, $fila);
                        }
                        
                        return $array_libros;
                    }
                    else return null;
            }
            catch (PDOException $e) {
               return null;
            }
        }

        /** 
        * Función que consulta los datos de los libros presentes en la BD
        *
        * @param string $pdo Variable de conexión con la BD
        * @param string $id_libro ID del libro a consultar
        * @return object $fila Objeto con el libro encontrado
        * @return null En caso de error de conexión
        * @author Álvaro Tapiador <alvarotapiador@gmail.com>
        * @version 1.0.0 Estable
        */
        public function consultaDatosLibro($pdo, $id_libro){
            try {
                $sql = "SELECT * FROM libro WHERE id = '$id_libro'";
                $resultado = $pdo->query($sql);

                if ($resultado->rowCount() > 0) {
                    return $resultado->fetchObject();
                }
                else return null;
            }
            catch (PDOException $e) {
               return null;
            }
        }

        /** 
        * Función que borra un autor
        *
        * @param string $pdo Variable de conexión con la BD
        * @param string $id_autor ID del autor a borrar
        * @return true En caso de que el borrado sea exitoso
        * @return false En caso de que haya algún error al borrar
        * @return null En caso de error de conexión
        * @author Álvaro Tapiador <alvarotapiador@gmail.com>
        * @version 1.0.0 Estable
        */
        public function borrarAutor($pdo, $id_autor){
            try {                        
                $sql = "DELETE FROM autor WHERE id='$id_autor'";
                $resultado = $pdo->query($sql);
        
                if ($resultado->rowCount() != 0) {
                    return true;
                }
                else return false; 
            }
            catch (PDOException $e) {
                return null;
            }
        }

        /** 
        * Función que borra un libro
        *
        * @param string $pdo Variable de conexión con la BD
        * @param string $id_libro ID del libro a borrar
        * @return true En caso de que el borrado sea exitoso
        * @return false En caso de que haya algún error al borrar
        * @return null En caso de error de conexión
        * @author Álvaro Tapiador <alvarotapiador@gmail.com>
        * @version 1.0.0 Estable
        */
        public function borrarLibro($pdo, $id_libro){
            try {                        
                $sql = "DELETE FROM libro WHERE id='$id_libro'";
                $resultado = $pdo->query($sql);
        
                if ($resultado->rowCount() != 0) {
                    return true;
                }
                else return false; 
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