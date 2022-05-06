<?php
  include('../database.php');

  if(isset($_GET['vet_id'])){
    $id_vet = $_GET['vet_id'];
    $query1 = "DELETE FROM consultas WHERE id_veterinario='$id_vet'";
    $result_1 = mysqli_query($conn, $query1);
    $query2 = "DELETE FROM veterinarios WHERE id='$id_vet'";
    $result_2 = mysqli_query($conn, $query2);

    if(!$result_2){
      die('El veterinario tiene consultas pendientes');
    }
  }

  header('Location: manage-vets.php');

?>
