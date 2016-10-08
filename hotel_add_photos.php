<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=hotel_update.php">';
    die();
}

if($_POST)
{
    $error='';
    $KEY = $_REQUEST['KEY'];
    
    $allowedExts = array("jpeg", "jpg", "png");
    //$extension = end(explode(".", $_FILES["file"]["name"]));
    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/x-png")
    || ($_FILES["file"]["type"] == "image/png"))
    && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            $error="Return Code: " . $_FILES["file"]["error"];
        }
        else
        {
            if (file_exists("hoteldata/$KEY" . $_FILES["file"]["name"]))
            {
                $error=$_FILES["file"]["name"] . " already exists. ";
            }
            else
            {
                $UploadAt="hoteldata/$KEY/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES["file"]["tmp_name"], $UploadAt);
                dbConnect();
                mysql_query("INSERT INTO imagelist VALUES('" . SafeString($UploadAt) . "','" . SafeString($_POST['caption']) . "','" . SafeString($_POST['desc']) . "'," . $KEY . ")") or die(mysql_error());
            }
        }
        //header("location: hotel_add_photos.php?KEY=' . $KEY);
    }
    else
    {
        $error="Invalid file";
    }
}
else{
    dbConnect();
    $result = mysql_query("SELECT hotellist.name as hname, citylist.name as cname from hotellist, citylist WHERE hotellist.srno=$KEY AND hotellist.cityid=citylist.srno") or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=hotel_update.php">';
        die();
    }
    $row = mysql_fetch_array($result);
    $HotelName = $row['hname'] . ', ' . $row['cname'];
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Photo Uploader</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">  
    <p style="padding: 10px;margin-bottom: 25px;background: #ebebff;border: solid 1px #0000ff;width: 95%;"><span class="label info">Note</span> You are uploading photos of <b><?php echo $HotelName ?></b>. <a href="hotel_add_rooms.php?KEY=<?php echo $KEY; ?>" style="margin-left: 50px;">Redirect to Room Details</a> <i class="icon-new-tab"></i></p>
    <form action="hotel_add_photos.php?KEY=<?php echo $KEY; ?>" method="post" enctype="multipart/form-data" novalidate="novalidate">
        <table style="width: 95%;">
            <tr>
                <td width="30%" style="padding: 8px;color:#FF0000;">Standard Formats</td>
                <td style="color:#FF0000;">*.jpg, *.jpeg, *.png</td>
            <tr>
                <td>File Path</td><td style="padding: 8px"><input style="margin: 0;" type="file" name="file" /></td>
            </tr>
            <tr>
                <td>Caption</td>
                <td style="padding: 8px;">
                    <div class="input-control text" style="margin: 0;">
                        <input type="text" style="width:250px;" class="validate-name" maxlength="50"  name="caption" placeholder="Eg. Presidential Suit" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    </div>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td style="padding: 8px">
                    <div class="input-control text" style="margin: 0;">
                        <input type="text" style="width:250px;" name="desc" maxlength="100" spellcheck="false" placeholder="Eg. 2 Adults plus one extra person" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    </div>
                </td>
            </tr>
            <tr>
                <td>Action</td>
                <td style="padding: 8px">
                    <input type="submit" style="margin: 0;" value="Upload" />
                </td>
            </tr>
            <tr>
                <td>Result</td>
                <td style="padding: 15px">
                    <?php if($_POST){if($error){echo $error;} else{echo 'File Uploaded Successfully';}}else echo 'Upload Due'; ?>
                </td>
            </tr>
        </table>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>