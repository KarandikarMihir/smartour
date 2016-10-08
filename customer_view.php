<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=customer.php">';
    die();
}
dbConnect();
$result = mysql_query("SELECT * FROM customer WHERE srno = " . $KEY) or die(mysql_error());
if(!mysql_num_rows($result) || mysql_error()){
    echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
    die();
}
while($row = mysql_fetch_array($result))
{
    $Name = $row['name'];
    $Address = $row['address'];
    $Landline = $row['landline'];
    $Mobile = $row['mobile'];
    $Email = $row['email'];
    $Uid = $row['uid'];
    $Username = iname($Uid);
}	
mysql_free_result($result);
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;"><?php echo $Name; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <table style="width:80%">
        <tr>
            <td>Address</td>
            <td><?php echo $Address; ?></td>
	</tr>
	<tr>
            <td>Landline</td>
            <td><?php echo $Landline; ?></td>
	</tr>
	<tr>
            <td>Mobile</td>
            <td><?php echo $Mobile; ?></td>
	</tr>
	<tr>
            <td>Email</td>
            <td><?php echo $Email; ?></td>
	</tr>
	<tr>
            <td>Added by</td>
            <td><?php echo $Username; ?></td>
	</tr>
    </table>
</div>
</div>
<?php include 'footer.html'; ?>
