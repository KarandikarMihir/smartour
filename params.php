<?php include 'header.php'; ?>
<?php
if ($_POST)
{
    if(isset($_COOKIE['Privileges'])){
        if(decrypt($_COOKIE['Privileges'], $Salt)!='administrator'){
            $error= '<p style="padding: 10px;margin-bottom: 25px;background: #ffebeb;border: solid 1px #FF0000;width: 95%;"><span class="label important">Important!</span> Please note that you do not have privileges to perform this action.</p>';
            $error.= '<div id="binder" style="width:100%;height:290px;overflow:auto;">';
        }
        else{
            dbConnect(); 
            $TCNumber = SafeString($_POST['tcno']); 
            $CName = SafeString($_POST['cname']);
            $Address = SafeString($_POST['address']);
            $Contact = SafeString($_POST['contact']);
            $Mobile = SafeString($_POST['mobile']);
            $Email = SafeString($_POST['email']);
            $Website = SafeString($_POST['website']);
            $FBURL = SafeString($_POST['fburl']);
    
            //*********
            $allowedExts = array("jpeg", "jpg", "png");
            $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
            && in_array($extension, $allowedExts)){
                if ($_FILES["file"]["error"] > 0){
                    $error="Return Code: " . $_FILES["file"]["error"];
                }
                else{
                    if(file_exists("images/" . $_FILES['file']['name'])){
                        unlink("images/" . $_FILES['file']['name']);
                    }
                    else{
                        $UploadAt="images/" . $_FILES['file']['name'];
                        move_uploaded_file($_FILES["file"]["tmp_name"], $UploadAt);
                        mysql_query("UPDATE params set tcno='$TCNumber', cname='$CName', address='$Address', contact='$Contact', mobile='$Mobile', email='$Email', website='$Website', fburl='$FBURL', logo='$UploadAt'") or die(mysql_error());
                    }
                }
            }
            else{
                $error="Invalid file";
                mysql_query("UPDATE params set tcno='$TCNumber', cname='$CName', address='$Address', contact='$Contact', mobile='$Mobile', email='$Email', website='$Website', fburl='$FBURL'") or die(mysql_error());
            }
            //*********
            echo '<meta http-equiv="refresh" content="0; url=params.php">';
        }
    }
}
dbConnect();
$result = mysql_query("SELECT * FROM params");
while($row = mysql_fetch_array($result)){
    $TCNumber = $row['tcno']; 
    $CName = $row['cname'];
    $Address = $row['address'];
    $Contact = $row['contact'];
    $Mobile = $row['mobile'];
    $Email = $row['email'];
    $Website = $row['website'];
    $FBURL = $row['fburl'];
    $CompanyLogo = $row['logo'];
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Parameters</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <?php
        if(isset($error)){
            echo $error;
        }
    ?>
    <form method="post" action="params.php" enctype="multipart/form-data">
        <div style="float:left;width:250px">
            <p>TC Number</p>
            <div class="input-control text"><input type="text" class="skippable" autofocus name="tcno" value="<?php echo $TCNumber; ?>" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>Company Name</p>
            <div class="input-control text"><input type="text" class="skippable" name="cname" value="<?php echo $CName; ?>" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>Address</p>
            <div class="input-control text"><input type="text" class="skippable" name="address" value="<?php echo $Address; ?>" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>Contact</p>
            <div class="input-control text"><input type="text" class="skippable" name="contact" value="<?php echo $Contact; ?>" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
        </div>
        <div id="separator" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Mobile</p>
            <div class="input-control text"><input type="text" class="skippable" name="mobile" placeholder="" value="<?php echo $Mobile; ?>" style="width:250px;" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>Email</p>
            <div class="input-control text"><input type="email" class="skippable" name="email" placeholder="something@something.com" value="<?php echo $Email; ?>" style="width:250px;" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>Website</p>
            <div class="input-control text"><input type="url" class="skippable" name="website" placeholder="www.something.com" value="<?php echo $Website; ?>" style="width:250px;" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>Facebook URL</p>
            <div class="input-control text"><input type="url" class="skippable" name="fburl" placeholder="www.facebook.com/Username" value="<?php echo $FBURL; ?>" style="width:250px;" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Update" /></p>
        </div>
        <div id="separator" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Company Logo</p>
            <div style="background: #fff;border: 2px dotted #ccc;width: 100%px;text-align: center;">
                <img src="<?php echo $CompanyLogo; ?>" alt="company_logo" style="width: 250px;padding: 10px;"/>
            </div>
            <br><p><input type="file" name="file" class="skippable" /></p>
            <p>Ideal Size: 200pixels X 110pixels</p>
        </div>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>