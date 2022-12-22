<?php

require("conexion.php");

function getEstudiantesFunc()
{
  $conn = connect_mysqlFunc();
  $sql = "SELECT * FROM estudiantes";
  $result = mysqli_query($conn, $sql);
  $estudiantes = array();
  while ($row = mysqli_fetch_array($result)) {
    $estudiantes[] = $row;
  }
  return $estudiantes;
}

function getEstudianteFunc($id)
{
  $conn = connect_mysqlFunc();
  $sql = "SELECT * FROM estudiantes WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  $estudiante = mysqli_fetch_array($result);
  return $estudiante;
}

function insertEstudianteFunc($nombre, $apellido, $email, $telefono)
{
  $conn = connect_mysqlFunc();
  $sql = "INSERT INTO estudiantes (nombre, apellido, email, telefono) VALUES ('$nombre', '$apellido', '$email', '$telefono')";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function updateEstudianteFunc($id, $nombre, $apellido, $email, $telefono)
{
  $conn = connect_mysqlFunc();
  $sql = "UPDATE estudiantes SET nombre = '$nombre', apellido = '$apellido', email = '$email', telefono = '$telefono' WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function deleteEstudianteFunc($id)
{
  $conn = connect_mysqlFunc();
  $sql = "DELETE FROM estudiantes WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  return $result;
}
