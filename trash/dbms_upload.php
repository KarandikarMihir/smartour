<?php include 'header.html'; ?>
<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_COOKIE['Privileges']))
{
    if(decrypt($_COOKIE['Privileges'], $Salt)!='Administrator')
    {
        header("location: index.php");
	exit();
    }
}
?>
<?php
function upload($file_id, $folder="", $types="")
{
    if(!$_FILES[$file_id]['name']) return array('','No file specified');
    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = preg_split('/\\./',basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

    $file_name = basename($file_title);
    $all_types = explode(",",strtolower($types));
    if($types)
    {
        if(in_array($ext,$all_types));
        else
        {
            $result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
            return array('',$result);
        }
    }

    $uploadfile = $folder . $file_name;
	$result= '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES['thefile']['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : Folder doesn't exist.";
        } elseif(!is_writable($folder)) {
            $result .= " : Folder is not writable.";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : File is not writable.";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result = "Empty file found - please use a valid file."; //Show the error message
        } else {
			chmod($uploadfile,0777);//Make it universally writable.
        }
    }

	$sqlFileToExecute = $uploadfile;
	$hostname = 'localhost';
	$db_user = 'root';
	$db_password = 'michbharii';
	$link = mysql_connect($hostname, $db_user, $db_password);
	if (!$link) {
  	   die ("MySQL Connection error");
	}

	$database_name = 'smartourbeta';
	mysql_select_db($database_name, $link) or die ("Wrong MySQL Database");

	// read the sql file
	$f = fopen($sqlFileToExecute,"r+");
	$sqlFile = fread($f, filesize($sqlFileToExecute));
	$sqlArray = explode(';',$sqlFile);
	foreach ($sqlArray as $stmt) {
  			if (strlen($stmt)>3 && substr(ltrim($stmt),0,2)!='/*') {
    		$result = mysql_query($stmt);
    				if (!$result) {
      		   		   $sqlErrorCode = mysql_errno();
      		   		   $sqlErrorText = mysql_error();
      		   		   $sqlStmt = $stmt;
      		   		   break;
    		}
  	}
}

  if ($sqlErrorCode == 0 or $sqlErrorCode == 1065) 
  {
   $result = '';
  }
  else {
  //$result = "An error occured during restoration.";
      $result = $sqlErrorText;
  return array($file_name,$result);
  /*echo "Error code: $sqlErrorCode<br/>";
  echo "Error text: $sqlErrorText<br/>";
  echo "Statement:<br/> $sqlStmt<br/>";*/
  }
   $MaxID = mysql_query("SELECT MAX(SrNo) FROM dbActivity");
   $MaxID = mysql_fetch_array($MaxID, MYSQL_BOTH);
   $MaxID = intval($MaxID[0]) + 1;	 	
   //echo $MaxID;
   mysql_query("INSERT INTO dbActivity VALUES(" . $MaxID . ", '" . decrypt($_COOKIE['SmarTourID'], 'ThisIsSalt') . "','" . date('D, d-M-Y H-i-s T') . "','Restore')") or die(mysql_error());
 
  return array($file_name,$result);
}

if($_POST)
{
    if($_FILES['thefile']['name']) 
    {
        list($file,$error) = upload('thefile', "uploads/", 'sql');
    }
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Database Restore Routine</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">  
    <form action="dbms_upload.php" method="post" enctype="multipart/form-data">
        <table style="width:90%">
            <tr><td width="20%"><h2 style="color:#FF0000;">Warning</h2><td><h2 style="color:#FF0000;">Authorised Personnel Only</h2></td>
            <tr><td><h2>File Path</h2></td><td><input type="file" name="thefile" required /></tr></td>
            <tr><td><h2>Action</h2></td><td><input type="submit" value="Run SQL" name="action" /></tr></td>
                <?php
                if($_POST)
                    if($error)
                    {
                        echo '<tr><td><h2>Error</h2></td><td>' . $error . '</tr></td>';
                    }
                    else
                    {
                        echo '<tr><td><h2>Result</h2></td><td>Database Restoration Successfull</tr></td>';
                    }
                    ?>
        </table>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>