<!DCTYPE html>
<html>
<head>
<title>Coffee Results</title>
<style type="text/css">
body{
        width: 760px; /* how wide to make your web page */
        background-color: teal; /* what color to make the background */
        margin: 0 auto;
        padding: 0;
        font:12px/16px Verdana, sans-serif; /* default font */
}
div#main{
        background-color: #FFF;
        margin: 0;
        padding: 10px;
}
</style>
</head>
<body>
<h1>Coffee Ratings</h1>
<h2>Latest Critiques</h2>
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



        $stmt = $mysqli->prepare("select avg(rating) as avg_grade, user, coffeeld,comment from ratings order by coffeeld");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->execute();
        $stmt->bind_result($avg_grade, $user, $coffeeld, $comment)
;

        echo "<div id='main'>";
        echo "<ul>\n";

        while($stmt->fetch())
        {
                $avg_rating=htmlspecialchars($avg_grade);
              $user=htmlspecialchars($user);
$coffeeld=htmlspecialchars($coffeeld);
$comment=htmlspecialchars($comment);
                echo "Name : $user \n";
                echo "Average rating (out of 5): $avg_rating \n";
                echo "comments: $comment \n";

        }
        echo "</ul>\n";
        $stmt->close();
?>
<a href='coffee-main.html'> Submit a New Rating</a>
</div>
</body>
</html>

