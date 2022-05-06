<?php
  include('../database.php');

  $id_amo = $_SESSION['client_id'];

  $result = mysqli_query($conn, "SELECT * FROM perros WHERE id_amo = '$id_amo' ORDER BY id DESC");
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
            <h5>Tus perros</h5>
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
                  <strong>Raza: </strong><?= $row['raza']?><br>
                  <strong>Género: </strong><?= $row['genero']==1? 'Macho': 'Hembra'?><br>
                  <strong>Nacimiento: </strong><?= $row['fechaNacimiento']?>
                </p>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalVerConsultas<?= $row['id']?>">Ver consultas</button>
                <!-- Modal para ver consultas -->
                <div class="modal fade" id="modalVerConsultas<?= $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Consultas de <?= $row['nombre']?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <table class="table table-hover modal-body m-0">
                        <thead>
                          <tr>
                            <th scope="col">Veterinario</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Deuda</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $id_perro = $row['id'];
                          $result_consultations = mysqli_query($conn, "SELECT V.nombre AS veterinario, V.honorario AS costo, C.fecha AS fecha FROM veterinarios V JOIN consultas C ON V.id = C.id_veterinario JOIN perros P ON C.id_perro = P.id WHERE P.id = $id_perro");
                          if(!empty(mysqli_num_rows($result_consultations))){
                            while($row2 = mysqli_fetch_array($result_consultations)) { ?>
                              <tr>
                                <td><?php echo $row2['veterinario']?></td>
                                <td><?php echo $row2['fecha']?></td>
                                <td>S/.<?php echo $row2['costo']?></td>
                              </tr>
                            <?php } ?>
                            <?php
                              // Calculamos la deuda total del perro
                              $deuda = mysqli_query($conn, "SELECT SUM(V.honorario) AS DEUDA FROM veterinarios V JOIN consultas C ON V.id=C.id_veterinario JOIN perros P ON C.id_perro=P.id WHERE P.id=$id_perro");
                              $row2_1 = mysqli_fetch_array($deuda); ?>
                              <tr>
                                <th colspan="2" style="text-align: right;">DEUDA TOTAL</th>
                                <td>S/.<?php echo $row2_1['DEUDA']?></td>
                              </tr>
                            <?php ?>
                          <?php } else { ?>
                            <tr>
                              <td colspan="3" style="text-align: center;">No registra consultas</td>
                            </tr>
                          <?php } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>

                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalSolicitarConsulta<?= $row['id']?>">Solicitar consulta</button>
                <!-- Modal para solicitar -->
                <div class="modal fade" id="modalSolicitarConsulta<?= $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitar consulta para <?= $row['nombre']?> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form class="modal-body" action="request-consultation.php" method="POST">
                        <div class="mb-3">
                          <label for="owner">Solicitante: </label>
                          <input type="text" name="owner" id="owner" class="form-control" value="<?= $_SESSION['nombre']?>" required readonly>
                        </div>
                        <div class="mb-3">
                          <label for="dog_name">Nombre del perro: </label>
                          <input type="text" name="dog_name" id="dog_name" class="form-control" value="<?= $row['nombre']?>" required readonly>
                        </div>
                        <div class="mb-3">
                          <input type="hidden" name="dog_id" id="dog_id" class="form-control" value="<?= $row['id']?>">
                        </div>
                        <div class="mb-3">
                          <label for="date">Escoja una fecha: </label>
                          <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                          <label for="vet">Seleccionar veterinario: </label>
                          <select class="form-select" name="vet" id="vet">
                            <?php
                              $query = "SELECT * FROM veterinarios";
                              $result_vets = mysqli_query($conn, $query);
                              while($row3 = mysqli_fetch_array($result_vets)) { ?>
                              <option value="<?= $row3['id']?>"><?= $row3['nombre']?> (Tarifa: S/.<?= $row3['honorario']?>)</option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="d-flex justify-content-around">
                          <button type="submit" name="Solicitar_consulta" class="btn btn-primary w-100">Solicitar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
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
            <h5>Aún no has registrado un perro en nuestra veterinaria</h5>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php else: header('Location: signin-client.php'); ?>
  <?php endif; ?>
  <?php include('../partials/scripts.php') ?>
</body>
