<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    if(isset($_GET['PATH'])){
        $PATH = $_GET['PATH'];
        $KEY = $_GET['KEY'];
    }
}
else{
    echo '<meta http-equiv="refresh" content="0; url=hotel_update.php">';
    die();
}
dbConnect();
mysql_query("DELETE FROM imagelist WHERE imagepath='$PATH' AND hid=$KEY") or die(mysql_error());
unlink($PATH);
//header('Location: hotel_delete_photos.php?KEY=' . $HotelID);
echo '<meta http-equiv="refresh" content="0; url=hotel_delete_photos.php?KEY=' . $KEY . '">';
?>
