<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">User Control</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div id="resultset">
    <h2> Hello, <?php echo decrypt($_COOKIE['Identification'], $Salt); ?>. You are logged in as "<?php echo decrypt($_COOKIE['SmarTourID'], $Salt);?>".</h2>
    <p>Here's the list of System Users. You can modify the list, given that you have enough privileges.</p>
    <div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
    <div style="float:left;width:100%;height:200px;overflow:auto;">
        <table  class="hovered" style="width:90%">
            <?php
            dbConnect();
            $result = mysql_query("SELECT * FROM useraccounts ORDER BY srno Asc;");
            if(!mysql_num_rows($result))
            {
                echo '<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
		echo '</table>';
            }
            else
            {
                echo '<tr><td colspan="8" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' User(s) in the database</td></tr>';
                echo '<tr><td style="width:50px;font-weight:bold;">No.</td><td style="width:250px;font-weight:bold;">Name</td><td style="width:150px;font-weight:bold;">Username</td><td style="width:150px;font-weight:bold;">Privileges</td><td colspan="4" style="width:200px;font-weight:bold;">Actions</td></tr>';
		while($row = mysql_fetch_array($result))
		{
                    echo '<tr>';
                    echo '<td>' . $row['srno'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['actype'] . '</td>';
                    if(decrypt($_COOKIE['Privileges'], $Salt)==="administrator")
                    {
                        echo '<td><a href="userac_view.php?KEY=' . $row['srno'] . '">View</a></td>';
                        echo '<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'resetUser\',\'request.php\',\'' . $row['username'] . '\',\'resultset\'); } else return false;">Reset</a></td>';
                        if($row['blockstatus']==0)
                            echo '<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'blockUser\',\'request.php\',\'' . $row['username'] . '\',\'resultset\'); } else return false;">Block</a></td>';
                        else
                            echo '<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'unblockUser\',\'request.php\',\'' . $row['username'] . '\',\'resultset\'); } else return false;">Unblock</a></td>';
			echo '</tr>';
                    }
                    else
                    {
                        echo '<td><a href="userac_view.php?KEY=' . $row['srno'] . '">View</a></td>';
                        echo '<td>Delete</td>';
                        echo '<td>Recover</td>';
                        echo '</tr>';
                    }
		}
            }
            if(decrypt($_COOKIE['Privileges'], $Salt)=="administrator")
            {
                echo '<tr><td></td><td colspan="8" style="color:green;"><i class="icon-plus" style="color:green;"></i><a href="userac_new.php">Add New User</a></td></tr>';
            }
            ?>
        </table>
    </div>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>