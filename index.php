<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prueba PHP y Mysql 1002488964</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <div class='container'>
            <?php
//            error_reporting(E_ALL);
//            ini_set('display_errors', 1);

            echo "<hr/><strong>PHP_VERSION : " . PHP_VERSION . "</strong><br/>";

            echo "<a class='btn btn-defaut' href='http://localhost:8082/prueba_1002488964/'>PHP_VERSION 7.2 </a>";
            echo "<a class='btn btn-warning' href='http://localhost:8081/prueba_1002488964/'>PHP_VERSION 5.6.38 </a>";
            echo "<a class='btn btn-info' href='http://localhost:808/prueba_1002488964/'>PHP_VERSION 5.6.19 </a>";

            include_once("./conexion.php");
            ?>
            <?php
            $options = array(
                array("value" => "Ingeniero"),
                array("value" => "Analista"),
                array("value" => "Consultor")
            );

            $usuario = Usuarios(isset($_GET["id"]) ? $_GET["id"] : 0);
            if (empty($usuario) || !isset($usuario)) {
                $usuario = array("nombre" => "", "cedula" => "", "celular" => "", "fecha_nacimiento" => "", "cargo" => "Ingeniero");
            } else {
                $usuario = $usuario[0];
            }
            ?>
            <h2>Datos Usuarios</h2>
            <form action="procesos.php" method="POST" class="">
                <div class="form-group">
                    <label for="name">Nombre  :</label> 
                    <input name="nombre" id="name" required="required" class="form-control" value="<?php echo $usuario['nombre']; ?>">
                </div>
                <div class="form-group">
                    <label for="cedula">Cedula : </label>
                    <input   class="form-control" type="number" name="cedula" required="required" value="<?php echo $usuario['cedula']; ?>">
                </div>
                <div class="form-group">
                    <label for="celular">Celular : </label>
                    <input   class="form-control" type="number" id="celular" name="celular" required="required" value="<?php echo $usuario['celular']; ?>">
                </div>

                <div class="form-group">
                    <label for="date">Fecha Nacimiento : </label>
                    <input  class="form-control" id="date" type="date" name="fecha_nacimiento"  value="<?php echo $usuario['fecha_nacimiento']; ?>" required="required">
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo :</label>
                    <select id="cargo" name="cargo" class="form-control">
                        <?php foreach ($options as $key => $option) { ?>
                            <option value="<?php echo $option["value"]; ?>" <?php echo ($option['value'] == $usuario['cargo']) ? 'selected="selected"' : '' ?> >
                                <?php echo $option["value"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>


                <?php
                if (isset($_GET['id'])) {
                    echo '<input type="hidden" name="id"  value="' . $_GET["id"] . '">';
                }
                ?>

                <input type="submit"  class="btn btn-success" value="Guardar" />
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>

            <?php
            $array = Usuarios(0, true);

            echo "<div class='row'><h2>Usuarios Creados ( ". count($array).")<h2>
            
            <table class='table' >
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Cedula</th> 
                  <th>Fecha Nacimiento</th>
                  <th>Celular</th>
                  <th>Cargo</th>
                  <th>Creado</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                </tr>";
            if (!empty($array)) {

                foreach ($array as $key => $value) {
                    echo "<tr>
                            <td>{$key}</td>
                            <td>{$value['nombre']}</td>
                            <td>{$value['cedula']}</td> 
                            <td>{$value['fecha_nacimiento']}</td>
                            <td>{$value['celular']}</td>
                            <td>{$value['cargo']}</td>
                            <td>{$value['fecha_registro']}</td>
                            <td><a class='btn btn-success' href='index.php?id={$value['id']}'>Editar</a></td>
                            <td><a class='btn btn-danger' href='procesos.php?id={$value['id']}'>Eliminar</a></td>
                         </tr>";
                }
            } else {
                echo " <tr><td>No hay Usuarios</td><tr>";
            }

            echo "</table></div>";
            ?>
        </div>
    </body>
</html>