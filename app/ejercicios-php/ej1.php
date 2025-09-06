

<?php 

    $categorias = ["personajes principales", "villanos", "amigos de shrek"];

    $personajes = [
        ["ruta" => "./../imgs/img1.jpg", "nombre" => "Caballero", "categoria" => "{$categorias[1]}"],
        ["ruta" => "./../imgs/img2.jpg", "nombre" => "Senora", "categoria" => "{$categorias[2]}"],
        ["ruta" => "./../imgs/img3.jpg", "nombre" => "Shrek", "categoria" => "{$categorias[0]}"],
        ["ruta" => "./../imgs/img4.jpg", "nombre" => "Burro", "categoria" => "{$categorias[0]}"],
        ["ruta" => "./../imgs/img5.jpg", "nombre" => "Galleta", "categoria" => "{$categorias[2]}"]
    
    
    ];


    // print_r($personajes);

    $categoria_seleccionada = $_GET["filter_form"] ?? ""; 
?>


<!DOCTYPE html>
<html lang="en" style="box-sizing: border-box;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Menu categorias</h1>
    <form action="" method="get">
        <!-- <input type="hidden" name="form" value="filter_form"> -->
        <input type="submit" value="Todos" name="filter_form">
        <input type="submit" value="<?= $categorias[0]?>" name="filter_form">
        <input type="submit" value="<?= $categorias[1]?>" name="filter_form">
        <input type="submit" value="<?= $categorias[2]?>" name="filter_form">
    </form>


    <!-- zona de cards de personajes por defecto todos -->
    <div class="cards-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); justify-content: center; gap: 2rem;">

        <?php foreach($personajes as $i => $item): ?>
            <?php if($categoria_seleccionada == "Todos" || $categoria_seleccionada == $item["categoria"]): ?>
            <div style="padding: 0.25rem; width: 300px; height: 500px; display: flex; flex-direction: column; justify-content: center; align-items: center; border: 0.25px lightblue solid; border-radius: 5px;">
                <div style="height: 300px; width: 100%; overflow: hidden;">
                    <img src="<?= $item["ruta"]?>" alt="" style="height: auto; width: 100%; object-fit: cover;">
                </div>

                <h6>Nombre: <?= $item["nombre"]?> </h6>
                <h6>Categoria: <?= $item["categoria"]?> </h6>


                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, debitis.</p>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</body>
</html>