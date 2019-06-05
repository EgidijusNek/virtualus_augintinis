<?php
    require 'php/userClass.php';
	$usuarios=new User();
	$usuarios->cadastrar();
include "header.php";
?>

<main class="container-fluid register">
    <video autoplay muted loop class="myVideo">
  <source src="images/video.mp4" type="video/mp4">
</video>
<div class="video-overlay"></div>
    <div class="jumbotron text-center registracijos_forma registracija_virsus">
        <h1>Susikurk paskyrą!</h1>
        <p class="">Užpildyk žemiau esančius laukelius ir galėsi susikurti savo virtualų augintinį!</p>

        <form action="register.php" method="post" class="form-horizontal ">
            <div class="form-group">
                <input type="text" class="form-control registracijos_forma" id="inputUser" name="user" placeholder="Vartotojo vardas" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control registracijos_forma" id="inputPassword" name="password" placeholder="Slaptažodis" required>
            </div>
            <button class="btn btn-lg btn-danger btn-block registracijos_forma" type="submit">
                 Registruotis!
            </button>
            <a class="btn btn-lg btn-primary btn-block registracijos_forma" href="login.php">Prisijungti</a>
        </form>
    </div>

</main>

<?php
include "footer.php";
?>
