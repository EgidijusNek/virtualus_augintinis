<?php

    require 'php/userClass.php';    
    $usuarios=new User();

    require 'php/petClass.php';
	  $pets=new Pet();
    $pets->criarPet();
    $idPet = $pets->retIDPet();
    
   
    if(isset($_POST['criar']))
      header('Location: ./member.php');
include 'header_online.php';
?>

<main class="container-fluid">
    <video autoplay muted loop class="myVideo">
  <source src="images/video.mp4" type="video/mp4">
</video>
<div class="video-overlay"></div>
    <div class="row">
        <div class="col-12 mt-5">
            <div class="jumbotron text-center registracijos_forma">
                <h1>Sukurk savo augintinį!</h1>
                <p>Sugalvok vardą savo virtualiam augintiniui ir įvesk jį žemiau!</p>
                <p>
                <form action="createPet.php" method="post" class="form-signin registracijos_forma">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputName" name="namePet" placeholder="Vardas:" required>
                    </div>
                    <button name="create" class="btn btn-lg btn-danger btn-block" type="submit">
                        Kurti!
                    </button>
                    <a href="member.php" class="btn btn-lg btn-primary btn-block">Eiti į pagrindinį puslapį</a>
                </form>
            </div>
        </div>

</main>

<?php
include 'footer.php';
?>
