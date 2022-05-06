<?php
  include('../database.php');

  if(isset($_SESSION['client_id']) || isset($_SESSION['admin_id']) || isset($_SESSION['vet_id'])){
    header('Location: ../index.php');
  }

  $error = NULL;

  // Creamos el patrón para validar la contraseña
  $regex = '/^(?=(.*\d){2})(?=(.*[@#$%&?]){2})(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#$%&?]{8,}$/';

  if(isset($_POST['Registrar'])){
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
      if($_POST['password'] == $_POST['confirm_password']){
        if(preg_match($regex,$_POST['password'])){
          // Capturamos la data del formulario
          $nombre = $_POST['name'];
          $email = $_POST['email'];
          $password = $_POST['password'];

          // La data es válida e insertamos al usuario en la base de datos
          // Encriptamos la contraseña con md5
          $password = md5($password);

          // Preparamos la Consulta
          $query = "INSERT INTO clientes(nombre,email,password) VALUES('$nombre','$email','$password')";
          $result = mysqli_query($conn,$query);

          if(!$result){
            die("Query failed");
          }

          $_SESSION['successful_signup'] = 'Has sido registrado exitosamente';
          header("Location: signin-client.php");
        }
      } else {
        $error = "Sus contraseñas no coinciden";
      }
    } else {
      $error = "Por favor llene el formulario";
    }
  }
?>

<?php include('../partials/header.php'); ?>
<body>
  <div class="home-icon">
    <a href="../index.php" title="Volver"><i class="fa-solid fa-house fa-2x"></i></a>
  </div>
  <div class="form-box" id="signup-form">
    <img src="../img/client-icon.png" id="signup-img" alt="Imagen del signup">
    <h1>REGISTRARSE</h1>
    <form action="signup.php" method="POST">
      <label for="Name">Nombre</label>

      <input type="text" name="name" placeholder="Ingresar nombre" required autofocus>
      <label for="email">Email</label>

      <input type="text" name="email" placeholder="Ingresar email" required>
      <label for="password">Password</label>
      <input type="password" name="password" id="Password" placeholder="Ingresar contraseña" pattern="(?=.*\d{2})(?=.*?[@#$%&?\]\[]{2})(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos ocho caracteres, dos dígitos, una mayúscula y dos caracteres especiales" required>
      <label class="checkbox-label"><input type="checkbox" onclick="showPassword()"> Mostrar contraseña</label>

      <label for="Confirmar">Confirmar contraseña</label>
      <input type="password" name="confirm_password" placeholder="Confirme su contraseña" required>

      <?php if(isset($error)){ ?>
        <p style="color: #ff1a1a; font-size: 12px;"><?php echo $error; ?></p>
      <?php } ?>

      <div class="form-buttons" style="display: flex; justify-content: space-evenly">
        <button type="submit" name="Registrar">Registrar</button>
        <button type="reset" name="Cancelar">Cancelar</button>
      </div>
      <a href="signin-client.php">¿Ya estás registrado? Inicia sesión aquí</a>
    </form>
  </div>

  <script>
    function showPassword() {
      var x = document.getElementById("Password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

  <?php include('../partials/scripts.php') ?>
</body>
