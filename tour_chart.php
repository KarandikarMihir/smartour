<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=tour_database.php">';
    die();
}
?>
<!DOCTYPE html>
<html style="background-color: #ccc">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/favicon_main.ico" type="image/x-icon">
        <title>Tour Chart</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <style type="text/css">
            .main {
                background-color: #f1f1f1;
            }
        </style>        
    </head>
    <body class="metrouicss" style="height: 11.69in;width: 8.27in;margin: auto;padding: 20px;background-color: #fff;box-shadow: 0 0 15px #999;-webkit-box-shadow: 0 0 15px #999;-moz-box-shadow: 0 0 15px #999;">
        <?php
        dbConnect();
        $result=  mysql_query("SELECT * FROM tour WHERE srno=$KEY") or die(mysql_query());
        $row=  mysql_fetch_array($result);
        ?>
        <h2 style="padding-bottom: 5px;border-bottom: 1px solid #000;"><b><?php echo $row['name']; ?></b></h2>
        <p><span style="margin-right: 25px;"><b>Total No. of Seats: </b><?php echo $row['seats'];?></span><b>Available Seats: </b><?php echo $row['seats_available'];?></p>
        <p>&nbsp;</p>
        <table>
            <tr>
                <td><b>Sr. No.</b></td>
                <td><b>Name on Booking</b></td>
                <td><b>Contact</b></td>
                <td><b>Seats</b></td>
            </tr>
            <?php
            $result = mysql_query("SELECT application_tour.srno, customer.name as cname, customer.mobile, customer.landline, application_tour.seats, application_tour.timestamp FROM application_tour, customer WHERE application_tour.tid=$KEY AND application_tour.cid=customer.srno") or die(mysql_error());
            $i=0;
            while($row=  mysql_fetch_array($result))
            {
                echo '<tr>';
                echo '<td><b>Ticket No.' . $row['srno'] . '</b></td>';
                echo '</tr>';
                $srno=$row['srno'];
                echo '<tr class="main">';
                echo '<td>' . ++$i . '</td>';
                echo '<td>' . $row['cname'] . '</td>';
                echo '<td>' . $row['mobile'] . ', ' . $row['landline'] . '</td>';
                echo '<td>' . $row['seats'] . '</td>';
                echo '</tr>';
                $result2=  mysql_query("SELECT * FROM application_tour_list WHERE taid=$srno") or die(mysql_error());
                while($row2=  mysql_fetch_array($result2)){
                    echo '<tr>';
                    echo '<td>' . ++$i . '</td>';
                    echo '<td>' . $row2['name'] . '</td>';
                    echo '<td colspan="2">' . $row2['contact'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </body>
</html>
