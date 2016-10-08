<?php include 'header.php'; ?>
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

if($_POST)
{
    $error='';
    $sqlErrorText='';
    $allowedExts = array("sql");
    $extension = end(explode(".", $_FILES["file"]["name"]));
    if(in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            $error="Return Code: " . $_FILES["file"]["error"];
        }
        else
        {
            if (file_exists("uploads/" . $_FILES["file"]["name"]))
            {
                $error= "<b>" . $_FILES["file"]["name"] . "</b> already exists. (Hint: Rename the file to force restoration.)";
            }
            else
            {
                $UploadAt="uploads/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES["file"]["tmp_name"], $UploadAt);
                dbConnect();

                // read the sql file
                $f = fopen($UploadAt,"r+");
                $sqlFile = fread($f, filesize($UploadAt));
                $sqlArray = explode(';',$sqlFile);
                foreach ($sqlArray as $stmt) 
                {
                    if (strlen($stmt)>3 && substr(ltrim($stmt),0,2)!='/*') 
                    {   
                        $result = mysql_query($stmt);
                        if (!$result) 
                        {
                            $sqlErrorCode = mysql_errno();
                            $sqlErrorText = mysql_error();
                            $sqlStmt = $stmt;
                            break;
                        }
                    }
                }
                $MaxID = mysql_query("SELECT MAX(srno) FROM dbactivity") or die(mysql_error());
                $MaxID = mysql_fetch_array($MaxID, MYSQL_BOTH);
                $MaxID = intval($MaxID[0]) + 1;
                mysql_query("INSERT INTO dbactivity VALUES(" . $MaxID . ", '" . decrypt($_COOKIE['SmarTourID'], $Salt) . "','" . date('D, d-M-Y H-i-s T') . "','Data Restore')") or die(mysql_error());

            }
        }
    }
    else
        $error="Invalid file";
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Database Restore Routine</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">  
    <form action="dbms_upload.php" method="post" enctype="multipart/form-data">
        <table style="width:90%">
            <tr><td width="30%"><h2 style="color:#FF0000;">Standard Formats</h2><td><h2 style="color:#FF0000;">*.sql</h2></td>
            <tr><td><h2>File Path</h2></td><td><input type="file" name="file" required /></td></tr>
            <tr><td><h2>Action</h2></td><td><input type="submit" value="Upload" name="action" onClick="alert('Please do not redirect from this page while running MySQL engine. You might invoke serious data loss.')" /></td></tr>
            <tr><td><h2>Result</h2></td><td><?php if($_POST){if($error){echo $error . $sqlErrorText;} else{echo 'Database Restored Successfully';}} ?></td></tr>
        </table>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>