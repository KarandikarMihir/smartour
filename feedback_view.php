<?php include 'header.php'; ?>
<?php
{
    $KEY = $_REQUEST['KEY'];
    $Name = $_REQUEST['Name'];
    dbConnect();
    $result = mysql_query("SELECT * FROM feedback WHERE appno = " . $KEY) or die(mysql_error());
    while($row = mysql_fetch_array($result))
    {
        $q1 = $row['q1']; 
        $q2 = $row['q2'];
        $q3 = $row['q3'];
        $q4 = $row['q4'];
        $Remarks = $row['remarks'];
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;"><?php echo $Name; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <table style="width:90%">
        <tr>
            <td style="width:50%;">Are you a regular customer of Mihir Tourism?</td>
            <td><?php echo $q1; ?></td>
        </tr>
        <tr>
            <td>Are you satisfied with our service?</td>
            <td><?php echo $q2; ?></td>
        </tr>
        <tr>
            <td>Are you satisfied with the hotel's service?</td>
            <td><?php echo $q3; ?></td>
        </tr>
        <tr>
            <td>Whether sufficient information was provided?</td>
            <td><?php echo $q4; ?></td>
        </tr>
        <tr>
            <td>Specific comments (if any)</td>
            <td><?php echo $Remarks; ?></td>
        </tr>
    </table>
</div>
</div>
<?php include 'footer.html'; ?>