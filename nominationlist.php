<?php
session_start();
include 'config.php';
    #$db_host = 'localhost';
    #$db_username = 'root';
    #$db_password = '';
    #$db_name = 'onlinevoting';
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);


    if(!$conn){
        die("Connection Failed.");
    }
    else{
        echo "Connected Successfully!<br><br>";
    }

    $sql = "Select * from candidate";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CR Voting | Green Syntax</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>

    body{
      margin:0px;
      padding:0px;
      
    }
      .headerFont{
        font-family: 'Ubuntu', sans-serif;
        font-size: 24px;
      }

      .subFont{
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        
      }
      
      .specialHead{
        font-family: 'Oswald', sans-serif;
      }

      .normalFont{
        font-family: 'Roboto Condensed', sans-serif;
      }

      a {
        color: #FFFFFF;
        text-decoration: none;
      }

      a:link {
        color: #FFFFFF;
        text-decoration: none;
      }

      /* visited link */
      a:visited {
          color: #FFFFFF;
          text-decoration: none;
      }

      /* mouse over link */
      a:hover {
          color: #FFFFFF;
          text-decoration: none;
      }

      /* selected link */
      a:active {
          color: #FFFFFF;
          text-decoration: none;
      }
      .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }
    .div-cards{
      
      /* box-shadow */
      box-shadow: rgba(0,0,0,0.7) 0 0 10px;
      border-collapse: collapse;
    }
    </style>


  </head>
  <body>
	
	<div class="container">
  	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse
    " role="navigation">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          
          <a href="index.html" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">        

          <span class="normalFont"><a href="admin.php" class="btn btn-success navbar-right navbar-btn"><strong>Admin Panel</strong></a></span>
        </div>

      </div>
    </nav>
    </div> <!-- end of container -->

      <!--nomination list-->
     
    <center>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="container-fluid" style="padding:30px 340px 20px 340px" >
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card bg-primary text-white div-cards">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="" src="<?php echo ('images/'.$row["cphoto"]); ?>" alt="Card image cap" height="220px" width="230px">
                        </div>
                        <div class="card-body col-md-9 offset-md-2" style="text-align:left">
                            <h4 class="card-title headerFont"><b><?php echo $row["cname"]; ?></b></h4><br>
                            <p class="card-text normalFont"><u>Candidate ID</u> :- <?php echo $row["cid"]; ?></p>
                            <p class="card-text normalFont"><u>Party</u> :- <?php echo $row["party"]; ?></p>
                            <p class="card-text normalFont"><u>Constituency</u> :- <?php echo $row["const"]; ?></p>
                            <p class="card-text normalFont"><u>Description</u> :- <?php echo $row["body"]; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </center>
  <?php } ?>
      
   

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
