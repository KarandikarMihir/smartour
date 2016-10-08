<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
$host='localhost';
$user='root';
$password='michbharii';
$dbname='smartourbeta';

$conn = mysql_connect($host,$user,$password) or die(mysql_error());
mysql_select_db($dbname, $conn) or die(mysql_error()); 

$result = mysql_query("SHOW TABLES");
while($row=mysql_fetch_array($result))
{
    $singletablelist[] = $row[0];
}
foreach($singletablelist as $singletable)
{
    @($string.= 'DROP TABLE IF EXISTS ' . $singletable . ';');
    $string.="\n\n";
    $result=mysql_query("SHOW CREATE TABLE " . $singletable);
    while($row=mysql_fetch_array($result))
        $string.= $row[1] . ';\n\n';
    
    $result=mysql_query("SELECT * FROM " . $singletable);
    while($row=mysql_fetch_array($result))
    {
        $string.= 'INSERT INTO ' . $singletable . ' VALUES(';
        for($i=0;$i<mysql_num_fields($result);$i++)
        {
            $row[$i] = addslashes($row[$i]);
            $row[$i] = preg_replace("#\n#","\\n",$row[$i]);
            if ($i<=(mysql_num_fields($result)-1) && $i>0){$string.= ',';}
            $string.= '"' . $row[$i] . '"';
        }
        $string.= ');\n';
    }
}
$file = fopen('backup.sql','w+');
fwrite($file,$string);
fclose($file);
?>