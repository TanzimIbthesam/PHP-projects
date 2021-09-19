<?php 
date_default_timezone_set("Asia/Dhaka");
$currentTime=time();
$datetime=strftime("%B-%d-%y %H:%M:%S",$currentTime);
echo $datetime;


?>