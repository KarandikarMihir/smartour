<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=userac.php">';
    die();
}

dbConnect();
$result = mysql_query("SELECT * FROM useraccounts WHERE SrNo = " . $KEY);
if(!mysql_num_rows($result) || mysql_error()){
    echo '<meta http-equiv="refresh" content="0; url=userac.php">';
    die();
}

while($row = mysql_fetch_array($result))
{
    $UserName = $row['username']; 
    $AcType = $row['actype'];
    $Name = $row['name'];
    $Address = $row['address'];
    $Contact = $row['contact'];
    $DOB = $row['dob'];
}
mysql_free_result($result);
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;"><?php echo $UserName; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <table style="width:80%">
        <?php
        if(decrypt($_COOKIE['SmarTourID'], $Salt)==$UserName || decrypt($_COOKIE['Privileges'], $Salt)==="Administrator")
        {
            echo '<tr>';
            echo '<td colspan="2" style="text-align: right;"><i class="icon-equalizer"></i><a href="userac_update.php?KEY=' . $KEY . '" onClick="doThis()">Update Info</a></td>';
            echo '</tr>';
        }
        ?>
        <tr>
            <td>Account Privileges</td>
            <td><?php echo $AcType; ?></td>
	</tr>
	<tr>
            <td>Name</td>
            <td><?php echo $Name; ?></td>
	</tr>
	<tr>
            <td>Address</td>
            <td><?php echo $Address; ?></td>
	</tr>
	<tr>
            <td>Contact</td>
            <td><?php echo $Contact; ?></td>
	</tr>
	<tr>
            <td>Date of Birth</td>
            <td><?php echo $DOB; ?></td>
	</tr>
    </table>
</div>
</div>
<?php include 'footer.html'; ?>
