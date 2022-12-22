<?php
require("sessions.php");
if (!getUserSessionFunc()) {
  header("Location: login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // obtener datos del formulario
  $cambiarPassword = $_POST['cambiarPassword'];
  // validar contraseña nueva 
  if (strlen($cambiarPassword) < 4 || strlen($cambiarPassword) > 15) {
    $errorLogin = "La contraseña debe tener entre 4 y 15 caracteres";
    header("Location: cambiar-password.php?errorLogin=$errorLogin");
    return;
  }

  // encrypt password
  $passwordHashed = password_hash($cambiarPassword, PASSWORD_DEFAULT);
  $userId = getUserIdFunc();
  $conn = connect_mysqlFunc();
  $sql = "UPDATE estudiantes SET CLAV_UNIV = '$passwordHashed' WHERE CODI_UNIV = '$userId'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location: index.php");
    exit;
  }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("partials/head.php") ?>
</head>

<body>
  <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md mt-4">
    <div class="px-6 py-4">
      <h2 class="text-3xl font-bold text-center text-gray-700 ">Cambiar Contraseña</h2>
      <form method="post">

        <div class="w-full mt-4">
          <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg   focus:border-blue-400  focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="username" placeholder="Nueva Contraseña" name="cambiarPassword" autocomplete="off" />
        </div>


        <div class="flex items-center justify-between mt-4">
          <button class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 w-full" type="submit">
            Cambiar Contraseña
          </button>
        </div>
        <?php if (isset($_GET['errorLogin'])) : ?>
          <div class="text-red-500 text-center mt-2">
            <p class='text-lg font-semibold'>
              <?php echo $_GET['errorLogin'] ?>
            </p>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</body>

</html>