<?php
require("sessions.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $userId = login($username, $password);
  // print $userId;
  if (!$userId) {
    $errorLogin = "Usuario o contraseña incorrectos";
    header("Location: login.php?errorLogin=$errorLogin");
    return;
  }
  createUserSessionFunc($userId);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("partials/head.php") ?>
</head>

<body>
  <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md mt-5">
    <div class="px-6 py-4">
      <h2 class="text-3xl font-bold text-center text-gray-700 ">Iniciar Sesion</h2>
      <form method="post" action="/login-php/login.php">
        <div class="w-full mt-4">
          <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg   focus:border-blue-400  focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="username" placeholder="Nombre de usuario" name="username" autocomplete="off" />
        </div>

        <div class="w-full mt-4">
          <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg    focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" name="password" placeholder="Password" aria-label="Password" autocomplete="off" />
        </div>
        <div class="flex items-center justify-between mt-4">
          <button class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 w-full" type="submit">
            Iniciar sesion
          </button>

        </div>
        <?php if (isset($_GET['errorLogin'])) : ?>
          <div class="text-red-500 text-sm mt-2">
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