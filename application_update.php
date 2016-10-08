<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Application</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div class="pure-g">
        <div class="pure-u-1">
            <div style="padding: 10px 10px 10px 0;">
                <div class="input-control text" style="width:36%;float:left;">
                    <input type="text" name="searchparam" class="with-helper" onKeyUp="loadResults('resultset','appUpdateResults','request.php',this.value)" placeholder="Serial number or name of applicant" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" maxlength="40" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><button class="btn-search"></button>
                </div>
            </div>            
        </div>
        <div class="pure-u-1" id="resultset" style="padding-right: 10px;height:340px;overflow:auto;">
            <table  class="hovered" style="width:100%">
            <?php
            dbConnect();
            $result = mysql_query("SELECT application.eid, application.srno, customer.name, application.cancelflag FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno ORDER BY application.srno DESC;") or die(mysql_error());
            if(!mysql_num_rows($result))
            {
                echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Hotel</b></td><td><b>Action</b></td></tr>';
                while($row = mysql_fetch_array($result))
                {
                    if($row['cancelflag'])
                        echo '<tr style="background: #ffe8cb;" title="Cancelled Application">';
                    else
                        echo '<tr>';
                    echo '<td>' . $row['srno'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';

                    $result_=mysql_query("SELECT hotellist.name FROM application_hotel, hotellist WHERE application_hotel.aid=" . (int)$row['srno'] . " AND application_hotel.hid=hotellist.srno") or die(mysql_error());
                    $hotelname='';
                    while($row_=  mysql_fetch_array($result_)){
                        $hotelname.=trim($row_['name']) . ', ';
                    }
                    $hotelname = rtrim($hotelname, ", ");

                    if(strlen($hotelname)>30){
                        echo '<td title="' . $hotelname . '">' . substr($hotelname, 0, 30) . '...</td>';
                    }
                    else{
                        echo '<td>' . $hotelname . '</td>';
                    }
                    echo '<td><a href="application_new.php?KEY=' . $row['eid'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Update</a></td>';
                    echo '</tr>';
                }
            }
            mysql_free_result($result);
            ?>
            </table>
        </div>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>