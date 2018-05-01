<!DOCTYPE html>
<html>
    <head>
        <title>App de Cursos</title>
        <link rel="stylesheet" href="files/styles.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
    </head>
    <body>
        <h1 class="display-2">CURSOS ACADEMIA</h1>
        <?php
        $cursos = simplexml_load_file("files/cursos.xml");
        ?>
        <div class="container-fluid">
            <nav>
                <ul>
                    <li><a href="incluir.php">Incluir Curso</a></li>
                    <li><a><strong>Categorías:</strong></a></li>
                    <?php
                    $errors= error_reporting(0);
                    $categorias = $cursos->xpath("//curso/@categoria");
                    $categorias = array_unique($categorias);
                    foreach ($categorias as $item) {
                        echo "<li><a href=?categ=$item>$item</a></li>";
                    }
                    ?>
                </ul>
            </nav>
            <div class="container-fluid card-group">
                <?php
//------------Cargar el documento de datos---------------
                $datos = new DOMDocument();
                $datos->load("files/cursos.xml");

//------------------cargar la plantilla xslt------------------
                $plantilla = new DOMDocument();
                $plantilla->load("files/plantillacurso_1.xsl");

                if (isset($_GET['categ'])) {

                    $variable = $_GET['categ'];

                    function categoria($variable = '') {
                        $variable = $_GET['categ'];
                        return $variable;
                    }

//--------------Crear el transformador XSLT----------------
                    $transformador = new XSLTProcessor();
                    $transformador->registerPHPFunctions();
                    $transformador->importStylesheet($plantilla);

//------------------------Generar Salida------------------------------

                    echo $transformador->transformToXml($datos);
                } else {
                    echo "<h3>Navegador de Cursos</h3>";
                }
                ?>
            </div>
        </div>
    </body>
</html>