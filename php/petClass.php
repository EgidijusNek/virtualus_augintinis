<?php

    class Pet{
        protected $mysql;

        protected $db = array(
            'host'=>'localhost',
            'database'=>'virtualus_augintinis',
            'user'=>'root',
            'password'=>'',
        );
        
        public function __construct(){
            $this->conectaBd();
        }

        public function listarPets(){
            $id = $_SESSION["id_user"];
            $sql = "SELECT * FROM pet WHERE idUser = $id";
            $mysql=$this->mysql->prepare($sql);
            $mysql->execute();
            return $mysql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function retPet($petAtual){
                $sql="SELECT * FROM pet WHERE idPet = $petAtual";
                $mysql=$this->mysql->prepare($sql);
                $mysql->execute();
                return $mysql->fetch(PDO::FETCH_ASSOC);
        }

        protected function conectaBd(){
            $this->mysql = new PDO(
                'mysql:host='.$this->db['host'].';dbname='.$this->db['database'], $this->db['user'], $this->db['password']
            );
            $this->mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function criarPet(){
            session_start();
            $id = $_SESSION["id_user"];
            $src = 'bb';

            error_log($id);             
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $sql="INSERT INTO pet (namePet, happyPet, hungerPet, healthPet, sleepPet, statePet, image, age, weight, idUser) VALUES (:namePet, 50, 50, 50, 50, 'puiki', '$src', 0, 1, '$id')";
                $mysql=$this->mysql->prepare($sql);
                $mysql->bindValue(':namePet', $_POST['namePet'],PDO::PARAM_STR);
                try{
                    $mysql->execute();
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        public function retIDPet(){
            $query = "SELECT LAST_INSERT_ID()";
            $mysql=$this->mysql->prepare($query);
            $mysql->execute();
            $atual = $mysql->fetchColumn();
            
            if(!empty($atual))
                return $atual; 
                
        }

        public function deletaPet(){
            

            $idPet = $_SESSION["idPet"];
            error_log('no delete', $_SESSION["idPet"]);
            error_log( $_SESSION["idPet"]);
            
        
                if(!empty($idPet)){
                        $sql="DELETE FROM `pet` WHERE `idPet` = $idPet";   
                        $mysql=$this->mysql->prepare($sql);
                        
                        try{
                            $mysql->execute();

                            echo "<script type='text/javascript'>alert('Augintinis pašalintas sėkmingai!');javascript:window.location='member.php';</script>";
                        }catch(PDOException $e){
                            echo $e->getMessage();
                        }

                            $minigame = "DELETE FROM minigames WHERE idPet = $idPet";
                            $mysql=$this->mysql->prepare($minigame);
                            $mysql->execute();
                }
                else{
                    echo "<script type='text/javascript'>alert('Nėra jokių gyvūnų!');javascript:window.location='member.php';</script>";
                }
        }

        public function alimentar($tipoComida, $idPet){
            $sql = "SELECT hungerPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $alkanasAntiga = $mysql->fetchColumn();

            $kg = "SELECT weight FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($kg);
            $mysql->execute();
            $weight = $mysql->fetchColumn();

            $happy = "SELECT happyPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($happy);
            $mysql->execute();
            $felicage = $mysql->fetchColumn();

            if($tipoComida == 'Whiskas'){
                if($alkanasAntiga <= 90)
                    $alkanas = $alkanasAntiga+10;
                else
                    $alkanas = (100 - $alkanasAntiga) + $alkanasAntiga;
                $weight += 5;
            }
            else if($tipoComida == 'Mouse'){
                if($alkanasAntiga <= 92)
                    $alkanas = $alkanasAntiga+8;
                else
                    $alkanas = (100 - $alkanasAntiga) + $alkanasAntiga;
                $weight += 4;
            }
            else if($tipoComida == 'Fish'){
                if($alkanasAntiga <= 95)
                    $alkanas = $alkanasAntiga+5;
                else
                    $alkanas = (100 - $alkanasAntiga) + $alkanasAntiga;

                $weight += 3;
            }

            else if($tipoComida == 'Pedigree'){
                $serga = "SELECT healthPet FROM pet WHERE idPet = $idPet";
                $mysql = $this->mysql->prepare($serga);
                $mysql->execute();
                $sergaAntiga = $mysql->fetchColumn();

                $weight += 1;

                if($alkanasAntiga <= 99)
                    $alkanas = $alkanasAntiga+1;
                else
                    $alkanas = (100 - $alkanasAntiga) + $alkanasAntiga;

                if($sergaAntiga >= 10)
                    $sergaAtual = $sergaAntiga-10;
                else
                    $sergaAtual = 0;

                $queryDoente="UPDATE pet SET healthPet = $sergaAtual WHERE idPet = $idPet";
                $mysql=$this->mysql->prepare($queryDoente);
                $mysql->execute();

                if($sergaAtual <= 30){
                    $qDoente="UPDATE pet SET statePet = 'serga' WHERE idPet = $idPet";
                    $mysql=$this->mysql->prepare($qDoente);
                    $mysql->execute();

                }
            }

            $query="UPDATE pet SET hungerPet = $alkanas, weight = $weight WHERE idPet = $idPet";
            $mysql=$this->mysql->prepare($query);
            $mysql->execute();

           

            header('Location: ./member.php');
            $this->controleEstadosGerais($idPet);
        }

        public function banhar($idPet){
            $sql = "SELECT statePet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $estado = $mysql->fetchColumn();

            $sql = "SELECT healthPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $hp = $mysql->fetchColumn();


            $cons = "SELECT weight FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($cons);
            $mysql->execute();
            $c = $mysql->fetchColumn();

            $novoHp = $hp + 5;
            $novoC = $c - 2;


            if($estado == 'purvinas'){
                $query="UPDATE pet SET statePet = 'puiki', healthPet = $novoHp, weight = $novoC, hungerPet = 99 WHERE idPet = $idPet";
                $mysql=$this->mysql->prepare($query);
                $mysql->execute();
                header('Location: ./member.php');
                $this->controleEstadosGerais($idPet);
            }
            else{
                echo "<script type='text/javascript'>alert('Ei! Aš jau esu švarus!');javascript:window.location='member.php';</script>";
            }


        }

        public function controleEstadosGerais($idPet){
            $time = time();
            $Dtime = $time - $_SESSION["time"];

            $sql = "SELECT statePet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $state= $mysql->fetchColumn();

            $kg = "SELECT weight FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($kg);
            $mysql->execute();
            $weight = $mysql->fetchColumn();

            $alkanas = $this->hungry($Dtime, $state, $idPet);
            $felicage = $this->happy($Dtime, $state, $idPet);
            $sono = $this->sleep($Dtime, $state, $idPet);
            $saude = $this->health($Dtime, $state, $idPet);
            $age = $this->age($Dtime, $idPet);

            if($alkanas < 0)
                $alkanas = 0;

            if($felicage < 0)
                $felicage = 0;
            else if($felicage > 100)
                $felicage = 100;

            if($sono > 100)
                $sono = 100;
            else if($sono < 0)
                $sono = 0;

            if($saude < 0)
                $saude = 0;
            else if($saude > 100)
                $saude = 100;

            $estado = 'puiki';
            $src = 'cat-normal.gif';

            if ($alkanas <= 49){
                $estado = 'alkanas';
                $src = 'cat-hungry.gif';
            }
            if($alkanas >= 100){
                $estado = 'purvinas';
                $src = 'dirty-big.gif';
                $alkanas = 100;
            }
            if($felicage <= 30){
                $estado = 'liudnas';
                $src = 'cat-sad.gif';
            }
            else if(($felicage > 50) && ($alkanas >= 70) && ($sono >= 70) && ($saude >= 70)){
                $estado = 'laimingas';
                $src = 'cat-happy.gif';
            }
            if ($sono <= 49){
                $estado = 'pavarges';
                $src = 'cat-sad.gif';
            }
            if ($saude <= 30 && $saude > 0){
                $estado = 'serga';
                $src = 'cat-sick.gif';
            }
            if($saude <= 0){
                $saude = 0;
                $estado = 'mires';
            }
            if($state == 'purvinas'){
                $estado = 'purvinas';
                $src = 'dirty-big.gif';
            }
            if($state == 'miega'){
                $estado = 'miega';
                $src = 'cat-sleeping.gif';
            }

            $queryState="UPDATE pet SET healthPet = $saude, happyPet = $felicage, hungerPet = $alkanas, sleepPet = $sono, statePet = '$estado', age = $age WHERE idPet = $idPet";
            $mysql=$this->mysql->prepare($queryState);
            $mysql->execute();
            if($age >= 4){
                $aparencia = "UPDATE pet SET image = '$src' WHERE idPet = $idPet";
                $mysql=$this->mysql->prepare($aparencia);
                $mysql->execute();
            }
            else{
                if($estado == 'miega'){
                    $aparencia = "UPDATE pet SET image = 'bb-sleep.gif' WHERE idPet = $idPet";
                    $mysql=$this->mysql->prepare($aparencia);
                    $mysql->execute();
                }
                else if($estado == 'purvinas'){
                    $aparencia = "UPDATE pet SET image = 'bb-dirty.gif' WHERE idPet = $idPet";
                    $mysql=$this->mysql->prepare($aparencia);
                    $mysql->execute();
                }
                else{
                    $aparencia = "UPDATE pet SET image = 'bb.gif' WHERE idPet = $idPet";
                    $mysql=$this->mysql->prepare($aparencia);
                    $mysql->execute();
                }
            }

            $_SESSION["time"] = time();

        }

        public function reiniciarPet($idPet){
            $sql = "SELECT statePet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $state= $mysql->fetchColumn();

            if($state == 'mires'){

                $mysql->execute();

            }
        }

        public function age($Dtime, $idPet){
            $age = "SELECT age FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($age);
            $mysql->execute();
            $age = $mysql->fetchColumn();

            $state = "SELECT statePet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($state);
            $mysql->execute();
            $status = $mysql->fetchColumn();

            $id = $Dtime/600;
            $age = $age + $id;

            if($age >= 8)
                $age = 8;

           
            return $age;
        }

        public function hungry($Dtime, $state, $idPet){
            $sql = "SELECT hungerPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $hunger= $mysql->fetchColumn();

            if ($state == 'puiki' || $state == 'liudnas' || $state == 'serga'){
                $alkanas = $Dtime/120;
            }
            if ($state == 'laimingas'){
                $alkanas = $Dtime/180;
            }
            if ($state == 'pavarges' || $state == 'purvinas' || $state == 'miega'){
                $alkanas = $Dtime/100;
            }
            if ($state == 'alkanas'){
                $alkanas = $Dtime/60;
            }
            if($state == 'mires')
                $alkanas = 0;

            $hunger = $hunger - $alkanas;
            return $hunger;
        }

        public function happy($Dtime, $state, $idPet){
            $sql = "SELECT happyPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $happy= $mysql->fetchColumn();

            if ($state == 'puiki' || $state == 'purvinas'){
                $felicage = $Dtime/180;
            }
            if ($state == 'laimingas'){
                $felicage = $Dtime/250;
            }
            if ($state == 'pavarges' || $state == 'miega'){
                $felicage = $Dtime/100;
            }
            if ($state == 'liudnas'){
                $felicage = $Dtime/60;
            }
            if ($state == 'alkanas'){
                $felicage = $Dtime/80;
            }
            if ($state == 'serga'){
                $felicage = $Dtime/80;
            }
            if($state == 'mires')
                $felicage = 0;

            if($state == 'miega')
                $happy = $happy + $felicage;
            else
                $happy = $happy - $felicage;

            return $happy;
        }

        public function sleep($Dtime, $state, $idPet){
            $sql = "SELECT sleepPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $sleep= $mysql->fetchColumn();

            if ($state == 'puiki' || $state == 'purvinas'){
                $sono = $Dtime/250;
            }
            if ($state == 'laimingas'){
                $sono = $Dtime/300;
            }
            if ($state == 'pavarges' || $state == 'miega'){
                $sono = $Dtime/60;
            }
            if ($state == 'liudnas'){
                $sono = $Dtime/100;
            }
            if ($state == 'alkanas'){
                $sono = $Dtime/80;
            }
            if ($state == 'serga'){
                $sono = $Dtime/70;
            }
            if($state == 'mires')
                $sono = 0;

            if($state == 'miega')
                $sleep = $sleep + $sono;
            else
                $sleep = $sleep - $sono;

            return $sleep;
        }

        public function health($Dtime, $state, $idPet){
            $sql = "SELECT healthPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $health= $mysql->fetchColumn();

            if ($state == 'puiki' || $state == 'purvinas'){
                $saude = $Dtime/250;
            }
            if ($state == 'laimingas'){
                $saude = $Dtime/300;
            }
            if ($state == 'pavarges'){
                $saude = $Dtime/60;
            }
            if ($state == 'liudnas'){
                $saude = $Dtime/180;
            }
            if ($state == 'alkanas'){
                $saude = $Dtime/100;
            }
            if ($state == 'serga'  || $state == 'miega'){
                $saude = $Dtime/60;
            }
            if($state == 'mires')
                $saude = 0;

            if($state == 'miega')
                $health = $health + $saude;
            else
                $health = $health - $saude;

            return $health;
        }

        public function curar($idPet){
            $serga = "SELECT healthPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($serga);
            $mysql->execute();
            $statusDoente = $mysql->fetchColumn();

            $sql = "SELECT statePet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $estado = $mysql->fetchColumn();

            if($statusDoente <= 30){
                $novoHealth = $statusDoente + 10;
                if($novoHealth > 30){
                    $novoStatus = 'puiki';
                }
                

            }
            else if($estado != 'serga'){
                $novoHealth = 30;
                $novoStatus = 'serga';
            }
            else{
                $novoHealth = $statusDoente;
                $novoStatus = $estado;
            }

            $queryHealth="UPDATE pet SET healthPet = $novoHealth, statePet = '$novoStatus' WHERE idPet = $idPet";
            $mysql=$this->mysql->prepare($queryHealth);
            $mysql->execute();

            header('Location: ./member.php');
            $this->controleEstadosGerais($idPet);


        }

        public function ninar($idPet){
            $sql = "SELECT statePet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($sql);
            $mysql->execute();
            $estado = $mysql->fetchColumn();

            $cans = "SELECT sleepPet FROM pet WHERE idPet = $idPet";
            $mysql = $this->mysql->prepare($cans);
            $mysql->execute();
            $sleep = $mysql->fetchColumn();

                $query="UPDATE pet SET statePet = 'miega' WHERE idPet = $idPet";
                $mysql=$this->mysql->prepare($query);
                $mysql->execute();
            if($estado == 'miega'){
               if($sleep >= 50){
                    $query="UPDATE pet SET statePet = 'puiki' WHERE idPet = $idPet";
                    $mysql=$this->mysql->prepare($query);
                    $mysql->execute();
               }
               else{
                    $query="UPDATE pet SET statePet = 'pavarges' WHERE idPet = $idPet";
                    $mysql=$this->mysql->prepare($query);
                    $mysql->execute();
               }
            }
            
            
            header('Location: ./member.php');
            $this->controleEstadosGerais($idPet); 
        }

    }
?>
