<?php

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

if(isset($_POST['email'])){
  $email = $_POST['email'];
  $pass = sha1($_POST['password']);

  $searchmail = $bdd->prepare('SELECT * FROM acharius_account WHERE email = :mail');
  $searchmail->execute(array(
    'mail' => $email
  ));
  $data = $searchmail->fetch();
  $nb = $searchmail->rowCount();
  if($nb > 0){
    //users exists
    //check password
    if(strcmp($data['password'],$pass) == 0){
      //user can connect
      session_start();
      $_SESSION['id'] = $data['id'];
      header('Location: ../account/index.php');
    }else{
      //password not valid
      header('Location: index.php?er=0');
    }
  }else{
    //User not found
    header('Location: index.php?er=1');
  }

}

 ?>
