<?php
    //librosTest.php
    require_once('libros.php');
    use PHPUnit\Framework\TestCase;

    class librosTest extends TestCase {
        public function testConexionOK(){
            $o = new libros();

            $resultado = $o->conexion("localhost", "libros", "alvaro", "alvaro1234");

            $this->assertNotNull($resultado);
        }

        public function testConexionKO(){
            $o = new libros();

            $resultado = $o->conexion("localhost", "otr", "alvaro", "alvaro1234");

            $this->assertNull($resultado);
        }

        public function testConsultarAutores() {
            $esperado = new stdClass();
            $esperado->id = 1;
            $esperado->nombre = "Isaac";
            $esperado->apellidos = "Asimov";
            $esperado->nacionalidad = "Rusia";


            $o = new libros();
            $pdo = $o->conexion("localhost", "libros", "alvaro", "alvaro1234");
            $resultado = $o->consultarAutores($pdo, 1);
            $this->assertEquals($esperado, $resultado);
        }

        public function testConsultarLibros()
        {
        $obj = new stdClass();
        $obj->id=4;
        $obj->titulo="Un guijarro en el cielo";
        $obj->f_publicacion="1950-01-19";
        $obj->id_autor=1;
        $obj1 = new stdClass();
        $obj1->id=5;
        $obj1->titulo="Fundación";
        $obj1->f_publicacion="1951-06-01";
        $obj1->id_autor=1;
        $obj2 = new stdClass();
        $obj2->id=6;
        $obj2->titulo="Yo, robot";
        $obj2->f_publicacion="1950-12-02";
        $obj2->id_autor=1;
        $esperado = array($obj, $obj1, $obj2);

        $o = new libros();
        $pdo = $o->conexion("localhost", "libros", "alvaro", "alvaro1234");
        $resultado = $o->consultaLibros($pdo, 1);
        $this->assertEquals($esperado, $resultado);
        }

        public function testConsultarDatosLibro()
        {
        $esperado = new stdClass();
        $esperado->id = 1;
        $esperado->titulo = "La Comunidad del Anillo";
        $esperado->f_publicacion = "1954-07-29";
        $esperado->id_autor = 0;

        $o = new libros();
        $pdo = $o->conexion("localhost", "libros", "alvaro", "alvaro1234");
        $resultado = $o->consultaDatosLibro($pdo, 1);
        $this->assertEquals($esperado, $resultado);
        }

        public function testBorrarLibro()
        {
        $o = new libros();
        $pdo = $o->conexion("localhost", "libros", "alvaro", "alvaro1234");
        //Borrar libro 2
        $resultado = $o->borrarLibro($pdo, 3);
        $this->assertEquals(true, $resultado);
        //Comprobar que el libro 2 ya no está
        $resultado = $o->consultaDatosLibro($pdo, 3);
        $this->assertNull($resultado);
        }

        public function testBorrarAutor()
        {
        $o = new libros();
        $pdo = $o->conexion("localhost", "libros", "alvaro", "alvaro1234");
        //Borrar autor 2
        $resultado = $o->borrarAutor($pdo, 1);
        $this->assertEquals(true, $resultado);
        //Comprobar que el autor 2 ya no está
        $resultado = $o->consultarAutores($pdo, 1);
        $this->assertNull($resultado);
        //Comprobar que el autor 2 ya no tiene libros
        $resultado = $o->consultaLibros($pdo, 1);
        $this->assertNull($resultado);
        }
    }
?>