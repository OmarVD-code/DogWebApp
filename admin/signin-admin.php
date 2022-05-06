<?php
  include('../database.php');

  if(isset($_SESSION['client_id']) || isset($_SESSION['admin_id']) || isset($_SESSION['vet_id'])){
    header('Location: ../index.php');
  }

  $error = NULL;

  if(isset($_POST['Login'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){
      $email = $_POST['email'];
      $password = $_POST['password'];

      $password = md5($password);

      $query = "SELECT * FROM administradores WHERE email='$email' AND password='$password' LIMIT 1";
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        // Creamos variables de sesión
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['email'] = $row['email'];

        header('Location: ../index.php');
      } else {
        $error = "Credenciales incorrectas. Vuelva a intentarlo";
      }
    } else {
      $error = "Por favor, llene el formulario";
    }
  }
?>

<?php include('../partials/header.php'); ?>
<body>
  <div class="home-icon">
    <a href="../index.php" title="Volver"><i class="fa-solid fa-house fa-2x"></i></a>
  </div>
  <div class="form-box">
    <img src="../img/admin-icon.png" alt="Imagen del login">
    <h1>INICIAR SESIÓN</h1>
    <form action="signin-admin.php" method="post">
      <!-- email -->
      <label for="email">Email</label>
      <input type="email" name="email" placeholder="Ingresar email" required autofocus>

      <!-- password -->
      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Ingresar contraseña" required>
      <label class="checkbox-label"><input type="checkbox" onclick="showPassword()"> Mostrar contraseña</label>

      <?php if(isset($error)){ ?>
        <p style="color: #ff1a1a; font-size: 12px;"><?php echo $error; ?></p>
      <?php } ?>

      <div class="form-buttons" style="display: flex; justify-content: space-evenly">
        <button type="submit" name="Login">Login</button>
        <button type="reset" name="Cancelar">Cancelar</button>
      </div>
      <a href="../client/signin-client.php">Si eres cliente, inicia sesión aquí</a>
      <br>
      <a href="../vet/signin-vet.php">Si eres un veterinario, inicia sesión aquí</a>
    </form>
  </div>
  <script>
    function showPassword() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <?php include('../partials/scripts.php') ?>
</body>
