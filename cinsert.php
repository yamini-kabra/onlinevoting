<?php
session_start();

    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'onlinevoting';
    $conn = mysqli_connect($db_host,$db_username,$db_password,$db_name);
    $error=" ";

    if(isset($_POST['insert'])){
        $cid=$_POST['cid'];
        $cname=$_POST['cname'];
        $party=$_POST['party'];
        $const=$_POST['const'];
        $body=$_POST['body'];
        $filename = $_FILES['cphoto']['name'];

        //candidate id should be unique, if not ,generate  error
        $flag=0;
        $sql="SELECT COUNT(*) from candidate WHERE cid='$cid'";
        $noofrows=mysqli_query($conn,$sql);
        if($noofrows>0){
            $flag=1;
            $error="There already exist a candidate with this ID<br>PLEASE Enter a unique candidate ID!";
        }

        if($flag==0){
          if($conn){

            if(!empty($filename)){
              move_uploaded_file($_FILES['cphoto']['tmp_name'], 'images/'.$filename);	
            }
  
            $sql="INSERT INTO candidate VALUES ('$cid','$cname','$filename','$party','$const','$body')";
            $res=mysqli_query($conn,$sql);
            mysqli_close($conn);
           
            header('Location:candidates.php');
          }
        }
        
    }

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
    <title>Control Panel</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
        table,th,td{
            text-align:center;
            padding: 10px;
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
          <a href="#" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
          <li><a href="adminlanding.php"><span class="subFont"><strong>Admin Info</strong></span></a></li>
             <li><a href="candidates.php"><span class="subFont"><strong>Candidates List</strong></span></a></li>
            <li><a href="statistics.php"><span class="subFont"><strong>Statistics</strong></span></a></li>     
          </ul>
          

          <span class="normalFont"><a href="index.html" class="btn btn-success navbar-right navbar-btn"><strong>Sign Out</strong></a></span></button>
        </div>

      </div> 
    </nav>  
  <!-- end of container -->

    <!--candidate list -->
    <div class="container" style="padding:100px 30px 20px 30px ;">
      <div class="row">
        <div class="col-sm-12" style="border:2px solid gray; padding:15px 300px 15px 300px">
        <center>
          <div class="page-header">
            <h2 class="specialHead" ></span>INSERT NEW CANDIDATE</h2><br>
            
            <form action="cinsert.php" method="POST" enctype="multipart/form-data">
      			<div class="form-group">
            
            <!--error message if any-->
            <h5 style="color: red;"><?php echo $error; ?></h5><br>

                    <label>Candidate ID *</label><br>
      				<input type="text" name="cid" placeholder="Enter Candidate ID eg.456" pattern="[0-9]{3}" class="form-control" required><br>
                      
                    <label>Candidate Full Name *</label><br>
      				<input type="text" name="cname" placeholder="Enter Full Name" class="form-control" required><br>

                    <label>Political Party he/she belongs to *</label><br>
                      <input type="text" name="party" placeholder="Enter Political Party" class="form-control" required><br>
                    
                    <label>Constituency of the Candidate *</label><br>
      				<input type="text" name="const" placeholder="Enter Constituency" class="form-control" required><br>
                      
                    <label>Description</label><br>
                    <input type="text" name="body" placeholder="Enter few lines of Description" class="form-control"><br>
                      
                    <!--upload photo-->
                    <label>Select image to upload:</label><br> <input type="file" name="cphoto" id="fileToUpload"><br><br>
                      

      				<button type="submit" name="insert" class="btn btn-block span btn-primary "><span class="glyphicon glyphicon-plus"></span>  INSERT</button>

      			</div>

          </form>
            
          </div>
      </div>
    </div>
  </div>
  </center>

    <!--tools-->
    <!--tools-->
    <div class="container" style="padding:20px 30px 30px 30px;">
            <!--display button--> 
            <center>
            <button type="button" name="display" class="btn btn-info"><a href="candidates.php"><span class="glyphicon glyphicon-step-backward"></span>DISPLAY LIST</button>
          </center>
    </div>
      
