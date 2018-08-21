<?php

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

if(isset($_POST['username'])){

  $username = $_POST['username'];
  $email = $_POST['email'];
  $pass = sha1($_POST['password']);
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];

  echo $username . $email . $pass . $fname . $lname;

  $adduser = $bdd->prepare('INSERT INTO acharius_account (id, fname, lname, username, email, birth, password) VALUES (NULL, :fname, :lname, :usr, :email, :bday, :pass)');
  $adduser->execute(array(

    'fname' => $fname,
    'lname' => $lname,
    'usr' => $username,
    'email' => $email,
    'bday' => '2018-07-25',
    'pass' => $pass

  ));

  $searchmail = $bdd->prepare('SELECT * FROM acharius_email_list WHERE email = :email');
  $searchmail->execute(array(
    'email' => $email
  ));

  $nb = $searchmail->rowCount();

  if($nb == 0){
    //user has not already given his mail in beta vers.
    $addmail = $bdd->prepare('INSERT INTO acharius_email_list (id, email, first_name, last_name) VALUES (NULL, :mail, :fname, :lname)');
    $addmail->execute(array(
      'mail' => $email,
      'fname' => $fname,
      'lname' => $lname
    ));
  }

  header("Location: ..\account\index.php");
  //créer les variables de sessions

}else{
  header('Location: index.html?er=1');
}



 ?>
