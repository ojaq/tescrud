<?php
$conn =  mysqli_connect("localhost","root","","tamu");
 
function query($query){
   global $conn;
   $result = mysqli_query($conn,$query);
   $tamus = [];
   while($tamu = mysqli_fetch_assoc($result)){
       $tamus[] = $tamu;
   }
   return $tamus;
}
?>
