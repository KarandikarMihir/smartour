<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Application</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div class="pure-g">
        <div class="pure-u-1-3">
            <h2>Task Pane</h2>
            <hr align="left" style="width:80%">
            <div class="page-sidebar" style="width:80%;height:auto;">
                <ul>
                    <li class="sticker sticker-color-yellow"><a href="application_enq_search.php"><i class="icon-file"></i><span style="padding: 5px 20px 5px 10px;">Append</span></a></li>
                    <li class="sticker sticker-color-green"><a href="javascript:location.reload(true);"><i class="icon-loop"></i><span style="padding: 5px 20px 5px 10px;">Refresh</span></a></li>
                    <li class="sticker sticker-color-purple"><a href="application_update.php"><i class="icon-equalizer"></i><span style="padding: 5px 20px 5px 10px;">Update</span></a></li>
                    <li class="sticker sticker-color-red"><a href="application_delete.php"><i class="icon-remove"></i><span style="padding: 5px 20px 5px 10px;">Delete</span></a></li>
                </ul>
            </div>            
        </div>    
        <div class="pure-u-2-3" style="padding-right: 10px;">
            <div style="padding-top:10px;">
                <div class="input-control text" style="width:100%;">
                    <input type="text" name="searchparam" onKeyUp="loadResults('resultset','appResults','request.php',this.value)" class="with-helper" placeholder="Serial number or name of applicant" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" maxlength="40" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><button class="btn-search"></button>
                </div>
            </div>
            <div id="resultset" style="width:100%;height:300px;overflow:auto;">
                <?php
                dbConnect();
                $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno ORDER BY application.srno DESC;") or die(mysql_error());
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
                            
                            echo '<td><a href="application_view.php?KEY=' . $row['srno'] . '">View</a></td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </table>
            </div>            
        </div>        
    </div>
</div>
</div>
<?php include 'footer.html'; ?>