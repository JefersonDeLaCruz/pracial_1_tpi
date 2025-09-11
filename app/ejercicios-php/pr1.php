<?php
session_start();
//enunciado de practica, hacer un crud de estudiantes, mostrar en una tabla
//usadr array como fuente/almaces de datos


define("NOMBRE", "Nombre");
define("EDAD", "Edad");
define("NOTA", "Nota");
define("CARRERA", "Carrera");
define("ESTUDIANTES", "Estudiantes");

$carreras = ["Ingenieria de sistemas informaticos", "Psicologia", "Medicina"];

if (!isset($_SESSION[ESTUDIANTES])) {
    $_SESSION[ESTUDIANTES] = [
        [NOMBRE => "Juan", EDAD => 20, NOTA => 8.5, CARRERA => $carreras[0]], //primer estudiante por defecto
        [NOMBRE => "Maria", EDAD => 22, NOTA => 9.0, CARRERA => $carreras[1]], //segundo estudiante por defecto
        [NOMBRE => "Pedro", EDAD => 19, NOTA => 7.2, CARRERA => $carreras[2]], //tercer estudiante por defecto
    ];
}

$error = "";
$exito = "";
$promedio = 0.0;

if ($_POST && $_POST["form"] == "reg_form") {

    $name = trim($_POST["name"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $grade = trim($_POST["grade"] ?? "");
    $carrera = $_POST["carrera"] ?? "";


    if (!empty($name) && !empty($age) && !empty($grade)) {

        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $error = "Ingrese un nombre valido";
        } elseif (!ctype_digit($age)) {
            $error = "Ingrese una edad valida";
        } elseif (!is_numeric($grade) && $grade < 0 || $grade > 10) {

            $error = "Ingrese nota valida";
        } else {
            $_SESSION[ESTUDIANTES][] = [NOMBRE => $name, EDAD => $age, NOTA => $grade];
            $exito = "Estudiante registrado con exito";
        }
    } else {
        $error = "Debe llenar todos los campos";
    }
}

//operacion de eliminar

if ($_POST && $_POST["form"] == "del_form") {
    $index = $_POST["index"];

    if (isset($_SESSION[ESTUDIANTES][$index])) {
        //si existe
        //se elimina
        unset($_SESSION[ESTUDIANTES][$index]);
        //se reindexa el array
        array_values($_SESSION[ESTUDIANTES]);
        $exito = "Estudiante Eliminado con exito";
    } else {
        $error = "hubo un error al eliminar el estudiante";
    }
}

$item2edit = "";
//operacion editar
if ($_POST && $_POST["form"] == "edit_form") {

    $index = $_POST["index"];
    $item2edit = $_SESSION[ESTUDIANTES][$index] ?? "";
}

if ($_POST && $_POST["form"] == "update_form") {


    $name = trim($_POST["name"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $grade = trim($_POST["grade"] ?? "");
    $index = trim($_POST["index"] ?? "");
    $carrera = $_POST["carrera"] ?? "";



    if (!empty($name) && !empty($age) && !empty($grade)) {

        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $error = "Ingrese un nombre valido";
        } elseif (!ctype_digit($age)) {
            $error = "Ingrese una edad valida";
        } elseif (!is_numeric($grade) && $grade < 0 || $grade > 10) {

            $error = "Ingrese nota valida";
        } else {
            $_SESSION[ESTUDIANTES][$index] = [NOMBRE => $name, EDAD => $age, NOTA => $grade, CARRERA => $carrera];
            $exito = "Estudiante actualizado con exito";
        }
    } else {
        $error = "Debe llenar todos los campos";
    }
}

//operacion filtro
$filtro_seleccionado = "Todas";
if ($_POST && $_POST["form"] == "filter_form") {
    # code...
    $filtro_seleccionado = $_POST["carrera"] ?? "";
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Estudiantes</title>
    <link rel="stylesheet" href="./style_2.css">
</head>

<body>
    <h1 class="error"><?= $error ?></h1>
    <h1 class="exito"><?= $exito ?></h1>
    <div class="main-container">
        <div class="box">
            <h2>Formulario de registro</h2>
            <form action="" method="post">
                <input type="hidden" name="form" value="reg_form">
                <label for="">Nombre</label>
                <input type="text" name="name"><br>
                <label for="">Edad</label>
                <input type="text" name="age"><br>
                <label for="">Nota</label>
                <input type="text" name="grade"><br>
                <label for="">Seleccione carrera</label>
                <select name="carrera" id="">
                    <!-- <option value="Todas">Todas</option> -->
                    <?php foreach ($carreras as $item): ?>
                        <option value="<?= $item ?>"><?= $item ?></option>
                    <?php endforeach; ?>
                </select><br>
                <input type="submit" value="Registrar">
            </form>
        </div>
        <div class="box">
            <h2>Seleccione filtro</h2>
            <form action="" method="post">
                <input type="hidden" name="form" value="filter_form">
                <select name="carrera" id="">

                    <option value="Todas">Todas</option>
                    <?php foreach ($carreras as $item): ?>
                        <option value="<?= $item ?>"><?= $item ?></option>
                    <?php endforeach; ?>
                </select><br>
                <input type="submit" value="Aplicar">
            </form>
        </div>
        <div class="box">
            <table>
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Edad</td>
                        <td>Nota</td>
                        <td>Carrera</td>
                        <td>Accion</td>
                        <td>Accion</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION[ESTUDIANTES] as $index => $item): ?>
                        <?php if ($filtro_seleccionado == "Todas" || $filtro_seleccionado == $item[CARRERA]): ?>
                            <tr>
                                <td><?= $item[NOMBRE] ?></td>
                                <td><?= $item[EDAD] ?></td>
                                <td><?= $item[NOTA] ?></td>
                                <td><?= $item[CARRERA] ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="form" value="del_form">
                                        <input type="hidden" name="index" value=<?= $index ?>>
                                        <input type="submit" value="Eliminar">
                                    </form>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="form" value="edit_form">
                                        <input type="hidden" name="index" value="<?= $index ?>">
                                        <input type="submit" value="Editar">
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Promedio estudiantes</td>
                        <td>
                            <?php
                            $promedio = 0;
                            foreach ($_SESSION[ESTUDIANTES] as $item) {

                                $promedio += (float)$item[NOTA];
                            }

                            echo number_format($promedio / count($_SESSION[ESTUDIANTES]), 2);
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box">
            <h2>Formulario de edicion de registro</h2>
            <?php if ($item2edit != ""): ?>
                <form action="" method="post">
                    <input type="hidden" name="index" value=<?= $index ?>>
                    <input type="hidden" name="form" value="update_form">
                    <label for="">Nombre</label>
                    <input type="text" name="name" value="<?= $item2edit[NOMBRE] ?>"><br>
                    <label for="">Edad</label>
                    <input type="text" name="age" value="<?= $item2edit[EDAD] ?>"><br>
                    <label for="">Nota</label>
                    <input type="text" name="grade" value="<?= $item2edit[NOTA] ?>"><br>

                    <select name="carrera" id="">

                        <!-- <option value="Todas">Todas</option> -->
                        <?php foreach ($carreras as $item): ?>
                            <option value="<?= $item ?>" <?= ($item2edit[CARRERA] == $item) ? "selected" : "" ?>><?= $item ?></option>
                        <?php endforeach; ?>
                    </select><br>


                    <input type="submit" value="Actualizar">
                </form>
            <?php endif; ?>
        </div>
    </div>


</body>

</html>


<?php
//session_destroy();
?>