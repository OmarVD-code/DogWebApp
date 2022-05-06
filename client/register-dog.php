<?php
  include('../database.php');

  if(isset($_POST['Registrar_perro'])){
    // Captura de datos
    $nombre = $_POST['name'];
    $fechaNacimiento = $_POST['date'];
    $genero = $_POST['gender'] == 'Macho' ? TRUE: FALSE;
    $raza = $_POST['breed'];
    $id_amo = isset($_SESSION['client_id']) ? $_SESSION['client_id']: 1 ;

    // Captura de la foto subida
    $img_name = $_FILES['photo']['name'];
    $img_size = $_FILES['photo']['size'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
    $img_upload_path = '../uploads/dogs/'.$new_img_name;
    move_uploaded_file($tmp_name,$img_upload_path);

    // INSERT INTO database
    $query = "INSERT INTO perros(nombre,fechaNacimiento,genero,raza,foto,id_amo) VALUES ('$nombre', '$fechaNacimiento', '$genero', '$raza', '$new_img_name', '$id_amo')";
    mysqli_query($conn, $query);

    if(isset($_SESSION['client_id'])){
      header("Location: get-my-dogs.php");
    } else {
      header("Location: ../admin/manage-dogs.php");
    }

  }
?>

<?php include('../partials/header.php'); ?>

<body>
  <?php if(isset($_SESSION['client_id']) || isset($_SESSION['admin_id'])): ?>
  <?php include('../partials/navigation.php'); ?>
  <div class="container p-5">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-header bg-dark text-white text-center">
            <h3 class="card-title">Registrar perro</h5>
          </div>
          <form action="register-dog.php" method="POST" class="card-body" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="name">Ingresar nombre: </label>
              <input type="text" name="name" id="name" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
              <label for="date">Fecha de nacimiento: </label>
              <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="mb-3 d-flex">
              <p class="mb-0">Género:</p>
              <div class="form-check">
                <input class="form-check-input ms-3 pb-0" type="radio" name="gender" id="male" value="Macho">
                <label class="custom-control-label" for="male">Macho</label>
              </div>
              <div class="form-check">
                <input class="form-check-input ms-3 pb-0" type="radio" name="gender" id="female" value="Hembra">
                <label class="custom-control-label" for="female">Hembra</label>
              </div>
            </div>
            <div class="mb-3">
              <label for="breed">Seleccionar raza: </label>
              <select class="form-select" name="breed" id="breed">
                <option value="Pitbull">Pitbull</option>
                <option value="Bulldog">Bulldog</option>
                <option value="Shih Tzu">Shih Tzu</option>
                <option value="Pequinés">Pequinés</option>
                <option value="San Bernardo">San Bernardo</option>
                <option value="Chihuahua">Chihuahua</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="photo" class="form-label">Subir foto: </label>
              <input class="form-control" type="file" accept="image/x-png,image/gif,image/jpeg" name="photo" id="photo">
            </div>
            <div class="d-flex justify-content-around">
              <button type="submit" name="Registrar_perro" class="btn btn-primary">Registrar</button>
              <button type="reset" name="Cancelar" class="btn btn-secondary">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php else: header('Location: signin-client.php'); ?>
  <?php endif; ?>
  <?php include('../partials/scripts.php') ?>
</body>
