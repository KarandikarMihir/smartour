<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Cancel Receipt</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div id="resultset" style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
	<?php
        dbConnect();
        $result = mysql_query("SELECT tour_receipt.srno, tour_receipt.cancelflag, customer.name as cname, tour.name as tname, tour_receipt.amount, tour_receipt.paymode FROM tour_receipt, tour, customer, application_tour WHERE tour_receipt.aid=application_tour.srno AND application_tour.cid = customer.srno AND application_tour.tid=tour.srno ORDER BY tour_receipt.srno DESC;") or die(mysql_error());
        if(!mysql_num_rows($result))
        {
            echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
            echo '</table>';
        }
        else
        {
            echo '<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
            echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Hotel Name</b></td><td><b>Amount</b></td><td><b>Payment Mode</b></td><td><b>Action</b></td></tr>';
            while($row = mysql_fetch_array($result))
            {
                if($row['cancelflag']==1)
                    echo '<tr style="background: #ffe8cb;" title="Cancelled Receipt">';
                else
                    echo '<tr>';
                echo '<td>' . $row['srno'] . '</td>';
                echo '<td>' . $row['cname'] . '</td>';
                echo '<td>' . $row['tname'] . '</td>';
                echo '<td>' . $row['amount'] . '</td>';
                echo '<td>' . getMode($row['paymode']) . '</td>';
                if($row['cancelflag']==1)
                    echo '<td>Cancelled</td>';
                else
                    echo '<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'deleteTourRcpt\',\'request.php\',\'' . $row['srno'] . '\',\'resultset\'); } else return false;">Delete</a></td>';
                echo '</tr>';
            }
        }
        ?>
        </table>
    </form>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>