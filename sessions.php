<?php

require("conexion.php");

session_start(
  [
    'name' => '__session',
  ]
);


function getUserIdFunc()
{
  if (isset($_SESSION['userId'])) {
    return $_SESSION['userId'];
  }
  return null;
}


// from db
function getUser()
{

  $userId = getUserIdFunc();

  $conn = connect_mysqlFunc();
  $sql = "SELECT * FROM estudiantes WHERE CODI_UNIV = '$userId'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_array($result);
  return $user;
}


function getUserSessionFunc()
{
  if (isset($_SESSION['userId'])) {
    return $_SESSION['userId'];
  }
  return null;
}

function login($username, $password)
{



  //-----
  $conn = connect_mysqlFunc();
  $sql = "SELECT * FROM estudiantes WHERE CODI_UNIV = '$username'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_array($result);

  if (!$user)  return false;

  // --- 

  $apellido = $user['apellidos'];
  $primerCaracter = substr($apellido, 0, 1);

  $defaulPassword = $user['CODI_UNIV'] . $primerCaracter;
  // si la contraseña es igual a la contraseña por defecto
  if ($defaulPassword == $user["CLAV_UNIV"]) {
    // return userId
    return $user['CODI_UNIV'];
  }
  // caso contrario pasaremos a verficar si esta hasheada
  $isVerfied = password_verify($password, $user["CLAV_UNIV"]);
  if (!$isVerfied) {
    // return userId
    return false;
  }
  // return userId
  return $user['CODI_UNIV'];
}

function logout()
{
  session_destroy();
  // redirect login
  header("Location: login.php");
}


function createUserSessionFunc($userId)
{
  $_SESSION['userId'] = $userId;

  // redirect to login
  header("Location: index.php");
}
