<!-- Modal Pets -->
        <div class="modal fade" id="show-pets" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary" style="color: white;">
                        <h4 class="modal-title" id="modalLabel">Tavo Virtualūs Augintiniai</h4>
                        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php foreach($resultado as $name){ ?>
                                <form action="member.php" method="post">
                                    <input type="hidden" id="petAtual" name="petAtual" value="<?=$name['idPet'];?>"></input>
                                    <?php if($name['idPet'] % 2 == 0){?>
                                        <button type="submit" class="btn btn-primary">
                                            <?php echo $name['namePet'];?>
                                        </button>
                                        <button style="float: right;"  type="submit" class="btn btn-outline-danger rounded-circle" id="apagar" name="apagar">
                                            <i class="fas fa-skull"></i>
                                        </button>
                                    <?php } else{ ?>
                                        <button type="submit" class="btn btn-info">
                                            <?php echo $name['namePet'];?>
                                        </button>
                                        <button style="float: right;" type="submit" class="btn btn-outline-danger rounded-circle" id="apagar" name="apagar">
                                            <i class="fas fa-skull"></i>
                                        </button>
                                    <?php }?>
                                </form>
                                <br><br>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="show-food" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger" style="color: white;">
                        <h4 class="modal-title" id="modalLabel">Maistas</h4>
                        <button type="button" class="close" style="color: white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="member.php" method="post">
                            <button type="submit" class="btn btn-outline-info" id="Whiskas" name="Whiskas" value="Whiskas"><img alt="paveikslelis" src="images/whiskas.jpeg"></button>
                            <button type="submit" class="btn btn-outline-success" id="Mouse" name="Mouse" value="Mouse"><img alt="paveikslelis" src="images/mouse.png"></button>
                            <button type="submit" class="btn btn-outline-warning" id="Fish" name="Fish" value="Fish"><img alt="paveikslelis" alt=paveikslelis src="images/fish.png"></button>
                            <button type="submit" class="btn btn-outline-dark" id="Pedigree" name="Pedigree" value="Pedigree"><img alt="paveikslelis"  alt="paveikslelis" alt=paveikslelis src="images/pedigree.jpg"></button>
                            <input  type="hidden" id="petFome" name="petFome" value="<?=$petAtual['idPet'];?>"></input>
                        </form>
                        <br><br>
                    </div>
                    <div class="modal-footer">
                    <p style="font-weight: bold;">Atsargiai! Kai kas gali pakenkti tavo augintiniui...</p>
                    </div>
                </div>
            </div>
        </div> 

        <!-- MODAL WEIGHT -->
        <div class="modal fade" id="weight" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info" style="color: white;">
                        <h4 class="modal-title" id="modalLabel">Svoris</h4>
                        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h1 class="text-center"><?php echo $petAtual['weight'];?> Kg<h1>
                    </div>

                    <?php if($petAtual['age'] < 4){?>
                        <p class="text-center" style="font-weight: bold;">Tobulas svoris: 7 Kg</p>
                        <?php if($petAtual['weight'] > 7){?>
                            <p class="text-center" style="font-weight: bold; color: red"><br>Noriu žaisti! Pradedu nutukti!</p>
                        <?php } ?>
                    <?php } else {?>
                        <p class="text-center" style="font-weight: bold;">Tobulas svoris: 14 Kg</p>
                        <?php if($petAtual['weight'] > 14){?>
                            <p class="text-center" style="font-weight: bold; color: red">Noriu žaisti! Pradedu nutukti!</p>
                        <?php } ?>
                    <?php }?>
                </div>
            </div>
        </div> 

        <!-- Modal Ranking -->
        <!-- <div class="modal fade" id="ranking" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning" style="color: white;">
                        <h4 class="modal-title" id="modalLabel">Žaidimų rezultatai</h4>
                        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table" align="center"  style="text-align: center;">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Posição</th>
                                    <th scope="col">ID Usuário</th>
                                    <th scope="col">Pet</th>
                                    <th scope="col">Minigame</th>
                                </tr>
                            </thead>
                            <?php $i = 1; foreach($listaRanking as $item){ ?>
                                <tbody>
                                    <tr>
                                        <th>    
                                            <?php echo $i; ?>
                                        </th>
                                        <th>    
                                            <?= $item['idUsuario']; ?> 
                                        </th>
                                        <th>    
                                            <?=  $item['nomePet']; ?> 
                                        </th>
                                        <th>    
                                            <?=  $item['nomeMinigame']; ?> 
                                        </th>
                                       
                                    </tr>
                                </tbody>
                                <?php $i++;} ?>
                        </table>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>  -->
        
        <!-- Modal Minigames -->
        <!-- <div class="modal fade" id="lista-minigames" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: green; color: white;">
                        <h4 class="modal-title" id="modalLabel">Minigames</h4>
                        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                            foreach($resGame as $minigame){ 
                                $idP = $minigame['idPet']; 
                                $idM = $minigame['nomeMinigame'];
                                ?>
                                <form action="listagem-pet.php" method="post">
                                    <input type="hidden" id="petM" name="petM" value="<?=$minigame['idPet']?>"></input>
                                    <input type="hidden" id="minigameAtual" name="minigameAtual" value="<?=$minigame['nomeMinigame']?>"</input>
                                    <?php if($idM == 'Jogo da Velha'){?>
                                        <button onmousedown="btnNS.play()" type="submit" class="btn btn-outline-success">
                                            <img src="https://png.icons8.com/dusk/40/000000/hashtag.png">
                                        </button>
                                    <?php } else {?>
                                        <button onmousedown="btnNS.play()" type="submit" class="btn btn-outline-primary">
                                            <img src="https://png.icons8.com/ultraviolet/40/000000/star-trek-gesture.png">
                                        </button>
                                    <?php }?>
                                </form>
                                <br><br>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>  -->