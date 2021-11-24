<!DOCTYPE html>
<?php
require 'funciones.php';
mysqli_set_charset($con, "utf8");
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Iker Méndez</title>
</head>

<body>
    <?php
    $dibujar = false;
    $checkTodas = false;
    $error = "";
    $errorPrecio = "";
    $catCheck = "";
    $countPrecioCambiado = "";
    if (isset($_POST['bajarPrecio']) || isset($_POST['subirPrecio'])) {
        $dibujar = true;
        $catCheck = $_POST['catCheckOculta'];

        if (empty($_POST['tema'])) {
            $errorPrecio = "Ningun tema seleccionado";
        } else {
            $porcentaje = $_POST['selectPorcentaje'];
            $arrTemas = $_POST['tema'];

            if (isset($_POST['bajarPrecio'])) {
                $porcentaje = (100 - $porcentaje) / 100;
            } else if (isset($_POST['subirPrecio'])) {
                $porcentaje = (100 + $porcentaje) / 100;
            }

            $cont = 0;
            foreach ($arrTemas as $tema) {
                $cursosCorrespondientes = getCursosByTema($tema);

                foreach ($cursosCorrespondientes as $curso) {
                    $newPrecio = $curso->precio * $porcentaje;
                    if ($newPrecio >= 9 && $newPrecio <= 150) {
                        changePrecio($curso->idcurso, $newPrecio);
                        $cont++;
                    }
                }
            }

            $countPrecioCambiado = $cont;
            $dibujar = false;
        }
    }




    if (isset($_POST['submitVerCursos'])) {
        if (empty($_POST['categoria'])) {
            $error = "Ninguna opcion seleccionada";
        } else {
            $catCheck = $_POST['categoria'];
            $dibujar = true;

            if ($catCheck == 'TODAS LAS CATEGORIAS') {
                $checkTodas = true;
            }
        }
    }

    $categorias = getCategorias();
    echo "<a href='./anulaciones.php'>ANULACIONES</a>";
    echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
    echo "<span style='color: red'><strong>$error</strong></span>";
    echo "<h3>Elija categoría de cursos</h3>";

    foreach ($categorias as $categoria) {
        $checked = "";
        if (!$checkTodas && $categoria->categoria == $catCheck) {
            $checked = "checked";
        }

        echo "<input type='radio' name='categoria' value='$categoria->categoria' $checked/>$categoria->categoria<br>";
    }

    $checked = "";
    if ($checkTodas) {
        $checked = "checked";
    }
    echo "<input type='radio' name='categoria' value='TODAS LAS CATEGORIAS' $checked/>TODAS LAS CATEGORIAS<br>";

    echo "<input type='submit' name='submitVerCursos' value='Ver cursos'/>";
    echo "</form>";

    if ($dibujar) {
        if ($checkTodas) {
            $temas = getTemas();
        } else {
            $temas = getTemas($catCheck);
        }

        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
        echo "<h3>Imparticiones de cursos de cateogorias " . strtoupper($catCheck) . "</h3>";
        echo "<span style='color: red'><strong>$errorPrecio</strong></span>";

        echo "<table>";
        echo "<tr>";
        echo "<th>SELECCIONAR</th>";
        echo "<th>TEMA</th>";
        echo "<th>CANTIDAD DE CURSOS</th>";
        echo "</tr>";

        foreach ($temas as $tema) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='tema[]' value='$tema->IDTEMA'/></td>";
            echo "<td>" . $tema->TEMA . "</td>";
            echo "<td>" . countCursosByTema($tema->IDTEMA) . " cursos</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<input type='submit' name='bajarPrecio' value='BAJAR PRECIO'/>";

        echo "<select name='selectPorcentaje'>";
        for ($i = 5; $i <= 50; $i += 5) {
            echo "<option value=$i>$i%</option>";
        }
        echo "</select>";

        echo "<input type='submit' name='subirPrecio' value='SUBIR PRECIO'/>";
        echo "<input type='hidden' name='catCheckOculta' value='$catCheck'/>";
        echo "</form>";
    } else {
        if (isset($_POST['bajarPrecio']) || isset($_POST['subirPrecio'])) {
            echo "<p>Se ha cambiado el precio de $countPrecioCambiado cursos</p>";
        }
    }
    ?>
</body>

</html>