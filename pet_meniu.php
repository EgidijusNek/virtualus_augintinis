<?php include'header.php';?>

<div class="container mt-5" >

                                <div class="row">
                                    <th scope="col">

                                        <?php if($petAtual['statePet'] == 'dormindo'){ ?>
                                            <a disabled class="btn btn-outline-danger disabled" role="button">
                                                <i class="fas fa-utensils"></i>
                                            </a>
                                        <?php } else{ ?>
                                            <a id="alimentar" class="btn btn-dark" role="button" href="#show-food" data-toggle="modal">
                                                <i class="fas fa-utensils"></i> Maitinti
                                            </a>
                                        <?php } ?>
                                    </th>
                                   
                                </div>
                                <br>
                                <!-- <div class="row">
                                    <div class="col- fas fa-bath">
                                        <a href=""><button type="button" class="btn btn-dark">Praustis</button></a>

                                    </div>
                                </div>
                                <br> -->
                                <div class="row">

                                    <th scope="col">
                                        <form action="member.php" method="post">
                                            <input type="hidden" id="banho" name="banho"></input>
                                            <input type="hidden" id="petID" name="petID" value="<?=$petAtual['idPet'];?>"></input>
                                            <button type="submit" class="btn btn-dark">
                                                <i class="fas fa-shower"></i> Prausti
                                            </button>
                                        </form>
                                    </th>
                                
                                </div>
                                <br>
                                <div class="row">
                                    <th scope="col">
                                        <?php if($petAtual['statePet'] == 'dormindo'){ ?>
                                            <a class="btn btn-dark disabled" role="button">
                                                <i class="fas fa-gamepad"></i> Žaisti
                                            </a>
                                        <?php } else{ ?>
                                            <a id="minigame" class="btn btn-dark disabled"  role="button" href="#lista-minigames" data-toggle="modal">
                                                <i class="fas fa-gamepad"></i> Žaisti
                                            </a>
                                        <?php } ?>
                                    </th>
                                </div>
                                <br>
                                <div class="row">
                                    <th scope="col">
                                        <form action="member.php" method="post">
                                            <input type="hidden" id="dormir" name="dormir"></input>
                                            <input type="hidden" id="petIDDormir" name="petIDDormir" value="<?=$petAtual['idPet'];?>"></input>
                                            <?php if($petAtual['statePet'] == 'dormindo'){?>
                                                <button type="submit" class="btn btn-dark"> Miegoti
                                                    <i class="fas fa-sun"></i>
                                                </button>
                                            <?php } else{?>
                                                <button type="submit" class="btn btn-dark">
                                                    <i class="fas fa-bed"></i> Miegoti/Keltis
                                                </button>
                                            <?php } ?>
                                        </form>
                                    </th>
                                </div>
                                <br>
                                <div class="row">
                                    <th scope="col">
                                        <form action="member.php" method="post">
                                            <input type="hidden" id="cura" name="cura"></input>
                                            <input type="hidden" id="petIDCura" name="petIDCura" value="<?=$petAtual['idPet'];?>"></input>
                                            <button  type="submit" class="btn btn-dark">
                                                <i class="fas fa-syringe"></i> Gydyti
                                            </button>
                                        </form>
                                    </th>
                                                              
                                </div>
                                <br>
                                <div class="row">
                                    <th scope="col">
                                        <a name="weight" class="btn btn-dark" role="button" href="#weight" data-toggle="modal">
                                            <i class="fas fa-weight"></i> Svoris
                                        </a>
                                    </th>

                                </div>
                            </div>
                          



                

