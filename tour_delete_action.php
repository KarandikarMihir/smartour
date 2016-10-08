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
dbConnect();
mysql_query("DELETE FROM tour WHERE srno=$KEY") or die(mysql_error());
//header('Location: hotel_delete_photos.php?KEY=' . $HotelID);
echo '<meta http-equiv="refresh" content="0; url=tour_database.php">';
?>
