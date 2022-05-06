<?php
  include('../database.php');

  if(isset($_GET['id_perro'])){
    // Capturamos datos
    $id_nuevo_amo = $_SESSION['client_id'];
    $id_perro_adoptado = $_GET['id_perro'];

    // UPDATE DATABASE
    $query = "UPDATE perros SET id_amo='$id_nuevo_amo' WHERE id='$id_perro_adoptado'";
    mysqli_query($conn, $query);

    header("Location: get-my-dogs.php");
  }

  $result = mysqli_query($conn, "SELECT * FROM perros WHERE id_amo = 1");
  $total_results = mysqli_num_rows($result);
?>

<?php include('../partials/header.php'); ?>
<body>
  <?php include('../partials/navigation.php'); ?>
  <?php if(isset($_SESSION['client_id'])): ?>
    <?php if(!empty($total_results)): ?>
      <div class="row">
        <div class="col-md-5 mx-auto mt-5">
          <div class="alert alert-dark text-center" role="alert">
            <h5>Perros que puedes adoptar</h5>
          </div>
        </div>
      </div>
      <div class="row container gx-3 row-cols-md-2 mx-auto">
      <?php for($i=0;$i<$total_results;$i++): ?>
      <?php $row = mysqli_fetch_array($result); ?>
        <div class="col-md-4">
          <div class="card-group">
            <div class="card mb-4">
              <img src="../uploads/dogs/<?= $row['foto']?>" class="card-img-top" width="100%" height="250" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?= $row['nombre']?></h5>
                <p class="card-text">
                  <strong>Raza: </strong><?= $row['raza']?><br>
                  <strong>Género: </strong><?= $row['genero']==1? 'Macho': 'Hembra'?><br>
                  <strong>Nacimiento: </strong><?= $row['fechaNacimiento']?>
                </p>
                <a href="adopt-dog.php?id_perro=<?php echo $row['id']?>" onclick="return confirm('Desea adoptar este perro? Deberá acercarse a recogerlo dentro de las próximas 24 horas');" class="btn btn-outline-secondary btn-sm">Adoptar</a>
              </div>
            </div>
          </div>
        </div>
      <?php endfor; ?>
      </div>
    <?php else: ?>
      <div class="row">
        <div class="col-md-5 mx-auto mt-5">
          <div class="alert alert-dark text-center" role="alert">
            <h5>Actualmente no hay perros para adoptar</h5>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php else: header('Location: signin-client.php'); ?>
  <?php endif; ?>
  <?php include('../partials/scripts.php') ?>
</body>
