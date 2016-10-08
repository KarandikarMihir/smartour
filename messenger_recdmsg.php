<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Message History</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:95%;height:340px;overflow:auto;">
        <table class="hovered" style="width:100%">
            <?php
            dbConnect();
            $thisguy = decrypt($_COOKIE['Identification'], $Salt);
            $result = mysql_query("SELECT * FROM messenger WHERE recipient='" . $thisguy . "'");
            if(!mysql_num_rows($result))
            {
                echo '<tr><td colspan="3" align="center"><h3>***No Messages Found***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' message(s) so far</td></tr>';
                echo '<tr><td style="width:100px;font-weight:bold;">No.</td><td style="width:325px;font-weight:bold;">Sender</td><td style="width:275px;font-weight:bold;">Time Stamp</td></tr>';
                $i=1;
                while($row = mysql_fetch_array($result))
                {
                    echo '<tr>';
                    echo '<td>' . $i++ . '</td>';
                    echo '<td><a href="messenger_showmsg.php?KEY=' . $row['sender'] . '">' . $row['sender'] . '</a></td>';
                    echo '<td>' . $row['timestamp'] . '</td>';
                    echo '</tr>';
                }
            }
        ?>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>