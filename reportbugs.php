<?php include 'header.php'; ?>
<?php
$error='';
if ($_POST)
{
    dbConnect(); 
    $about = SafeString($_POST['about']); 
    $desc = SafeString($_POST['remarks']);
    
    //*********
    $allowedExts = array("png");
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
            if(file_exists("bugs/" . $_FILES['file']['name']))
            {
                $_FILES['file']['name'] = $_FILES['file']['name'] . time();
            }
            else
            {
                $UploadAt="bugs/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES["file"]["tmp_name"], $UploadAt);
                
                $MaxSr = mysql_query("SELECT MAX(srno) FROM bugs");
                $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
                $MaxSr = intval($MaxSr[0]) + 1;
                mysql_query("INSERT INTO bugs VALUES($MaxSr,'$about','$desc','$UploadAt')") or die(mysql_error());
                
                $MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog");
                $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
                $MaxSr = intval($MaxSr[0]) + 1;
                mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'Bug submitted','" . date('D, d-M-Y H-i-s T') . "','" . decrypt($_COOKIE['SmarTourID'], $Salt) . "')") or die(mysql_error());
            }
        }
    }
    else
    {
        $error="Invalid file";
    }    
    //header('location: index.php');
    echo '<meta http-equiv="refresh" content="0; url=reportbugs.php">';
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px">Report Bugs</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;position: relative;width:100%;display:inline-block;padding-left:70px">
    <p style="width: 80%;">If something's not working properly on SmarTour Beta Release, you've come to the right place. Please send upload a screenshot or informative bug report for troubleshooting. <a href="javascript:;" onclick="alert('For Windows users: \nHit PRINT SCREEN on your keyboard and then PASTE it in MS-Paint to save your screenshot. \n\nFor Linux users:\nHit PRINT SCREEN and then click SAVE. Your screenshot will be saved in PICTURES folder.');">[How to take a screenshot?]</a></p>
    <img src="images/robot.png" alt="borken_bot" style="position: absolute;right: 50px;bottom: 50px;">
    <hr style="width: 80%;float: left;border: 1px solid #d6e2ff;">
    <form method="post" action="reportbugs.php" enctype="multipart/form-data" autocomplete="off" style="display: block;width: 60%;">
        <div style="width: 70%;">
            <p>Bug is about</p>
            <div class="input-control text">
                <input type="text" name="about" list="list" placeholder="Press &darr; to expand" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    <datalist id="list" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;max-height: 200px;">
                        <option>Enquiry</option>
                        <option>Application</option>
                        <option>Showcase</option>
                        <option>Hotel Master</option>
                        <option>Feedback Form</option>
                        <option>Voucher</option>
                        <option>Receipt</option>
                        <option>Invoice</option>
                        <option>Cancellation</option>
                        <option>Messenger</option>
                        <option>Google Maps</option>
                        <option>Activity Log</option>
                        <option>User Control</option>
                        <option>Login History</option>
                        <option>Database Management</option>
                        <option>Login/Logout</option>
                    </datalist>
            </div>
            <p>Additional description</p>
            <div class="input-control textarea">
                <textarea name="remarks" placeholder="description goes here.." required style="min-height: 30px;resize: none;font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;"></textarea>
            </div>
            <p>Attach a screenshot *.png</p>
            <p><input type="file" name="file" style="padding: 5px;font-size: 10pt;background: #fff;border: 1px solid #ccc;width: 100%;" /></p>
            <p style="text-align:right;margin-top: 15px;"><input type="submit" name="submit" value="Update" style="margin: 0;" /></p>
        </div>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>