<?php
    require 'php/userClass.php';
    require 'php/petClass.php';
//    require 'php/minigamesClass.php';
    
    $usuarios = new User();
    $usuarios->protege();
    
    $pets = new Pet();
    $resultado = $pets->listarPets();
        
        if(isset($_POST['petAtual']))  
            $teste = $_POST['petAtual'];
        else if(count($resultado) > 0)
            $teste = $resultado[0]['idPet'];

        if(!empty($teste))
            $petAtual = $pets->retPet($teste);
        else
            header('Location: ./createPet.php');

          $_SESSION["idPet"] = $petAtual['idPet'];
          
          $pets->controleEstadosGerais($petAtual['idPet']);
          $pets->reiniciarPet($petAtual['idPet']);
    

    
        if(isset($_POST['apagar'])){
            $pets->deletaPet();
        }

        if(isset($_POST['petFome'])){
            if(isset($_POST['Whiskas'])){
                $pets->alimentar($_POST['Whiskas'], $_POST['petFome']);
            }
            else if(isset($_POST['Mouse'])){
                $pets->alimentar($_POST['Mouse'], $_POST['petFome']);
            }
            else if(isset($_POST['Fish'])){
                $pets->alimentar($_POST['Fish'], $_POST['petFome']);
            }
           }
            else if(isset($_POST['Pedigree'])){
                $pets->alimentar($_POST['Pedigree'], $_POST['petFome']);
            }
    
    /** FIM CONTROLE ALIMENTAR */
    
/** CONTROLE MINIGAME */
// $game = new Minigame();
// $resGame = $game->listarMinigames($petAtual['idPet']);

// if(isset($_POST['petM']) && isset($_POST['minigameAtual'])){
//     $idP = $_POST['petM'];
//     $idM = $_POST['minigameAtual'];
// }

// if(!empty($idP) && !empty($idM)){ //talvez mover essa parte pro pedra-papel-tesoura
//     //$minigameAtual = $game->retGame($idP, $idM);
//     if($idM == 'Pedra - Papel - Tesoura'){
//         header("Location: minigames/pedra-papel-tesoura.php?idP=$idP");
//     }
//     else if($idM == 'Jogo da Velha'){
//         header("Location: minigames/jogo-da-velha.php?idP=$idP");
//     }
// }
/** FIM CONTROLE MINIGAME */

/** CONTROLE RANKING */
// $listaRanking = $game->ranking();
/** FIM CONTROLE RANKING */

    
        if(isset($_POST['banho']) && isset($_POST['petID']))
            $pets->banhar($_POST['petID']);

        if(isset($_POST['dormir']) && isset($_POST['petIDDormir']))
            $pets->ninar($_POST['petIDDormir']);

        if(isset($_POST['cura']) && isset($_POST['petIDCura']))
            $pets->curar($_POST['petIDCura']);
include 'header_online.php';
include 'modals.php';
 ?>

 
 <body class="bg-foto">
 <div class="foto-overlay"></div>    
 
<!-- main screen -->
<div class="row mt-5">
    <!-- tuščias -->
    <div class="col-1 meniu"></div>
    <!-- meniu -->
    <div class="col-2 meniu">
    <?php
    include'pet_meniu.php';
    ?>
    </div>
<!-- info blokas -->
    <div class="col-3 meniu">
    
    <table class="table table-borderless ml-1">
  <tbody>
    <tr>
      <th scope="row"></th>
      <td class="font-weight-bold tekstas-lentele">Vardas</td>
      <td class="tekstas-lentele"><?php echo $petAtual['namePet']; ?></td>
    </tr>
    <tr>
      <th scope="row"></th>
      <td class="font-weight-bold tekstas-lentele">Amžius</td>
      <td class="tekstas-lentele"><?php echo $petAtual['age']; ?></td>
    </tr>
    <tr>
      <th scope="row"></th>
      <td class="font-weight-bold tekstas-lentele">Būsena</td>
      <td class="tekstas-lentele"><?php echo $petAtual['statePet']; ?></td>
    </tr>
    <tr>
      <th scope="row"></th>
      <td class="font-weight-bold tekstas-lentele">Laimė</td>
      <td>
      <div class="progress">
                                    <?php if($petAtual['happyPet'] < 50){?>
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=$petAtual['happyPet']; ?>%; color: black;" aria-valuenow="<?=$petAtual['happyPet']; ?>" aria-valuemin="0" aria-valuemax="100"><?=$petAtual['happyPet']; ?>%</div>
                                        <?php } else { ?>
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=$petAtual['happyPet']; ?>%" aria-valuenow="<?=$petAtual['happyPet']; ?>" aria-valuemin="0" aria-valuemax="100"><?=$petAtual['happyPet']; ?>%</div>
                                            <?php } ?>
                                        </div>
      
      </td>
    </tr>
    <tr>
      <th scope="row"></th>
      <td class="font-weight-bold tekstas-lentele">Alkis</td>
      <td>
      <div class="progress">
                                    <?php if($petAtual['hungerPet'] < 50){?>
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=$petAtual['hungerPet']; ?>%; color: black;" aria-valuenow="<?=$petAtual['hungerPet']; ?>" aria-valuemin="0" aria-valuemax="100"><?=$petAtual['hungerPet']; ?>%</div>
                                        <?php } else { ?>
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=$petAtual['hungerPet']; ?>%" aria-valuenow="<?=$petAtual['hungerPet']; ?>" aria-valuemin="0" aria-valuemax="100"><?=$petAtual['hungerPet']; ?>%</div>
                                        <?php } ?>
                                    </div>
      </td>
    </tr>
    <tr>
      <th scope="row"></th>
      <td class="font-weight-bold tekstas-lentele">Sveikata</td>
      <td>
       <div class="progress">
                                    <?php if($petAtual['healthPet'] <= 40){?>
                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=$petAtual['healthPet']; ?>%; color: black;" aria-valuenow="<?=$petAtual['healthPet']; ?>" aria-valuemin="0" aria-valuemax="100"><?=$petAtual['healthPet']; ?>%</div>
                                            <?php } else { ?>
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=$petAtual['healthPet']; ?>%" aria-valuenow="<?=$petAtual['healthPet']; ?>" aria-valuemin="0" aria-valuemax="100"><?=$petAtual['healthPet']; ?>%</div>
                                            <?php } ?>
                                </div>
      </td>
    </tr>
    <tr>
      <th scope="row"></th>
      <td class="font-weight-bold tekstas-lentele">Miegas</td>
      <td>
      <div class="progress">
                                        <?php if($petAtual['sleepPet'] < 50){?>
                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=$petAtual['sleepPet']; ?>%; color: black;" aria-valuenow="<?=$petAtual['sleepPet']; ?>" aria-valuemin="0" aria-valuemax="100"><?=$petAtual['sleepPet']; ?>%</div>
                                            <?php } else { ?>
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=$petAtual['sleepPet']; ?>%" aria-valuenow="<?=$petAtual['sleepPet']; ?>" aria-valuemin="0" aria-valuemax="100"><?=$petAtual['sleepPet']; ?>%</div>
                                            <?php } ?>
                                        </div>
      </td>
    </tr>
  </tbody>
</table>
    
    
    
    
    </div>
    <!-- info bloko pabaiga -->
    <!-- foto pradžia -->
    <div class="col-5 meniu"> 
       <img class="foto ekranas mt-5 ml-5 img-fluid" src="images/<?=$petAtual['image']?>" /> 
    </div>

<!-- tuščias     -->
    <div class="col-1 meniu"></div>

</div>

</body>



<?php
include 'footer.php';
?>
