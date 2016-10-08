<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php 
$browser = $_SERVER['HTTP_USER_AGENT'];
if (!preg_match('/Chrome/', $browser)){
    $message='<div style="width: 100%;border: 2px dotted;border-color: transparent #ccc transparent #ccc;background: #ffebeb;color: #B91D47;padding: 5px;text-align: center;">We recommend Google Chrome for the best experience.</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/favicon_main.ico" type="image/x-icon">
        <title>SmarTour</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/grids.css">
        <link rel="stylesheet" type="text/css" href="css/grids-responsive.css">        
        <script src="js/jquery.js"></script>
        <script src="galleria/galleria-1.2.9.min.js"></script>
	<script src="js/dropdown.js"></script>
	<script src="js/input-control.js"></script>
        <script src="js/accordion.js"></script>
        <script src="js/validation.js"></script>
        <script src="js/ajaxTriggers.js"></script>
        <noscript>
            <div style="width: 90%;border: 2px dotted #00b100;height: 150px;background: #ffebeb;margin: 20px auto 20px auto;">
                <h1 style="margin: 20px 0 0 20px;">JavaScript is disabled</h1>
                <p style="margin: 20px 0 0 20px;">Hi, there. It seems that you have turned off JavaScript of your browser. Please turn it on and reload the page for better experience.</p>
            </div>
        </noscript>
    </head>
    <body class="metrouicss">
        <div id="container" style="width:100%;margin:auto;">
            <?php if(isset($message)){ echo $message; } ?>
            <div id="header" style="text-align:right;background: #0f63c1 url('images/SmarTour.png') no-repeat right;height: 90px;background-size: 260px;"></div>
            <div class="nav-bar">
                <div class="nav-bar-inner">
                    <ul class="menu">
                        <li><a href="index.php">Home</a>
                        <li data-role="dropdown"><a href=javascript:;>Master</a>
                            <ul class="dropdown-menu">
                                <li><a href="showcase.php">Showcase</a></li>
                                <li><a href="hotel_master.php">Hotel Master</a></li>
                                <li class="divider"></li>
                                <li><a href="customer.php">Customers</a></li>
                                <li><a href="enquiry.php">Enquiry</a></li>
                                <li><a href="application.php">Application</a></li>
                                <li><a href="hundredtours.php">100 Tours Program</a></li>
                                <li><a href="feedback.php">Feedback Form</a></li>
                            </ul>
                        </li>
                        <li data-role="dropdown"><a href=javascript:;>Transaction</a>
                            <ul class="dropdown-menu">
                                <li><a href="voucher_search.php">Voucher</a></li>
                                <li><a href="receipt.php">Receipt</a></li>
                                <li><a href="invoice_search.php">Invoice</a></li>
                                <li><a href="cancellation.php">Cancellation</a></li>
                                <li class="divider"></li>
                                <li><a href="params.php">Parameters</a></li>
                            </ul>
                        </li>
                        <li><a href="messenger.php">Messenger<div style="display: inline-block;" id="msgcnt">(0)</div></a></li>
                        <li><a href="googlemaps.php">Google Maps</a></li>
                        <li data-role="dropdown"><a href=javascript:;>Housekeeping</a>
                            <ul class="dropdown-menu">
                                <li><a href="activity.php">Activity Log</a></li>
                                <li><a href="userac.php">User Control</a></li>
                                <li><a href="loginhistory.php">Login History</a></li>
                                <li><a href="dbms.php">Database Management</a></li>                                
                            </ul>
                        </li>
                        <li data-role="dropdown"><a href=javascript:;>About</a>
                            <ul class="dropdown-menu">
                                <li><a href="appinfo.php">Application Info</a></li>
                                <li><a href="libraries.php">Libraries</a></li>
                                <li class="divider"></li>
                                <li><a href="developers.php">Who we are</a></li>
                            </ul>
                        </li>
                        <li><a href="reportbugs.php">Report Bugs</a></li>
                        <li><a href="help.php">Help</a></li>
                        <li><a href="logout.php" onclick="return confirm('Click OK to confirm.')">Logout (<?php echo decrypt($_COOKIE['SmarTourID'], $Salt); ?>)</a></li>
                    </ul>
                </div>
            </div>
            <div id="wrapper" style="background-color:#eff4ff;padding: 0 0 0 20px;">
                <div id="Line-Filler" style="width:100%;height:20px;"></div>