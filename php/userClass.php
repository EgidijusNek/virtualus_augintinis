<?php
    

    class User{
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

        public function login(){
            session_start();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $user = $this->retUsuario($_POST['user']);
                $_SESSION["id_user"] = $user["idUser"];
                if($_POST['password'] === $user['password']){
                    $_SESSION["user"] = $user;
                    $_SESSION["time"] = $user['time'];
                    error_log($_SESSION["time"]);
                }
                else{
                    echo "<script type='text/javascript'>alert('Toks vartotojas nerastas!');javascript:window.location='login.php';</script>";
                }
            }
            if(!empty($_SESSION["user"])){
                if(empty($_SESSION["url"])){
                    header('Location: ./member.php');
                    echo "teste";
                } else{
                    header('Location: '.$_SESSION["url"]);
                }
            }


        }

        public function logout(){
            session_start();
            $time = $_SESSION["time"];
            $query="UPDATE user SET time = $time";
            $mysql=$this->mysql->prepare($query);
            $mysql->execute();
            session_unset();
            session_destroy();
            header('Location: ./index.php');
        }

        public function protege(){
            session_start();
            if (empty($_SESSION["user"])) {
                $_SESSION["url"]=$_SERVER['REQUEST_URI'];
                header('Location: ./login.php');
            }
        }

        public function cadastrar(){
            $time = time();            
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $sql="INSERT INTO user (user, password, time) VALUES (:user,:password, '$time')";
                $mysql=$this->mysql->prepare($sql);
                $mysql->bindValue(':user', $_POST['user'],PDO::PARAM_STR);
                $mysql->bindValue(':password', $_POST['password'],PDO::PARAM_STR);
                try{
                    $mysql->execute();
                    echo "<script type='text/javascript'>alert('Registracija pavyko!');javascript:window.location='register.php';</script>";
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        protected function conectaBd(){
            $this->mysql = new PDO(
                'mysql:host='.$this->db['host'].';dbname='.$this->db['database'], $this->db['user'], $this->db['password']
            );
            $this->mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        protected function retUsuario($user){
            $sql='SELECT * FROM `user` WHERE `user`.`user` = :user;';
            $mysql=$this->mysql->prepare($sql);
            $mysql->bindValue(':user', $user,PDO::PARAM_STR);
            $mysql->execute();
            return $mysql->fetch(PDO::FETCH_ASSOC);
        }

        

    }

?>
