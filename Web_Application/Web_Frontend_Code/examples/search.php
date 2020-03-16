<?php
include "connection.php";
ini_set('default_charset', 'utf-8');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="referrer" content="no-referrer" />
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <META HTTP-EQUIV="Content-Type"  CONTENT="text/html; CHARSET=iso-8859-6">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/quran.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Samentic - Quran</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
  </head>
  <body class="">
    <div class="wrapper ">
      <div class="sidebar" data-color="white" data-active-color="success">
        <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow" -->
        <div class="logo">
          <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small"><img src="../assets/img/Quran.jpg"></div>
          </a>
          <a href="dashboard.php" class="simple-text logo-normal">Samentic Quran</a>
        </div>
        <div class="sidebar-wrapper">
	        <?php
	        $query = "SELECT * from chapter";
	        $result = mysqli_query($conn, $query);
	        ?>
          <ul class="nav">
            <?php
			      while($row = mysqli_fetch_array($result)) { ?>
				      <li>
              <a href="Ayat.php?id=<?php echo $row['chapter']; ?> ">
				      <?php echo $row['chapter'];
				      echo ":"." ";
				      echo $row['romanname'];
				      echo " "." "." "." ";
				      echo json_encode($row['arabicname'],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES , JSON_PRETTY_PRINT); ?>
              </a>
              </li>
			      <?php }?>
          </ul>
        </div>
      </div>
      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
		          <?php
              $intialquery = "SELECT text from quran where verse = 1";
              $display     = mysqli_query($conn, $intialquery);
              $row         = mysqli_fetch_array($display)
              ?>
              <a class="navbar-brand" href="#pablo" style="margin-left:400px; color:green;"><?php echo $row['text']; ?>  </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
          <div class="row">
            <div class="col-md-12">
              <style>
                td, th {
                  padding: 10px;
                }
              </style>
              <?php
              $chapter = "SELECT * from chapter where chapter = {$_GET['id']}";
              $chap    = mysqli_query($conn, $chapter);
              while ( $c  = mysqli_fetch_array($chap) ){
                echo '<b>Arabic Name:</b> '.$c['arabicname'];
                echo '<br>';
                echo '<b>Roman Name:</b> '.$c['romanname'];
                echo '<br>';
                echo '<b>English Name:</b> '.$c['englishname'];
                echo '<br>';
                echo '<b>Chapter Type:</b> '.$c['chaptertype'];
                echo '<br>';
                echo '<br>';
              }

              $tajweed = "SELECT * from tajweed where chapter = {$_GET['id']} && rule = '{$_GET['s']}'";
              $display = mysqli_query($conn, $tajweed);
              echo '<table style="width: 100%;" rowspan="3px" border="1">';
              echo '<tr>';
                echo '<th>Start</th>';
                echo '<th>End</th>';
                echo '<th>English</th>';
                echo '<th>Urdu</th>';
                echo '<th>Arabic</th>';
              echo '</tr>';
              while ( $row  = mysqli_fetch_array($display) )
              {
                $quran = "SELECT * from quran where chapter = {$row['chapter']} && chap_verse = '{$row['verse']}'";
                $qur = mysqli_query($conn, $quran);
                $q = mysqli_fetch_array($qur);
                echo '<tr>';
                echo '<td>'.$row['indexstart'].'</td>';
                echo '<td>'.$row['indexend'].'</td>';
                echo '<td>'.$q['eng_trans'].'</td>';
                echo '<td>'.$q['urdu_trans'].'</td>';
                echo '<td>'.$q['text'].'</td>';
                echo '</tr>';
              }
              echo '</table>';
              ?>
            </div>
          </div>
        </div>
        <footer class="footer footer-black  footer-white ">
          <div class="container-fluid">
            <div class="row">
              <div class="credits ml-auto">
                <span class="copyright"> © <script> document.write(new Date().getFullYear()) </script>, made with <i class="fa fa-heart heart"></i> by Samentic Quran Team</span>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script> $(document).ready(function() { demo.initChartsPages(); }); </script>
  </body>
</html>