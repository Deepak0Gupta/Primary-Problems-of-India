//const fs = require('fs');
function validateName(){
    document.getElementById("namediv").classList.remove('has-error');
    uname = document.form1.name.value;
    
    if(! /^[a-zA-Z ]+$/.test( uname)){
        document.getElementById("namediv").classList.remove('has-success');
        document.getElementById("namediv").classList.add('has-error');
        return false
    }
    else{
        document.getElementById("namediv").classList.remove('has-error');
        document.getElementById("namediv").classList.add('has-success');
        return true
    }
}
function validateAge(){
    document.getElementById("agediv").classList.remove('has-error');
    age = document.form1.age.value;
    
    if(! /^\S[0-9]{0,1}$/.test( age)){
        document.getElementById("agediv").classList.remove('has-success');
        document.getElementById("agediv").classList.add('has-error');
        return false
    }
    else{
        document.getElementById("agediv").classList.remove('has-error');
        document.getElementById("agediv").classList.add('has-success');
        return true
    }
}
function getData(){
    console.log("addData");
    if(validateName() && validateAge()){
        uname = document.form1.name.value;
        age = document.form1.age.value;
        gender = document.form1.gender.value;
        problem = document.form1.problem.value;
       

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
              }

            function showPosition(position) {
                latitude =  position.coords.latitude;
                longitude = position.coords.longitude;
                console.log(latitude,longitude)
               }  
            console.log(uname,age,gender,problem);
            //call add data 
            //addData()
        //at the end
        document.getElementById("tab1").click();
    }
    
  /*if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } */
 
}



function updateMap() {
   console.log("Updating map with realtime data")
    fetch("/data.json")
        .then(response => response.json())
        .then(rsp => {
            // console.log(rsp.data)
            rsp.data.forEach(element => {
                latitude = element.latitude;
                longitude = element.longitude;

                problem = element.problem;
                if (problem=="Electicity"){
                    color = "rgb(255,255,0)";
                } else if (problem=="Water"){
                    color = "rgb(102,255,255)";
                } 
                 else if (problem=="Pollution"){
                    color = "rgb(51,0,0)";
                } 
                 else if (problem=="Road"){
                    color = "rgb(224,224,224)";
                } 
                 else if (problem=="Curruption"){
                    color = "rgb(51,255,51)";
                }  
                 else if (problem=="Education System"){
                    color = "rgb(255,0,0)";
                } 
                else{
                    color = "rgb(153,255,153)";
                }
                // Mark on the map
                new mapboxgl.Marker({
                    draggable: false,
                    color: color
                }).setLngLat([longitude, latitude])
                .addTo(map); 
            });
        })
}
let interval = 20000;
setInterval( updateMap, interval); 