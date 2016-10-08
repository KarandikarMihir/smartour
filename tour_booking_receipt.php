<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Tour Receipt</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:40%">
        <h2>Task Pane</h2>
        <hr align="left" style="width:80%">
        <div class="page-sidebar" style="width:80%;height:auto;">
            <ul>
                <li class="sticker sticker-color-yellow"><a href="tour_booking_search.php"><i class="icon-file"></i><span style="padding: 5px 20px 5px 10px;">Append</span></a></li>
                <li class="sticker sticker-color-green"><a href="javascript:location.reload(true);"><i class="icon-loop"></i><span style="padding: 5px 20px 5px 10px;">Refresh</span></a></li>
                <li class="sticker sticker-color-red"><a href="tour_receipt_delete.php"><i class="icon-remove"></i><span style="padding: 5px 20px 5px 10px;">Cancel</span></a></li>
            </ul>
        </div>
    </div>
    <div style="padding-top:10px;">
        <div class="input-control text" style="width:55%;float:left;">
            <input type="text" name="searchparam" onKeyUp="loadResults('resultset','tourRcptResults','request.php',this.value)" class="with-helper" placeholder="Serial number or name on Receipt" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" maxlength="40" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><button class="btn-search"></button>
        </div>
    </div>
    <div id="resultset" style="float:left;width:55%;height:300px;overflow:auto;">
        <?php
        dbConnect();
        $result = mysql_query("SELECT tour_receipt.srno as rno, tour_receipt.cancelflag, customer.name as cname,tour.name as tname,tour_receipt.amount FROM customer, application_tour, tour, tour_receipt WHERE tour_receipt.aid = application_tour.srno and application_tour.cid = customer.srno and application_tour.tid=tour.srno ORDER BY tour_receipt.srno DESC");
	?>
        <table class="hovered" style="width:100%">
            <?php
            if(!mysql_num_rows($result))
            {
                 echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
                 echo '</table>';
            }
            else
            {
                echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Tour Name</b></td><td><b>Amount</b></td><td><b>Action</b></td></tr>';
                // printing table rows
                while($row = mysql_fetch_array($result))
                {
                    if($row['cancelflag']==1)
                        echo '<tr style="background: #ffe8cb;" title="Cancelled Receipt">';
                    else
                        echo '<tr>';
                    echo '<td>' . $row['rno'] . '</td>';
                    echo '<td>' . $row['cname'] . '</td>';
                    echo '<td>' . $row['tname'] . '</td>';
                    echo '<td>Rs. ' . $row['amount'] . '</td>';
                    if($row['cancelflag']==1)
                        echo '<td>Cancelled</td>';
                    else                    
                        echo '<td><a href="tour_receipt_view.php?KEY=' . $row['rno'] . '" target="_blank">View</a></td>';
                    echo '</tr>';
                }
            }
?>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>