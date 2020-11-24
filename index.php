<!DOCTYPE html>

<html lang="en">
<head>
  <title>Primary  Problems of India</title>
  <link rel="icon" type="image/ico" href="img/logo.png" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
 
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<script>
      if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
              }
            function showPosition(position) {
                latitude =  position.coords.latitude;
                longitude = position.coords.longitude;
                console.log(latitude,longitude)
                document.getElementById("latitude").value=latitude;
                document.getElementById("longitude").value=longitude;
          }  
          <?php 
              $lat = "<script>document.write(latitude) </script>";
                  $lon = "<script>document.write(longitude) </script>";

              ?>
        </script> 
<body>

<div class="container-fluid">
  <h4 class="text-center">Primary Problems of India</h4>
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home" id="tab1">Home</a></li>
    <li><a data-toggle="pill" href="#form" id="tac2">Form</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active " onload="updateMap()" >

<div id="map" style="width: 100; height: 600px;" >

</div>
    </div>
    <div id="form" class="tab-pane fade">
    <div class="container">
        
        <form method="post" action="index.php">
          <div class="form-group" id="namediv">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" >
          </div>
          <div class="form-group" id="agediv">
            <label for="age">Age:</label>
            <input type="number" class="form-control" id="age"  placeholder="Enter Age" name="age" >
          </div>
          <div class="form-group">
            <label for="gender">Select your Gender</label><br>
          <label class="radio-inline">
            <input type="radio" name="gender" value="Male" checked>Male
          </label>
          <label class="radio-inline">
            <input type="radio" name="gender" value="Female">Female
          </label>
          <input type="hidden" id="latitude" name="latitude">
          <input type="hidden" id="longitude" name="longitude">
        </div>
        <div class="form-group">
            <label for="issue">Select your primary issue:</label>
            <select class="form-control" id="issue" name="problem">
                <option>Electricity</option>
                <option>Water</option>
                <option>Pollution</option>
                <option>Road</option>
                <option>Curruption</option>
                <option>Education System</option>
               
                <option>Healthcare System</option>
            </select>
          </div>
          <input class="btn btn-success" type="submit" value="Submit" name="submit">
        </form>
      </div>
    <br>
    </div>
  </div>
</div>
</body>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
<script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoibWFuaXNocGFsIiwiYSI6ImNrOG45MDVkcTA2cmczZmx2b3NuanE5a3AifQ.0UMfWYIJU1dIToDsbVWYgw';
    var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      zoom:'3.5',
      center: [80,23]
    });
    </script>
    
     <?php 
     
    
     if(isset($_POST['submit'])){
     $con = mysqli_connect('localhost','root','','problem_solver')or die(mysqli_error($con));
       $name = $_POST['name'];
       $age = $_POST['age'];
       $gender = $_POST['gender'];
       $problem = $_POST['problem'];
       $MAC = exec('getmac'); 
        $MAC = strtok($MAC, ' '); 
        $d=strtotime("+1 Months");
        $due_date =  date("Y-m-d", $d);
        $latitude  = $_POST['latitude'];
        $longitude = $_POST['longitude'];
   
    $query = mysqli_query($con,"INSERT INTO `data`(`name`, `age`, `gender`, `problem`, `mac_address`, `due_date`, `latitude`, `longitude`) VALUES ('$name','$age','$gender','$problem','$MAC','$due_date','$latitude','$longitude')")or die(mysqli_error($con));
      
      if ($query) {
        echo '<script type="text/javascript">
      alert("thank you! Your Problem is Noted");
    </script>';
      }
      updatemap();
    }
     ?>
        <?php

function updatemap(){
  $con = mysqli_connect('localhost','root','','problem_solver')or die(mysqli_error($con));
  $mapquery = mysqli_query($con,"SELECT * FROM `data` WHERE 1");
  while ($row = mysqli_fetch_array($mapquery)){
    $due_date = $row['due_date'];
    $latitude  = $row['latitude'];
    $longitude  = $row['longitude'];
    $problem = $row['problem'];
    $mac_address = $row['mac_address'];
                if ($problem=="Electricity"){
                    $color = "rgb(255,255,0)";
                } else if ($problem=="Water"){
                    $color = "rgb(102,255,255)";
                } 
                 else if ($problem=="Pollution"){
                    $color = "rgb(51,0,0)";
                } 
                 else if ($problem=="Road"){
                    $color = "rgb(224,224,224)";
                } 
                 else if ($problem=="Curruption"){
                    $color = "rgb(51,255,51)";
                }  
                 else if ($problem=="Education System"){
                    $color = "rgb(255,0,0)";
                } 

                else{
                    $color = "rgb(153,255,153)";
                }
                ?>
    <script type="text/javascript">
  mapboxgl.accessToken = 'pk.eyJ1IjoiaGFycnkxMjM0OTgiLCJhIjoiY2s4OXh1c3BqMGFsZzNvbXA3YmYyaGFhYSJ9.wmVMiMxlSqpzJPsj-UXr3Q';
                // Mark on the map
               new mapboxgl.Marker({
                    draggable: false,
                    color: <?php  echo('"'.$color.'"');?>
                }).setLngLat([<?php  echo($longitude);?>, <?php  echo($latitude);?>])
                .addTo(map); 
    </script>
    <?php
  }
}
updatemap();
?>
</html>
