<?php
  include('../database.php');

  if(isset($_GET['vet_id'])){
    $id_vet = $_GET['vet_id'];
    $name_vet = $_GET['vet_name'];
  } else {
    $id_vet = $_SESSION['vet_id'];
  }

  $result = mysqli_query($conn, "SELECT P.foto AS fotoDelPerro, P.nombre AS nombreDelPerro, CL.nombre AS nombreDelAmo, C.fecha AS fecha FROM consultas C JOIN perros P ON C.id_perro=P.id JOIN clientes CL ON P.id_amo=CL.id WHERE C.id_veterinario='$id_vet'");
  $total_results = mysqli_num_rows($result);

?>

<?php include('../partials/header.php'); ?>

<body>
  <?php if(isset($_SESSION['vet_id']) || isset($_SESSION['admin_id'])): ?>
  <?php include('../partials/navigation.php'); ?>
  <?php if(!empty($total_results)): ?>
    <div class="row">
      <div class="col-md-5 mx-auto mt-5">
        <div class="alert alert-dark text-center" role="alert">
          <?php if(isset($_GET['vet_id'])): ?>
            <h5>Lista de consultas de <?=$name_vet?></h5>
          <?php else: ?>
            <h5>Tus consultas</h5>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="row row-cols-md-1 container mx-auto">
      <?php for($i=0;$i<$total_results;$i++): ?>
      <?php $row = mysqli_fetch_array($result); ?>
      <div class="col">
        <div class="card m-4 mx-auto" style="max-width: 750px;">
          <div class="row g-0">
            <div class="col-md-6">
              <img src="../uploads/dogs/<?= $row['fotoDelPerro']?>" width="100%" height="250" alt="<?= $row['nombreDelPerro']?>">
            </div>
            <div class="col-md-6">
              <div class="card-body" style="text-align: justify;">
                <strong>Nombre del perro: </strong><?= $row['nombreDelPerro']?><br>
                <strong>Nombre del amo: </strong><?= $row['nombreDelAmo']?><br>
                <strong>Fecha: </strong><?= $row['fecha']?><br>
                <strong>Descripción: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </div>
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
          <h5>No has realizado consultas aún</h5>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php else: header('Location: signin-vet.php'); ?>
  <?php endif; ?>
  <?php include('../partials/scripts.php') ?>
</body>
