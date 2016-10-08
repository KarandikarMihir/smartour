<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Messenger</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:40%">
        <h2>Task Pane</h2>
        <hr align="left" style="width:80%">
        <div class="page-sidebar" style="width:80%;height:auto;">
            <ul>
                <li class="sticker sticker-color-darken"><a href="messenger_send.php"><i class="icon-reply-2"></i><span style="padding: 5px 20px 5px 10px;">Send New Message</span></a></li>
  		<li class="sticker sticker-color-yellow"><a href="messenger_recdmsg.php"><i class=" icon-comments-2"></i><span style="padding: 5px 20px 5px 10px;">View Conversations</span></a></li>
		<li class="sticker sticker-color-green"><a href="messenger_deleteall.php" onclick="return confirm('Messages cannot be retrieved back. Click OK to confirm.')"><i class="icon-remove"></i><span style="padding: 5px 20px 5px 10px;">Delete All Messages</span></a></li>
            </ul>
        </div>
    </div>
    <div style="float:left;width:55%;height:340px;overflow:auto;">
        <?php
        dbConnect();
        $result = mysql_query("SELECT * FROM messenger WHERE recipient='" . trim(decrypt($_COOKIE['Identification'], $Salt)) . "' AND readstatus=0") or die(mysql_error());
	?>
        <table  class="hovered" style="width:100%">
            <?php
            if(!mysql_num_rows($result))
            {
                echo '<tr><td colspan="3" align="center"><h3>***No New Messages***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td style="width:50px;font-weight:bold;">From</td><td style="width:200px;font-weight:bold;">Time Stamp</td></tr>';
                while($row = mysql_fetch_array($result))
                {
                    echo '<tr>';
                    echo '<td><a href="messenger_showmsg.php?KEY=' . $row['sender'] . '">' . $row['sender'] . '</a></td>';
                    echo '<td>' . $row['timestamp'] . '</td>';
                    echo '</tr>';
		}
                mysql_free_result($result);
            }
            ?>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>