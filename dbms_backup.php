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
backup_tables();

function backup_tables()
{
    dbConnect();
    $tables = array();
    $return='';
    $result = mysql_query('SHOW TABLES');
    while($row = mysql_fetch_row($result))
    {
        $tables[] = $row[0];
    }
    
    foreach($tables as $table)
    {
        $result = mysql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);
        $return.= "DROP TABLE IF EXISTS ".$table.";";
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        for ($i=0;$i<$num_fields;$i++) 
        {
            while($row = mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++) 
		{
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = preg_replace("#\n#","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
		}
                $return.= ");\n";
            }
        }
		$return.="\n\n\n";
    }
    $stamp = time();
    $filename = 'backup/backup-'.$stamp.'.sql';
    $handle = fopen($filename,'w+');
    fwrite($handle,$return);
    fclose($handle);
    $MaxID = mysql_query("SELECT MAX(SrNo) FROM dbactivity");
    $MaxID = mysql_fetch_array($MaxID, MYSQL_BOTH);
    $MaxID = intval($MaxID[0]) + 1;
    mysql_query("INSERT INTO dbactivity VALUES(" . $MaxID . ", '" . decrypt($_COOKIE['SmarTourID'], 'ThisIsSalt') . "','" . date('D, d-M-Y H-i-s T') . "','Backup')") or die(mysql_error());    
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"" . basename($filename) . "\""); 
    readfile($filename);
}
?>