<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="../index.php"><img src="../img/bone.png" alt="Logo de DogApp" width="50"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
      <!-- CUANDO NADIE INICIA SESIÓN -->
      <?php if(!isset($_SESSION['client_id']) && !isset($_SESSION['admin_id']) && !isset($_SESSION['vet_id'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Iniciar sesión
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../admin/signin-admin.php">Como administrador</a></li>
            <li><a class="dropdown-item" href="../client/signin-client.php">Como cliente</a></li>
            <li><a class="dropdown-item" href="../vet/signin-vet.php">Como veterinario</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../client/signup.php">Registrarse</a>
        </li>
      <?php endif; ?>

      <!-- CUANDO SOLO EL CLIENTE INICIA SESIÓN -->
      <?php if(isset($_SESSION['client_id'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="../client/adopt-dog.php">Adoptar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../client/get-my-dogs.php">Mis perros</a>
        </li>
      <?php endif; ?>

      <!-- CUANDO SOLO EL ADMINISTRADOR INICIA SESIÓN -->
      <?php if(isset($_SESSION['admin_id'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestionar
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../admin/manage-dogs.php">Perros</a></li>
            <li><a class="dropdown-item" href="../admin/manage-vets.php">Veterinarios</a></li>
          </ul>
        </li>
      <?php endif; ?>

      <!-- CUANDO SOLO EL VETERINARIO INICIA SESIÓN -->
      <?php if(isset($_SESSION['vet_id'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="../vet/get-consultations-history.php">Pendientes</a>
        </li>
      <?php endif; ?>

      <!-- CUANDO UN CLIENTE O ADMINISTRADOR INICIA SESIÓN -->
      <?php if(isset($_SESSION['client_id']) || isset($_SESSION['admin_id'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="../client/register-dog.php">Registrar perro</a>
        </li>
      <?php endif; ?>

      <!-- CUANDO CUALQUIER TIPO DE USUARIO INICIA SESIÓN -->
      <?php if(isset($_SESSION['client_id']) || isset($_SESSION['admin_id']) ||
      isset($_SESSION['vet_id'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="../signout.php">Cerrar sesión</a>
        </li>
      <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
