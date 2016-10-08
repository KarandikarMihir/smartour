<?php include 'header.php'; ?>
<?php
if(decrypt($_COOKIE['Privileges'], $Salt)!== "administrator")
{
  echo '<meta http-equiv="refresh" content="0; url=index.php">';
}
?>
<?php
if ($_POST)
{
    dbConnect(); 
    $UserName = SafeString($_POST['username']); 
    $PassWord = SafeString($_POST['password']);
    $PassWordCon = SafeString($_POST['passwordcon']);
    $Privileges = SafeString($_POST['actype']);
    $Name = SafeString($_POST['name']);
    $Address = SafeString($_POST['address']);
    $Contact = SafeString($_POST['contact']);
    $DOB = SafeString($_POST['dob']);
    $MaxID = mysql_query("SELECT MAX(srno) FROM useraccounts");
    $MaxID = mysql_fetch_array($MaxID, MYSQL_BOTH);
    $MaxID = intval($MaxID[0]) + 1;	
    mysql_query("INSERT INTO useraccounts VALUES(" . $MaxID . ", '" . $UserName . "','" . $PassWord . "','" . $Privileges . "','" . $Name . "','" . $Address . "','" . $Contact . "','" . $DOB . "',0)") or die(mysql_error());
    $MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog");
    $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
    $MaxSr = intval($MaxSr[0]) + 1;
    mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'New $Privileges created','" . date('D, d-M-Y H-i-s T') . "','" . decrypt($_COOKIE['SmarTourID'], $Salt) . "')") or die(mysql_error());
    //header('location: userac.php');
    echo '<meta http-equiv="refresh" content="0; url=userac.php">';
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New User Account</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="userac_new.php" novalidate="novalidate">
    <div style="float:left;width:250px">
        <p>Username <a href="javascript:;" onclick="alert('1. Minimum 5 characters long.\n2. Should start with a letter\n3. Only alphabets, numbers, dot, underscore, hyphen are allowed.\n4. Maximum 20 characters.')">[?]</a></p>
        <div class="input-control text"><input type="text" class="username" maxlength="20" autofocus name="username" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
        <p>Password <a href="javascript:;" onclick="alert('1. Minimum 5 characters long.\n2. Should start with a letter\n3. Only alphabets, numbers, dot, underscore, hyphen are allowed.\n4. Maximum 20 characters.')">[?]</a></p>
        <div class="input-control text"><input class="password" id="npwd" type="password" maxlength="20" name="password" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
        <p>Confirm Password</p>
        <div class="input-control text"><input class="password" id="cpwd" type="password" maxlength="20" name="passwordcon" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
        <p>Privileges</p>
        <div class="input-control select">
            <select name="actype">
                <option>Administrator</option>
                <option>User</option>
            </select>
        </div>
    </div>
        <div id="separator" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Name</p>
            <div class="input-control text"><input type="text" class="validate-name" style="width:250px;" maxlength="40" name="name" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Address</p>
            <div class="input-control text"><input type="text" style="width:250px;" maxlength="300" name="address" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Contact</p>
            <div class="input-control text"><input type="phone" style="width:250px;" maxlength="15" name="contact" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Date of Birth</p>
            <div class="input-control text"><input type="date" name="dob" style="width:250px;height:32px;" maxlength="10" value="1990-01-01" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Create User" /></p>
        </div>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>
