<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php 
setcookie('SmarTourID', '', 1);
setcookie('Privileges', '', 1);
setcookie('Identification', '', 1);
header("Location: login.php");
//echo '<meta http-equiv="refresh" content="0; url=login.php">';
?>