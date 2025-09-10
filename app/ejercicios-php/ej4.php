
<?php

//aca voy a usar un array para simular la base de datos de estudiantes
$estudiantes = [
    ['id' => 1, 'nombre' => 'Juan', 'edad' => 20],
    ['id' => 2, 'nombre' => 'Maria', 'edad' => 22],
    ['id' => 3, 'nombre' => 'Pedro', 'edad' => 19],
];

//funcion para mostrar todos los estudiantes
function listarEstudiantes($estudiantes) {
    //aca muestro la lista de estudiantes
    echo "<h2>Lista de estudiantes</h2>";
    echo "<ul>";
    foreach ($estudiantes as $est) {
        echo "<li>ID: {$est['id']} - Nombre: {$est['nombre']} - Edad: {$est['edad']}</li>";
    }
    echo "</ul>";
}

//funcion para agregar un estudiante
function agregarEstudiante(&$estudiantes, $nombre, $edad) {
    //aca saco el ultimo id y sumo uno
    $nuevoId = end($estudiantes)['id'] + 1;
    $estudiantes[] = ['id' => $nuevoId, 'nombre' => $nombre, 'edad' => $edad];
}

//funcion para editar un estudiante
function editarEstudiante(&$estudiantes, $id, $nombre, $edad) {
    //aca busco el estudiante por id y lo actualizo
    foreach ($estudiantes as &$est) {
        if ($est['id'] == $id) {
            $est['nombre'] = $nombre;
            $est['edad'] = $edad;
            break;
        }
    }
}

//funcion para eliminar un estudiante
function eliminarEstudiante(&$estudiantes, $id) {
    //aca filtro el array para sacar el estudiante con ese id
    $estudiantes = array_filter($estudiantes, function($est) use ($id) {
        return $est['id'] != $id;
    });
    //aca reindexo el array para que no queden huecos
    $estudiantes = array_values($estudiantes);
}

//aca manejo las acciones del crud
$accion = $_GET['accion'] ?? '';
if ($accion == 'agregar') {
    //aca agarro los datos del form y agrego el estudiante
    $nombre = $_POST['nombre'] ?? '';
    $edad = $_POST['edad'] ?? '';
    if ($nombre && $edad) {
        agregarEstudiante($estudiantes, $nombre, $edad);
    }
} elseif ($accion == 'editar') {
    //aca agarro los datos del form y edito el estudiante
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $edad = $_POST['edad'] ?? '';
    if ($id && $nombre && $edad) {
        editarEstudiante($estudiantes, $id, $nombre, $edad);
    }
} elseif ($accion == 'eliminar') {
    //aca agarro el id y elimino el estudiante
    $id = $_GET['id'] ?? '';
    if ($id) {
        eliminarEstudiante($estudiantes, $id);
    }
}

//aca muestro el formulario para agregar
echo '<h3>Agregar estudiante</h3>
<form method="POST" action="?accion=agregar">
    Nombre: <input type="text" name="nombre">
    Edad: <input type="number" name="edad">
    <button type="submit">Agregar</button>
</form>';

//aca muestro el formulario para editar
echo '<h3>Editar estudiante</h3>
<form method="POST" action="?accion=editar">
    ID: <input type="number" name="id">
    Nombre: <input type="text" name="nombre">
    Edad: <input type="number" name="edad">
    <button type="submit">Editar</button>
</form>';

//aca muestro la lista y los botones para eliminar
listarEstudiantes($estudiantes);
echo '<h3>Eliminar estudiante</h3>
<form method="GET" action="">
    ID: <input type="number" name="id">
    <input type="hidden" name="accion" value="eliminar">
    <button type="submit">Eliminar</button>
</form>';

?>