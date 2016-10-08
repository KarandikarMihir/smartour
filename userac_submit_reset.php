<?php include 'functions.php'; ?>
<?php
if($_POST)
{
    dbConnect();
    $Username = SafeString($_POST['username']);
    $FullName = SafeString($_POST['fullname']);
    $Address = SafeString($_POST['address']);
    $Contact = SafeString($_POST['contact']);
    $DOB = SafeString($_POST['dob']);
    $MaxID = mysql_query("SELECT MAX(srno) FROM resetrequest");
    $MaxID = mysql_fetch_array($MaxID, MYSQL_BOTH);
    $MaxID = intval($MaxID[0]) + 1;
    mysql_query("INSERT INTO resetrequest VALUES($MaxID, '$Username', '$FullName', '$Address', '$Contact', '$DOB')");
    //header('location: login.php');
    echo '<meta http-equiv="refresh" content="0; url=login.php">';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/favicon_login.ico" type="image/x-icon">
        <title>SmarTour Secure Login</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script src="js/jquery.js"></script>
        <script src="js/input-control.js"></script>
    </head>
    <body class="metrouicss" style="margin: 80px;background: url('images/tiny_grid.png') repeat;">
        <div style="width: 95%;position: relative;margin-top: 20px;margin: auto;background: #fff;padding: 30px;-webkit-box-shadow: 0px 0px 10px 0px #acacac;box-shadow: 0px 0px 10px 0px #acacac;overflow: auto;">
            <h1>Account Recovery</h1>
            <div style="width: 50%;float: left;margin-top: 20px;">
                <form method="post" action="userac_submit_reset.php">
                    <div class="input-control text">
                        <label for="username">Username</label>
                        <input type="text" name="username" autofocus required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    </div>
                    <div class="input-control text">
                        <label for="fullname">Full Name</label>
                        <input type="text" name="fullname" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    </div>
                    <div class="input-control text">
                        <label for="address">Address</label>
                        <input type="text" name="address" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    </div>
                    <div class="input-control text">
                        <label for="contact">Contact</label>
                        <input type="text" name="contact" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    </div>
                    <div class="input-control text">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" style="height: 35px;width: 100%;-webkit-appearance: none;" placeholder="yyyy-mm-dd" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    </div>
                    <input type="submit" name="submit" value="Submit Request" style="float: right;margin: 20px 0 0 0;" />
                </form>
            </div>
            <p style="position: absolute;bottom: 10px;right: 30px;"><a href="login.php">Login page</a></p>
        </div>
    </body>
</html>