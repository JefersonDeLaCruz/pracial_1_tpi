
<?php
    // $mensajeError = "";
    $temperatura = $_POST["temp"] ?? "";
    $operaciones = ["Celsius a Fahrenheit", "Fahrenheit a Celsius"];
    $operacion = $_POST["operacion"] ?? "";
    if(!empty($temperatura) && !empty($operacion)){
        if (is_numeric($temperatura)) {
            # code...
            if ($operacion == $operaciones[0]) {
                $result = $temperatura * 1.8 + 32;
                $mensaje = "{$temperatura} grados C equivalen a {$result} grados F";
            }elseif($operacion == $operaciones[1]){
                $result = ($temperatura - 32) / 1.8;
                $mensaje = "{$temperatura} grados F equivalen a {$result} grados C";
            }else{
                $mensaje = "Error durante la conversion";
            }

        }else{
            $mensaje = "Debe ingresar una temperatura valida";
        }

    }else{
        $mensaje = "Debe seleccionar una operacion";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <form action="" method="post">
        <label for="">Ingrese temp</label>
        <input type="text" name="temp" value="">

        <select name="operacion" id="">
            <option value="<?= $operaciones[0]?>"><?= $operaciones[0]?></option>
            <label for=""></label>
            <option value="<?= $operaciones[1]?>"><?= $operaciones[1]?></option>
        </select>

        <input type="submit" value="Convertir">
    </form>


    <h2><?= $mensaje ?? '' ?></h2>
    
</body>
</html>