<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=hotel.php">';
    die();
}
dbConnect();
$result = mysql_query("SELECT hotellist.* ,citylist.name as cityname FROM hotellist, citylist WHERE hotellist.srno = " . $KEY . " and hotellist.cityid = citylist.srno");
if(!mysql_num_rows($result) || mysql_error()){
    echo '<meta http-equiv="refresh" content="0; url=hotel.php">';
    die();
}
while($row = mysql_fetch_array($result))
{
    $Name = $row['name'];
    $NameOnTransaction = $row['name_on_transaction'];
    $AccountDetails = $row['account_details'];
    $CPersonSite = $row['cperson_site'];
    $CPersonOffice = $row['cperson_office'];
    $AddressSite = $row['address_site'];
    $AddressOffice = $row['address_office'];
    $City = $row['city'];
    $Pincode = $row['pincode'];
    $LandlineSite = $row['landline_site'];
    $LandlineOffice = $row['landline_office'];
    $MobileSite = $row['mobile_site'];
    $MobileOffice = $row['mobile_office'];
    $EmailSite = $row['email_site'];
    $EmailOffice = $row['email_office'];
    $ChkIn = $row['chkin_time'];
    $ChkOut = $row['chkout_time'];
    $Commission = $row['commission'];
    $Website = $row['website'];
    $uid = $row['uid'];
    $username = iname($uid);
}
mysql_free_result($result);
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;"><?php echo $Name; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:100%;height:340px;overflow:auto;">
        <table style="width:90%">
            <tr>
                <td colspan="2"><b>Contact Details</b></td>
            </tr>
            <tr>
                <td>Name On Transaction</td>
                <td><?php echo $NameOnTransaction; ?></td>
            </tr>
            <tr>
                <td>Concerned Person (Site)</td>
                <td><?php echo $CPersonSite; ?></td>
            </tr>
            <tr>
                <td>Concerned Person (Office)</td>
                <td><?php echo $CPersonOffice; ?></td>
            </tr>
            <tr>
                <td>Address (Site)</td>
                <td><?php echo $AddressSite; ?></td>
            </tr>
            <tr>
                <td>Address (Office)</td>
                <td><?php echo $AddressOffice; ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td><?php echo $City; ?></td>
            </tr>
            <tr>
                <td>Pincode</td>
                <td><?php echo $Pincode; ?></td>
            </tr>
            <tr>
                <td>Landline (Site)</td>
                <td><?php echo $LandlineSite; ?></td>
            </tr>
            <tr>
                <td>Landline (Office)</td>
                <td><?php echo $LandlineOffice; ?></td>
            </tr>
            <tr>
                <td>Mobile (Site)</td>
                <td><?php echo $MobileSite; ?></td>
            </tr>
            <tr>
                <td>Mobile (Office)</td>
                <td><?php echo $MobileOffice; ?></td>
            </tr>
            <tr>
                <td>Email (Site)</td>
                <td><?php echo $EmailSite; ?></td>
            </tr>
            <tr>
                <td>Email (Office)</td>
                <td><?php echo $EmailOffice; ?></td>
            </tr>
            <tr>
                <td>Website</td>
                <?php
                if(!$Website=='')
                    echo '<td><a href="' . $Website . '" target="_blank">Available</a></td>';
                else
                    echo '<td>Unavailable</td>';
                ?>
            </tr>
            <tr>
                <td colspan="2"><b>Room Types</b></td>
            </tr>
            <?php
                $result = mysql_query("SELECT * FROM roomlist WHERE hid=" . $KEY);
                while($row = mysql_fetch_array($result))
                {
                    echo '<tr>';
                    echo '<td>' . $row['roomtype'] . '</td>';
                    echo '<td>Rate : Rs. ' . $row['rate'] . '</td>';
                    echo '</tr>';
		}
                mysql_free_result($result);
            ?>
            <tr>
                <td colspan="2"><b>Other Details</b></td>
            </tr>
            <tr>
                <td>Check In</td>
                <td><?php echo $ChkIn; ?></td>
            </tr>
            <tr>
                <td>Check Out</td>
                <td><?php echo $ChkOut; ?></td>
            </tr>
            <tr>
                <td>Commission</td>
                <td><?php echo $Commission; ?>%</td>
            </tr>
            <tr>
                <td>Added By</td>
                <td><?php echo $username; ?></td>
            </tr>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>
