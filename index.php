<?php
if(!(isset($_COOKIE['SmarTourID']))) 
{
    header("Location: login.php");
    //echo '<meta http-equiv="refresh" content="0; url=login.php">';
    die();
}
?>
<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px">Home</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px;">
    <div class="pure-g">
        <div class="pure-u-1-2" style="padding-right: 10px;">
            <h2 class="fg-color-redLight" style="padding-bottom: 10px;border-bottom: 2px dotted #ccc;">Hello <?php echo decrypt($_COOKIE['SmarTourID'], $Salt); ?>. Welcome to SmarTour.</h2>
            <p style="text-align: justify;">Here are some resources on the right hand side of yours to help you get started. Should you face any trouble, you can always seek for <a href="help.php">help</a> or <a href="messenger.php">contact admin</a>. Have a nice day!</p>
            <p style="text-align: right;"><img src="images/welcomebot.png" alt="welcomebot" /></p>
        </div>
        <div class="pure-u-1-2" style="padding: 0 10px;">
            <div class="enquiries" style="width: 100%;overflow: auto;cursor: pointer;background: #fbeaf1;padding: 10px 0 10px 20px;margin-top: 15px;position: relative;" onclick="location.href = 'enquiry_track.php';">
                <h2 style="color: inherit;">Track enquiries</h2>
                <p id="enqtrk" style="color: inherit;">take a quick glance at them</p>
                <h1 style="position: absolute;right: 10px;top: 10px;color: inherit;"><i class="icon-arrow-right-3" title="You can manage your enquiries here"></i></h1>
            </div>
            <div class="payments" style="width: 100%;overflow: auto;cursor: pointer;background: #d5e7ec;padding: 10px 0 10px 20px;margin-top: 15px;position: relative;" onclick="location.href = 'receipt_pending.php';">
                <h2 style="color: inherit;">Track Payments</h2>
                <p id="paychk" style="color: inherit;">click here to proceed</p>
                <h1 style="position: absolute;right: 10px;top: 10px;color: inherit;"><i class="icon-arrow-right-3" title="You can manage your enquiries here"></i></h1>
            </div>
            <div class="feedbacks" style="width: 100%;overflow: auto;cursor: pointer;background: #D6F5D6;padding: 10px 0 10px 20px;margin-top: 15px;position: relative;" onclick="location.href = 'feedback.php';">
                <h2 style="color: inherit;">Track Feedback</h2>
                <p id="feedbk" style="color: inherit;">get ready to get criticized</p>
                <h1 style="position: absolute;right: 10px;top: 10px;color: inherit;"><i class="icon-arrow-right-3" title="You can manage your enquiries here"></i></h1>
            </div>            
        </div>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>
