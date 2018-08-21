<?php

session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My account - AchariusLab</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/thumbnail-gallery.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
  <img style="vertical-align:middle" src="../img/user.png" height="20px" width="20px">
  <span style="">My account</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php">My parcels
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../top.php">Top</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../vacant.php">Vacants</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../showcase.php">ShowCase</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Page Content -->
    <div class="container">

      <?php

      try
      {
        $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
      }
      catch(Exception $e)
      {
        die('Erreur : '.$e->getMessage());
      }

      $infouser = $bdd->prepare('SELECT * FROM acharius_account WHERE id = :id');
      $infouser->execute(array(
        'id' => $_SESSION['id']
      ));
      if($infouser->rowCount() > 0){
        $data = $infouser->fetch();
        $fname = $data['fname'];
        $lname = $data['lname'];
        $username = $data['username'];
        $email = $data['email'];
        $bday = $data['birth'];
      }

      ?>

    <br/><br/>
    <p><b>First name : </b><?php echo $fname; ?></p>
    <p><b>Last name : </b><?php echo $lname; ?></p>
    <p><b>Username : </b><?php echo $username; ?></p>
    <p><b>Email adress : </b><?php echo $email; ?></p>
    <p><b>Birth date : </b><?php echo $bday; ?></p>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Acharius Lab 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
