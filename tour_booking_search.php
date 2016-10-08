<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Receipt</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="receipt_app_results.php">
        <div class="input-control text" style="width:30%;margin-left:3px;">
            <input type="text" name="searchparam" onKeyUp="loadResults('resultset','rcptBookResults','request.php',this.value)" class="with-helper" placeholder="Serial number or name of applicant" maxlength="40" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><a href="" OnClick=onclick="formSubmit()"><button class="btn-search"></a></button>
        </div>
    </form>
    <div id="resultset" style="float:left;width:95%;height:280px;overflow:auto;">
        <table  class="hovered" style="width:100%">
            <?php
            
            dbConnect();
            $result = mysql_query("SELECT application_tour.srno, customer.name as cname, tour.name as tname, application_tour.seats, tour.price, tour.stax FROM application_tour, tour, customer WHERE application_tour.cid=customer.srno AND application_tour.tid=tour.srno ORDER BY application_tour.srno DESC") or die(mysql_error());
            if(!mysql_num_rows($result))
            {
                echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Tour Name</b></td><td><b>Seats</b></td><td><b>Total Amount</b></td><td><b>Balance</b></td><td><b>Action</b></td></tr>';
                while($row = mysql_fetch_array($result))
                {
                    $Price=$row['price'];$STax=$row['stax'];$Seats=$row['seats'];$Srno=$row['srno'];
                    $TotalAmt = ($Price*$Seats)+($STax*$Seats);
                    $result_=mysql_query("SELECT SUM(amount) as total FROM tour_receipt WHERE aid=$Srno AND cancelflag=0") or die(mysql_error());
                    if(mysql_num_rows($result_)){
                        $row_=  mysql_fetch_array($result_);
                        $Sum = $row_['total'];                        
                    }
                    else{
                        $Sum=0;
                    }
                    $Balance = round($TotalAmt - $Sum, 2);
                    echo '<tr>';
                    echo '<td>' . $row['srno'] . '</td>';
                    echo '<td>' . $row['cname'] . '</td>';
                    echo '<td>' . $row['tname'] . '</td>';
                    echo '<td>' . $row['seats'] . '</td>';
                    echo '<td style="text-align: right;">' . number_format($TotalAmt, 2) . '</td>';
                    echo '<td style="text-align: right;">' . $Balance . '</td>';
                    if($Balance>0){
                        echo '<td><a href="tour_receipt_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
                    }
                    else{
                        echo '<td>Done</td>';
                    }
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>