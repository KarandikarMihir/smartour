<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
    die();
}
dbConnect();
$result = mysql_query("SELECT enquiry.srno, name, destination, address, landline, mobile, email, timestamp, enqfor, enqmode, paxnos, fromdate, todate FROM enquiry, customer WHERE enquiry.cid=customer.srno AND enquiry.srno = " . $KEY) or die(mysql_error());
if(!mysql_num_rows($result) || mysql_error()){
    echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
    die();
}
while($row = mysql_fetch_array($result))
{
    $Destination = $row['destination']; 
    $EnqDate = $row['timestamp'];
    $EnqFor = $row['enqfor'];
    $EnqMode = $row['enqmode'];
    $Name = $row['name'];
    $Address = $row['address'];
    $Landline = $row['landline'];
    $Mobile = $row['mobile'];
    $Email = $row['email'];
    $PaxNos = intval($row['paxnos']);
    $FromDate = $row['fromdate'];
    $ToDate = $row['todate'];
}	
mysql_free_result($result);
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;"><?php echo $Name; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <table style="width:80%">
        <tr>
            <td>Enquiry Date</td>
            <td><?php echo date('l jS \of F Y h:i:s A', strtotime($EnqDate)); ?></td>
	</tr>        
        <tr>
            <td>Enquiry For</td>
            <td><?php echo $EnqFor; ?></td>
	</tr>        
        <tr>
            <td>Enquiry Mode</td>
            <td><?php echo $EnqMode; ?></td>
	</tr>
        <tr>
            <td>No of persons</td>
            <td><?php echo $PaxNos; ?></td>
	</tr>
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
            <td>Destination</td>
            <td><?php echo $Destination; ?></td>
	</tr>
	<tr>
            <td>From</td>
            <td><?php echo date("d M Y", strtotime($FromDate)); ?></td>
	</tr>
	<tr>
            <td>To</td>
            <td><?php echo date("d M Y", strtotime($ToDate)); ?></td>
	</tr>
	<tr>
            <td>Added By</td>
            <td><?php echo decrypt($_COOKIE['SmarTourID'], $Salt); ?></td>
	</tr>        
    </table>
</div>
</div>
<?php include 'footer.html'; ?>
