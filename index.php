<?php
include "session.php";

include "header.php";


?>

<div class="video-overlay">


<main class="">
    <video autoplay muted loop class="myVideo">
  <source src="images/video.mp4" type="video/mp4">
</video>
<div class="video-overlay"></div>
    <div class="jumbotron text-center registracijos_forma registracija_virsus">
        <h1>Sveiki atvyke!</h1>
        <p class="">Registruokis arba prisijunk prie savo paskyros ir susikurk savo virtualų augintinį! Augintinį turėsi maitinti, prausti su juo žaisti, bei
            jam susirgus gydyti. 
        </p>

       <div class="row">
           <div class="col-6">
               <a class="btn btn-lg btn-block btn-primary registracijos_forma mt-5" href="login.php">Prisijungti</a>
    
           </div>
           <div class="col-6">
                           <a class="btn btn-lg btn-danger btn-block registracijos_forma mt-5 " href="register.php">Registruotis</a>
           </div>

       </div>
    </div>
</main>
</div>
<?php
include "footer.php";
?>
