<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Application</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div class="input-control text" style="width:36%;margin-left:3px;">
        <input type="text" name="searchparam" class="with-helper" autofocus onKeyUp="loadResults('resultset','enqAppResults','request.php',this.value)" placeholder="Serial number or name of enquirer" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><a href="" OnClick=onclick="formSubmit()"><button class="btn-search"></button></a>
    </div>
    <div id="resultset" style="float:left;width:95%;height:340px;overflow:auto;">
        <table class="hovered" style="width:100%">
        <?php
        dbConnect();
        $result = mysql_query("SELECT enquiry.srno, customer.name, enquiry.destination, customer.mobile FROM enquiry, customer WHERE enquiry.cid=customer.srno AND applock=0 ORDER BY enquiry.srno Desc;") or die(mysql_error());
        if(!mysql_num_rows($result))
        {
            echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
            echo '</table>';
        }
        else
        {
            echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Destination</b></td><td><b>Mobile</b></td><td><b>Action</b></td></tr>';
            while($row = mysql_fetch_array($result))
            {
                echo '<td>' . $row['srno'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['destination'] . '</td>';
                echo '<td>' . $row['mobile'] . '</td>';
                echo '<td><a href="application_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
                echo '</tr>';
            }
        }
        ?>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>