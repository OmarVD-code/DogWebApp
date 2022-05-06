<?php include('../database.php'); ?>

<?php include('../partials/header.php'); ?>

<body>
  <?php include('../partials/navigation.php'); ?>

  <div class="row container m-4 mx-auto">
    <div class="col-sm-6">
      <?php if(isset($_SESSION['succesful_register_vet'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= $_SESSION['succesful_register_vet'] ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php $_SESSION['succesful_register_vet']=NULL; ?>
      <div class="card">
        <div class="card-header bg-dark text-white text-center">
            <h5 class="card-title">Agregar veterinario</h5>
        </div>
        <form action="register-vet.php" method="POST" class="card-body px-5">
          <div class="mb-3">
            <label for="name">Ingresar nombre: </label>
            <input type="text" name="name" id="name" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label for="email">Ingresar email: </label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password">Ingresar contraseña: </label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="honorarios">Ingresar honorario: </label><br>
            <div class="input-group">
              <span class="input-group-text">$</span>
              <input type="number" name="honorario" id="honorario" class="form-control" min="0" step="0.5" required>
            </div>
          </div>
          <div class="d-flex justify-content-around">
            <button type="submit" name="Registrar_veterinario" class="btn btn-primary w-50">Registrar</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-sm-6">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Honorario</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = "SELECT * FROM veterinarios";
            $result_vets = mysqli_query($conn, $query);

            while($row = mysqli_fetch_array($result_vets)) { ?>
            <tr>
              <td><?php echo $row['nombre']?></td>
              <td><?php echo $row['email']?></td>
              <td><?php echo $row['honorario']?></td>
              <td>
                <a href="../vet/get-consultations-history.php?vet_id=<?php echo $row['id']?>&vet_name=<?php echo $row['nombre']?>" class="btn btn-secondary" title="Ver consultas">
                  <i class="fa-solid fa-notes-medical"></i>
                </a>
                <a href="remove-vet.php?vet_id=<?php echo $row['id']?>" class="btn btn-danger" title="Eliminar">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php include('../partials/scripts.php'); ?>
</body>
