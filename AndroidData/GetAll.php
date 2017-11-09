<?php
$conn=mysqli_connect("localhost","u920426802_bindy","Kawal_2167","u920426802_bindy") or die("UNABLE TO CONNECT");
$query="SELECT * FROM `details` where 1";
$query=mysqli_query($conn,$query);
while($rst=mysqli_fetch_assoc($query)){
$temp[]=$rst;
}
echo json_encode($temp);
?>