<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Receipt</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="receipt_app_results.php">
        <div class="input-control text" style="width:30%;margin-left:3px;">
            <input type="text" name="searchparam" onKeyUp="loadResults('resultset','rcptAppResults','request.php',this.value)" class="with-helper" placeholder="Serial number or name of applicant" maxlength="40" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><a href="" OnClick=onclick="formSubmit()"><button class="btn-search"></a></button>
        </div>
    </form>
    <div id="resultset" style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
            <?php
            
            dbConnect();
            $result = mysql_query("SELECT application.srno, customer.name, hotellist.name AS hotelname, "
                    . "application.chkin, application.chkout "
                    . "FROM application, enquiry, customer, hotellist, application_amount "
                    . "WHERE application_amount.aid=application.srno AND application_amount.balance_amount>0 "
                    . "AND application.cancelflag=0 AND application.eid=enquiry.srno "
                    . "AND enquiry.cid=customer.srno AND application.hid=hotellist.srno "
                    . "ORDER BY application.srno DESC") or die(mysql_error());
            if(!mysql_num_rows($result))
            {
                echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
                echo '<tr><td style="width:50px;font-weight:bold;">No.</td><td style="width:200px;font-weight:bold;">Name</td><td style="width:150px;font-weight:bold;">Hotel Name</td><td style="width:150px;font-weight:bold;">Check In</td><td style="width:150px;font-weight:bold;">Check Out</td><td style="width:150px;font-weight:bold;">Action</td></tr>';
                while($row = mysql_fetch_array($result))
                {
                    echo '<tr>';
                    echo '<td>' . $row['srno'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['hotelname'] . '</td>';
                    echo '<td>' . $row['chkin'] . '</td>';
                    echo '<td>' . $row['chkout'] . '</td>';
                    echo '<td><a href="receipt_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>