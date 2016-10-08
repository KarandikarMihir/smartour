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
                $error=$_FILES["file"]["name"] . " already exists. ";
            }
            else
            {
                $UploadAt="uploads/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES["file"]["tmp_name"], $UploadAt);
            }
        }
    }
    else
    {
        $error="Invalid file";
    }
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">SkyDrive™ Storage</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">  
    <form action="dbms_cloud.php" method="post" enctype="multipart/form-data">
        <table style="width:90%">
            <tr><td width="30%"><h2 style="color:#FF0000;">Standard Formats</h2><td><h2 style="color:#FF0000;">*.sql</h2></td>
            <tr><td><h2>File Path</h2></td><td><input type="file" name="file" required /></td></tr>
            <tr><td><h2>Action</h2></td><td><input type="submit" value="Upload" name="action" disabled="disabled" /></td></tr>
            <tr><td><h2>Result</h2></td><td>Service currently deactivated<?php if($_POST){if($error){echo $error;} else{echo 'File Uploaded Successfully';}} ?></td></tr>
        </table>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>