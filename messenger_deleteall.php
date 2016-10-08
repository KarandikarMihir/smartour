<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
dbConnect();
mysql_query("DELETE FROM messenger WHERE recipient='" . decrypt($_COOKIE['Identification'], $Salt) . "'") or die(mysql_error());
//header("Location: messenger.php");
echo '<meta http-equiv="refresh" content="0; url=messenger.php">';
?>
