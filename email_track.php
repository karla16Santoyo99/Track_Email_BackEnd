<?php

$connect = new PDO("mysql:host=localhost;dbname=testing", 'root','');

if(isset($_POST["code"]))
{

	$query = "
UPDATE email_data
SET email_status = 'yes', email_open_datetime = '".date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))."'
WHERE email_track_code = ?
AND email_status = 'no'
";
$statement = $connect->prepare($query);

$statement->execute(array($_GET["code"]));
}

?>