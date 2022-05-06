<?php
  include('../database.php');

  $result = mysqli_query($conn, "SELECT P.*, C.nombre AS amo FROM perros P JOIN clientes C ON P.id_amo = C.id ORDER BY P.id DESC");
  $total_results = mysqli_num_rows($result);
?>

<?php include('../partials/header.php'); ?>
<body>
  <?php include('../partials/navigation.php'); ?>
  <?php if(isset($_SESSION['admin_id'])): ?>
    <?php if(!empty($total_results)): ?>
      <div class="row">
        <div class="col-md-5 mx-auto mt-5">
          <div class="alert alert-dark text-center" role="alert">
            <h5>Perros registrados en la veterinaria</h5>
          </div>
        </div>
      </div>
      <div class="row container gx-3 row-cols-md-2 mx-auto">
      <?php for($i=0;$i<$total_results;$i++): ?>
      <?php $row = mysqli_fetch_array($result); ?>
        <div class="col-md-4">
          <div class="card-group">
            <div class="card mb-4">
              <img src="../uploads/dogs/<?= $row['foto']?>" class="card-img-top" width="100%" height="250" alt="<?= $row['nombre']?>">
              <div class="card-body">
                <h5 class="card-title"><?= $row['nombre']?></h5>
                <p class="card-text">
                  <strong>Pertenece a: </strong><?= $row['amo']=='ADMINISTRADOR'? 'No tiene amo':$row['amo'] ?><br>
                  <strong>Raza: </strong><?= $row['raza']?><br>
                  <strong>Género: </strong><?= $row['genero']==1? 'Macho': 'Hembra'?><br>
                  <strong>Nacimiento: </strong><?= $row['fechaNacimiento']?>
                </p>
              </div>
            </div>
          </div>
        </div>
      <?php endfor; ?>
      </div>
    <?php else: ?>
      <div class="row">
        <div class="col-md-9 mx-auto mt-5">
          <div class="alert alert-dark text-center" role="alert">
            <h5>No hay perros registrados</h5>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php else: header('Location: signin-admin.php'); ?>
  <?php endif; ?>

  <?php include('../partials/scripts.php') ?>
</body>
