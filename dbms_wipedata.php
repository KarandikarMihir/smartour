<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_COOKIE['Privileges']))
{
    if(decrypt($_COOKIE['Privileges'], $Salt)!='Administrator')
    {
        //header("location: index.php");
        echo '<meta http-equiv="refresh" content="0; url=accessdenied.html">';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SmarTour Data Wipe</title>
        <meta charset="UTF-8">
        <style type="text/css">
            body{
                margin: 0;
                padding: 20px;
                background: #000;
                font-family: monospace;
                color: aqua;
            }
            a{
                color: #fff;
            }
            a:visited{
                color: #fff;
            }
        </style>
    </head>
    <body>
        <p style="font-size: larger;text-decoration: underline;">SmarTour data wipe facility</p>
        <?php
        dbConnect();
        $result = mysql_query("DELETE FROM enquiry") or die(mysql_error());
        if($result){
            echo '<p>Enquiries deleted...</p>';
        }
        $result = mysql_query("DELETE FROM application") or die(mysql_error());
        if($result){
            echo '<p>Applications deleted...</p>';
        }
        $result = mysql_query("DELETE FROM receipt") or die(mysql_error());
        if($result){
            echo '<p>Receipts deleted...</p>';
        }
        $result = mysql_query("DELETE FROM feedback") or die(mysql_error());
        if($result){
            echo '<p>Feedbacks deleted...</p>';
        }        
        $result = mysql_query("DELETE FROM activitylog") or die(mysql_error());
        if($result){
            echo '<p>Activity Log cleared...</p>';
        }
        $MaxID = mysql_query("SELECT MAX(srno) FROM dbactivity") or die(mysql_error());
        $MaxID = mysql_fetch_array($MaxID, MYSQL_BOTH);
        $MaxID = intval($MaxID[0]) + 1;
        mysql_query("INSERT INTO dbactivity VALUES(" . $MaxID . ", '" . decrypt($_COOKIE['SmarTourID'], $Salt) . "','" . date('D, d-M-Y H-i-s T') . "','Data Wipe')") or die(mysql_error());
        echo '<p>SmarTour System: DATA WIPE COMPLETE.</p>';
        echo '<p><a href="index.php">Click here to continue</a></p>'
        ?>
    </body>
</html>
