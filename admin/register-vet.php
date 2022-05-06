<?php
  include('../database.php');

  if(isset($_POST['Registrar_veterinario'])){
    // Captura de datos
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $honorario = $_POST['honorario'];
    $id_admin = $_SESSION['admin_id'];

    // Ciframos la contraseña
    $password = md5($password);

    // Preparamos la consultas
    $query = "INSERT INTO veterinarios(nombre,email,password,honorario,id_admin) VALUES ('$nombre','$email','$password','$honorario','$id_admin')";

    $result = mysqli_query($conn,$query);

    if(!$result){
      die("Query failed");
    }

    $_SESSION['succesful_register_vet'] = 'Se ha registrado al veterinario con éxito';
    header("Location: manage-vets.php");
  }

?>
