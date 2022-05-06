<?php include('database.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Registro Local Canino</title>

      <!-- ICON -->
      <link rel="icon" href="img/bone.png">

      <!-- BOOTSTRAP 5 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <!-- CUSTOM CSS -->
      <link rel="stylesheet" href="css/styles.css">

      <!-- FONT AWESOME 6.1.1 -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
  </head>
  <body>
    <div class="welcome">
      <div class="welcome-left-bg">
      </div>
      <div class="welcome-left-content">
        <div>
            <div class="welcome-left-content-text">
              <?php if(isset($_SESSION['client_id'])): ?>
                <h4>Hola cliente <span class="username"><?=$_SESSION['nombre']?></span>. Puede adoptar un perro o registrarlo si ya tiene uno. Además, contamos con veterinarios confiables para realizar las consultas que usted desee.</h4>
              <?php elseif (isset($_SESSION['vet_id'])): ?>
                <h4>Hola veterinario <span class="username"><?=$_SESSION['nombre']?></span>. Puede revisar las consultas pendientes que tiene o las que ya ha realizado</h4>
              <?php elseif (isset($_SESSION['admin_id'])): ?>
                <h4>Hola <span class="username"><?=$_SESSION['nombre']?></span>. Puede gestionar la lista de veterinarios y añadir nuevos perros en adopción</h4>
              <?php else: ?>
                <h4>Hola! Por favor, inicie sesión. Dependiendo del rol que posea, tendrá acceso a distintas funcionalidades. Si no tiene una cuenta, regístrese como cliente. Los veterinarios solo pueden ser registrados por el administrador.</h4>
                <h6>Nota: puede acceder a las credenciales de cualquier rol en mi <a href="#">repositorio </a><i class="fa-brands fa-github"></i></h6>
              <?php endif; ?>
            </div>
            <div class="welcome-left-content-buttons">
              <!-- CUANDO NADIE INICIA SESIÓN -->
              <?php if(!isset($_SESSION['client_id']) && !isset($_SESSION['admin_id']) && !isset($_SESSION['vet_id'])): ?>
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Iniciar sesión
                  </button>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="admin/signin-admin.php">Como administrador</a></li>
                    <li><a class="dropdown-item" href="client/signin-client.php">Como cliente</a></li>
                    <li><a class="dropdown-item" href="vet/signin-vet.php">Como veterinario</a></li>
                  </ul>
                </div>
                <button type="button" onclick="document.location='client/signup.php'">Registrarse</button>
              <?php endif; ?>

              <!-- CUANDO SOLO EL CLIENTE INICIA SESIÓN -->
              <?php if(isset($_SESSION['client_id'])): ?>
                <button type="button" onclick="document.location='client/adopt-dog.php'">Adoptar</button>
                <button type="button" onclick="document.location='client/get-my-dogs.php'">Ver mis perros</button>
              <?php endif; ?>

              <!-- CUANDO SOLO EL ADMINISTRADOR INICIA SESIÓN -->
              <?php if(isset($_SESSION['admin_id'])): ?>
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    Gestionar
                  </button>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item" href="admin/manage-dogs.php">Perros</a></li>
                    <li><a class="dropdown-item" href="admin/manage-vets.php">Veterinarios</a></li>
                  </ul>
                </div>
              <?php endif; ?>

              <!-- CUANDO SOLO EL VETERINARIO INICIA SESIÓN -->
              <?php if(isset($_SESSION['vet_id'])): ?>
                <button type="button" onclick="document.location='vet/get-consultations-history.php'">Pendientes</button>
              <?php endif; ?>

              <!-- CUANDO UN CLIENTE O ADMINISTRADOR INICIA SESIÓN -->
              <?php if(isset($_SESSION['client_id']) || isset($_SESSION['admin_id'])): ?>
                <button type="button" onclick="document.location='client/register-dog.php'">Registrar perro</button>
              <?php endif; ?>

              <!-- CUANDO CUALQUIER TIPO DE USUARIO INICIA SESIÓN -->
              <?php if(isset($_SESSION['client_id']) || isset($_SESSION['admin_id']) || isset($_SESSION['vet_id'])): ?>
                <button type="button" onclick="document.location='signout.php'">Cerrar sesión</button>
              <?php endif; ?>
            </div>
        </div>
      </div>
    </div>
    <?php include('partials/scripts.php'); ?>
