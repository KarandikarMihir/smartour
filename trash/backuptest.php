<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
$sign = '&trade;';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'michbharii';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db('smartourbeta');
$result = mysql_query("SELECT * FROM TableList");
while($row=mysql_fetch_array($result))
{
    $table_name = $row['TableName'];
    $backup_file  = "C:/wamp/www/SmarTour/backup/" . $table_name . ".sql";
    $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
        die('Could not take data backup: ' . mysql_error());
    }
}
echo "Backedup  data successfully\n";
mysql_close($conn);
?>