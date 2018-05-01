<html>
    <head>
        <title>Publicador de Cursos</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <style>
            h1{
                text-align: center;
            }
            span{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>Agregar cursos</h1>
        <div class=" container">
            <form class="card border text-justify" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <span class="form-control">Seleccionar el archivo del nuevo curso</span><br>
                    <input type="file" name="curso"  accept=".xml" value="buscar"><br>
                    <input type="submit" class="btn btn-primary" name="submit" value="subir archivo">
                </div>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                //Verificar si el archivo se ha subido
                if (!is_uploaded_file($_FILES['curso']['tmp_name'])) {
                    echo "El archivo no se ha subido correctamente";
                } else {
                    $temp_name = $_FILES['curso']['tmp_name'];
                    $file = $_FILES['curso']['name'];
                    $location = "files/nuevos/";
                    $nombreCompleto = $location . $file;

                    if (is_file($nombreCompleto)) {
                        $idUnico = time();
                        $nombreFichero = $idUnico . "-" . $file;
                        move_uploaded_file($temp_name, $location . $nombreFichero);
                        echo "Archivo  $file subido correctamente<br><br>";
                        $simple = simplexml_load_file("$location/$nombreFichero");
                        echo "El xml se $nombreFichero se ha cargado exitosamente<br>";
                        echo '<a href="index.php">volver al inicio</a>';
                    } else {
                        move_uploaded_file($temp_name, $location . $file);
                        echo "Archivo  $file subido correctamente<br><br>";
                        $simple = simplexml_load_file("$location/$file");
                        echo "El xml $file se ha cargado exitosamente<br>";
                        echo '<a href="index.php">volver al inicio</a>';
                    }
                }
            }
            if (!isset($simple)) {
                echo '<a href="index.php">volver al inicio</a>';
            } else {
                //Guardar los datos del nuevo curso en variables
                $categoria = $simple->attributes()->categoria;
                $nombre = $simple->nombre;
                $duracion = $simple->duracion;
                $descripcion = $simple->descripcion;
                //Cargar el archivo de cursos general y agregarle los datos del nuevo
                $cursos = simplexml_load_file("files/cursos.xml");
                $curso = $cursos->addChild("curso");
                $curso->addAttribute("categoria", $categoria);
                $curso->addChild("nombre", $nombre);
                $curso->addChild("duracion", $duracion);
                $curso->addChild("descripcion", $descripcion);
                $cursos->asXML("files/cursos.xml");
            }
            ?>
        </div>
    </body>
</html>