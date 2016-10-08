<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=userac.php">';
    die();
}

$UserName = decrypt($_COOKIE['SmarTourID'], $Salt);
$Privileges = decrypt($_COOKIE['Privileges'], $Salt);
if($UserName==$KEY || $Privileges==="administrator")
{
    dbConnect();
    $result = mysql_query("SELECT * FROM useraccounts WHERE srno='$KEY'");
    if(!mysql_num_rows($result) || mysql_error()){
        echo '<meta http-equiv="refresh" content="0; url=userac.php">';
        die();
    }
    
    $row = mysql_fetch_array($result);
    $UserName = $row['username'];
    $Name = $row['name'];
    $Address = $row['address'];
    $Contact = $row['contact'];
    $DOB = $row['dob'];
}
else
{
    //header('Location : index.php');   
    echo '<meta http-equiv="refresh" content="0; url=index.php">';
}
?>
<?php
if($_POST)
{
    dbConnect();
    $PassWord = SafeString($_POST['password']);
    $PassWordCon = SafeString($_POST['passwordcon']);
    $Privileges = SafeString($_POST['actype']);
    $Name = SafeString($_POST['name']);
    $Address = SafeString($_POST['address']);
    $Contact = SafeString($_POST['contact']);
    $DOB = SafeString($_POST['dob']);
    if($PassWord === $PassWordCon) {
        mysql_query("UPDATE useraccounts SET password='$PassWord', actype='$Privileges', name='$Name', address='$Address', contact='$Contact', dob='$DOB' WHERE srno=$KEY") or die(mysql_errno());
    }
    //header('location: userac.php');
    echo '<meta http-equiv="refresh" content="0; url=userac.php">';
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Account: <?php echo $UserName; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="userac_update.php?KEY=<?php echo $KEY; ?>">
    <div style="float:left;width:250px">
        <p>Name</p>
        <div class="input-control text"><input type="text" value="<?php echo $UserName; ?>" style="width:250px;" maxlength="40"  name="username" disabled spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>New Password</p>
        <div class="input-control text"><input type="password" class="password" id="npwd" maxlength="20" autofocus  name="password" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
        <p>Confirm Password</p>
        <div class="input-control text"><input type="password" class="password" id="cpwd" maxlength="20" name="passwordcon" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
        <?php
        if($Privileges==="Administrator") 
        {
            echo '<p>Privileges</p>';
            echo '<div class="input-control select">';
            echo '<select maxlength="13" name="actype">';
            echo '<option>Administrator</option>';
            echo '<option>User</option>';
            echo '</select>';
            echo '</div>';
        }
        else
        {
            echo '<p>Privileges</p>';
            echo '<div class="input-control select">';
            echo '<select maxlength="13" name="actype">';
            echo '<option>' . $Privileges . '</option>';
            echo '</select>';
            echo '</div>';
        }
        ?>
        </div>
        <div id="separator" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Name</p>
            <div class="input-control text"><input type="text" class="validate-name" value="<?php echo $Name; ?>" style="width:250px;" maxlength="40" name="name" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Address</p>
            <div class="input-control text"><input type="text" value="<?php echo $Address; ?>" style="width:250px;" maxlength="300" name="address" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Contact</p>
            <div class="input-control text"><input type="phone" value="<?php echo $Contact; ?>" style="width:250px;" maxlength="10" name="contact" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Date of Birth</p>
            <div class="input-control text"><input type="date" value="<?php echo $DOB; ?>" style="width:250px;height:32px;outline:0;font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;"  maxlength="11"  name="dob" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Update User" /></p>
        </div>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>
