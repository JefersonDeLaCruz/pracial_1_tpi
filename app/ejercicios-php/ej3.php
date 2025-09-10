<?php
define("NOMBRE", "Nombre");
define("PRECIO", "Precio");
define("CANTIDAD", "Cantidad");

//productos base
$productos = [
    [NOMBRE => "Sopa maruchan", PRECIO => "1", CANTIDAD => "2"],
    [NOMBRE => "Coca Cola", PRECIO => "1.5", CANTIDAD => "3"],
    [NOMBRE => "Cafe", PRECIO => "1", CANTIDAD => "4"],
];

//checa si se envio el form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //agarra los datos del form
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';

    //valida que no vengan vacios
    if ($nombre !== '' && $precio !== '' && $cantidad !== '') {
        //agrega el nuevo producto al array
        $productos[] = [
            NOMBRE => $nombre,
            PRECIO => $precio,
            CANTIDAD => $cantidad
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>avlaaaaa que xopa</h1>
    <h1>avlaaaaa que xopa</h1>
    <h1>avlaaaaa que xopa</h1>
    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <label for="">Ingrese producto</label>
                <input type="text" name="nombre"><br>
                <label>Ingrese precio</label>
                <input type="text" name="precio"><br>
                <label>Ingrese cantidad</label>
                <input type="text" name="cantidad"><br>
                <br>
                <input type="submit" value="Registrar">
            </form>
        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <td>Producto</td>
                        <td>Precio</td>
                        <td>Cantidad</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $item): ?>
                        <tr>
                            <td><?= $item[NOMBRE] ?></td>
                            <td>$<?= $item[PRECIO] ?></td>
                            <td><?= $item[CANTIDAD] ?></td>
                            <td><?= number_format((float)$item[PRECIO] * (int)$item[CANTIDAD], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>
                            <?php
                            $suma = 0;
                            foreach ($productos as $item) {
                                $suma += ((int)$item[CANTIDAD] * (float)$item[PRECIO]);
                            }
                            echo number_format($suma, 2);
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>

</html>