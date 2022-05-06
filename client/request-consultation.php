<?php
  include('../database.php');

  if(isset($_POST['Solicitar_consulta'])){
    // Captura de datos
    $id_perro = $_POST['dog_id'];
    $id_veterinario = $_POST['vet'];
    $fecha = $_POST['date'];

    // Query
    $query = "INSERT INTO consultas (id_perro,id_veterinario,fecha) VALUES ('$id_perro','$id_veterinario','$fecha')";

    $result = mysqli_query($conn,$query);

    if(!$result){
      die("Query failed");
    }

    // $_SESSION['succesful_request_consultation'] = 'Su consulta ha sido reservada. El veterinario se pondrá en contacto con usted';
    header("Location: get-my-dogs.php");
  }

?>
