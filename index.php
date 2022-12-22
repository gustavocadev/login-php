<?php
require("sessions.php");

if (!getUserSessionFunc()) {
  header("Location: login.php");
  exit;
}
// cambiar contraseña


$user = getUser();
// obtener primer caracter del apellido
$apellido = $user['apellidos'];
$primerCaracter = substr($apellido, 0, 1);

$defaulPassword = $user['CODI_UNIV'] . $primerCaracter;

if ($defaulPassword == $user["CLAV_UNIV"]) {
  echo "cambiar contraseña";
  header("Location: cambiar-password.php");
  exit;
}

$nombres = $user['nombres'];
$codigo = $user['CODI_UNIV'];

$htmlHeader = require("partials/header.php");
echo "$htmlHeader
<main class='container mx-auto'>
<h1 class='text-3xl'><span class='font-bold'>Usuario:</span> $codigo $nombres</h1>
</main>
";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("partials/head.php") ?>
</head>

<body>

</body>

</html>