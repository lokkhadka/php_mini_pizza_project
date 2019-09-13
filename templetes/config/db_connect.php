<?php

//MySQLi or OPD
 //connect to database
 $conn = mysqli_connect('localhost','lok','Test1234','mini pizzas');

 //check connection

 if(!$conn){
     echo 'Connection error: ' . mysqli_connect_error();
 }


?>