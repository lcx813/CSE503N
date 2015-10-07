<?php

if(!isset($_POST['user']))
{
echo "missing input user";
exit;
}
if(!isset($_POST['coffee']))
{
echo "missing input coffee";
exit;
}
if(!isset($_POST['userRating']))
{
echo "missing input userRating";
exit;
}
if(!isset($_POST['comments']))
{
echo "missing input comments";
exit;
}

$user=(string)$_POST['user'];
$coffee=(int)$_POST['coffee'];
$userRating=(float)$_POST['userRating'];
$comments= $_POST['comments'];


$mysqli = new mysqli('localhost', 'lcx813', 'Lichengxi813', 'coffee');
if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
}


$stmt = $mysqli->prepare("insert into coffees (coffeeld ,user, rating, comment) values(?,?,?,?)");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}


$stmt->bind_param('isds',$coffee, $user, $userRating, $comments);
$stmt->execute();

$cld=(int)$_POST['coffee'];
$stmt->close();


$stmt = $mysqli->prepare("insert into ratings (cld) values (?)");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}

$stmt->bind_param('i', $cld);

$stmt->execute();

$stmt->close();



header("Location:coffee-main.html")
?>


               