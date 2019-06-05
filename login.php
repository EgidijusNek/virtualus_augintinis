<?php
    require 'php/userClass.php';
	$usuarios=new User();
	$usuarios->login();
	include 'header.php';
?>

    <main class="container-fluid login">
         <video autoplay muted loop class="myVideo">
  <source src="images/video.mp4" type="video/mp4">
</video>
<div class="video-overlay"></div>
    <div class="jumbotron text-center registracijos_forma registracija_virsus">
        <h1>Prisijunk!</h1>
        <p>Augink ir prižiūrėk savo virtualius augintinius</p>

        <form action="login.php" method="post" class="form-signin">
            <div class="form-group">
                <input type="text" class="form-control registracijos_forma" name="user" placeholder="Vartotojo vardas" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control registracijos_forma" name="password" placeholder="Slaptažodis" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block registracijos_forma" type="submit">
                <span class=""></span> Prisijungti!
            </button>
            <a href="register.php" class="btn btn-lg btn-danger btn-block registracijos_forma">Registruotis</a>
        </form>
    </div>

    </main>

<?php
include "footer.php";
