<script>
if (location.protocol != 'http:')
{
 location.href = 'http:' + window.location.href.substring(window.location.protocol.length);
}
</script>

<?php
session_start();
//get ip adress
try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
if(isset($_GET['id'])){

  $mail = $_POST['email'];
  $fname = "";
  $lname = "";

  $addmail = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE id = :id');
  $addmail->execute(array(
    'id' => $_GET['id']
  ));
  $data = $addmail->fetch();
  $ip = $data['ip'];
  $gate = $data['gate'];

}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Acharius Live</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/redcircle.svg" width="20px"/>
                      <font face="arial black" size="5em" color="white">AchariusLive</font>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Telemetry</span>
                  </a>
                  <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                    <li>
                      <a>Hygrometry : <span class="data">50%</span></a>
                    </li>
                    <li>
                      <a>Temperature : <span class="data">22 °C</span></a>
                    </li>
                    <li>
                      <a>Luminosity : <span class="data">320 Lux</span></a>
                    </li>
                    <li>
                      <a>Water remaining in tank : <span class="data">320/1000ml</span></a>
                    </li>
                    <li>
                      <a>Age : <span class="data">21 days</span></a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Actions Pages">
                  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseActionsPages" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Actions</span>
                  </a>
                  <ul class="sidenav-second-level collapse" id="collapseActionsPages">

                      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Light Pages">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseLightPages" data-parent="#exampleAccordion">
                          <i class="fa fa-fw fa-file"></i>
                          <span class="nav-link-text">Light</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseLightPages">
                          <li>
                            <a>Light Intensity <span class="data" id="demo">50%</span><div class="slidecontainer">
                              <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                            </div></a>
                            <script>
                              var slider1 = document.getElementById("myRange");
                              var output1 = document.getElementById("demo");
                              output1.innerHTML = slider1.value + "%"; // Display the default slider value

                              // Update the current slider value (each time you drag the slider handle)
                              slider1.oninput = function() {
                                  output1.innerHTML = this.value + "%";
                                  //send ajax request
                                  $.ajax({
                                    url: "https://io.adafruit.com/api/groups/achariuslab/send.json?x-aio-key=8e922f35586e4b5cad515d3e0ac1343a&light=" + this.value,
                                    cache: false,
                                    success: function(html){

                                    }
                                  });

                              }
                            </script>
                          </li>
                          <li>
                            <a>Light color <input type="color" id="head" name="color" value="#e66465" /></a>
                          </li>
                          <li>
                            <a>Light cycle : <span class="data">24h/24h</span></a>
                          </li>
                        </ul>
                      </li>

                      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Water Pages">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseWaterPages" data-parent="#exampleAccordion">
                          <i class="fa fa-fw fa-file"></i>
                          <span class="nav-link-text">Watering</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseWaterPages">
                          <li>
                            <a>Water atomizing intensity <span class="data" id="demo2">20ml/sec</span><div class="slidecontainer">
                              <input type="range" min="1" max="100" value="50" class="slider" id="myRange2">
                            </div></a>
                            <script>
                              var slider2 = document.getElementById("myRange2");
                              var output2 = document.getElementById("demo2");
                              output2.innerHTML = slider2.value + "ml/sec"; // Display the default slider value

                              // Update the current slider value (each time you drag the slider handle)
                              slider2.oninput = function() {
                                  output2.innerHTML = this.value + "ml/sec";
                              }
                            </script>
                          </li>
                          <li>
                            <a>Hydropony pump output <span class="data" id="demo3">30ml/sec</span><div class="slidecontainer">
                              <input type="range" min="1" max="100" value="50" class="slider" id="myRange3">
                            </div></a>
                            <script>
                              var slider3 = document.getElementById("myRange3");
                              var output3 = document.getElementById("demo3");
                              output3.innerHTML = slider3.value + "ml/sec"; // Display the default slider value

                              // Update the current slider value (each time you drag the slider handle)
                              slider3.oninput = function() {
                                  output3.innerHTML = this.value + "ml/sec";
                              }
                            </script>
                          </li>
                          <li>
                            <a>Watering cycle : <span class="data">2h/24h</span></a>
                          </li>
                        </ul>
                      </li>
                    </li>



                  </ul>
                  <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link nav-link-collapse collapsed" href="../account/" >
                      <span class="nav-link-text">Exit</span>
                    </a>
                  </li>
                </li>

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

                <center><iframe  src="http://192.168.0.14:8081/"
                    frameBorder="0" width="700px" height="520px"></iframe></center><center>
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Open Menu</a></center>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        if($("#menu-toggle").text().trim() === "Open Menu"){
            $("#menu-toggle").text("Close Menu");

        }else{
            $("#menu-toggle").text("Open Menu");
        }

    });
    </script>

</body>

</html>
