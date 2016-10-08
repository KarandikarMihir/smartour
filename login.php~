<?php include 'functions.php';
if(isset($_COOKIE['SmarTourID']))
{
    header("location: index.php");
    //echo '<meta http-equiv="refresh" content="0; url=index.php">';
}   
?>
<?php
if($_POST)
{
    dbConnect();
    $Username = SafeString($_POST['username']);
    $Password = SafeString($_POST['password']);
    $result=mysql_query("SELECT * FROM useraccounts WHERE username='$Username' AND password='$Password' AND blockstatus=0") or die(mysql_error());
    $row=mysql_fetch_array($result);
    
    if(mysql_num_rows($result)) 
    {
        mysql_query("INSERT INTO loginhistory(uid, attempt) VALUES(" . $row['srno'] . ",1)") or die(mysql_error()); 
        $hours = time() + 8*60*60;
	$username=encrypt($Username, $Salt);
	$privileges=encrypt($row['actype'], $Salt);
	$identification=encrypt($row['name'], $Salt);
        setcookie('SmarTourID', $username, $hours);
        setcookie('Privileges', $privileges, $hours);
        setcookie('Identification', $identification, $hours);
        header("Cache-Control: post-check=0, pre-check=0",false);
        session_cache_limiter("must-revalidate");
        //header("Location: index.php");
        echo '<meta http-equiv="refresh" content="0; url=index.php">';
    } 
    else
    {
        $error= "Invalid Username or Password";
    }
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
        <script src="js/validation.js"></script>
        <script>
            jQuery(document).ready(function($) {
                if (window.history && window.history.pushState) {
                    $(window).on('popstate', function() {
                        var hashLocation = location.hash;
                        var hashSplit = hashLocation.split("#!/");
                        var hashName = hashSplit[1];
                        if (hashName !== '') {
                            var hash = window.location.hash;
                            if (hash === '') {
                                window.location='login.php';
                                return false;
                            }
                        }
                    });
                    window.history.pushState('forward', null, './#forward');
                }
            });            
        </script>
    </head>
    <body class="metrouicss" style="background-color: #e5e5e5;background-image: url('images/graphy.png');background-repeat: repeat;">
        <div id="masthead">
            <h1 style="color: #fff;text-shadow: 1px 1px 1px #333;margin-top: 45px;">SmarTour Login Terminal</h1>
        </div>
        <div style="width: 981px;background: #fff;border: 1px solid #ccc;overflow: auto;position: relative;margin: auto;padding: 20px;">
            <div style="width: 60%;overflow: auto;float: left;border-right: 1px solid #ccc;">
                <h2 style="color: #60b600;">Login Area</h2>
                <form method="post" action="login.php" autocomplete="off" style="width: 93%;">
                    <div class="input-control text" style="margin-top: 30px;">
                        <input type="text" name="username" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" class="with-helper" placeholder="Username" required autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                        <button class="helper"></button>
                    </div>
                    <div class="input-control password" style="margin-top: 30px;">
                        <input type="password" name="password" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" class="with-helper" placeholder="Password" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                        <button class="helper"></button>
                    </div>
                    <div style="margin-top: 30px">
                        <input type="submit" name="submit" value="Secure Login" />
                        <p style="float: right;margin-top: 5px;color: #ff0000;"><?php if(isset($error)) echo $error; ?></p>
                    </div>
                </form>
            </div>
            <div style="width: 35%;overflow: auto;float: left;padding-left: 20px;">
                <h2 style="color: #60b600;">Forgot Password?</h2>
                <p style="margin-top: 25px;">Forgot Password? Don't worry. Let's <a href="userac_submit_reset.php">fix it!</a></p>                
            </div>
        </div>
    </body>
</html>
