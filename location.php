<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Location Directory</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float: left;width: 30%;height: 340px;overflow: hidden;margin-right: 20px;">
        <div style="width: 100%;padding: 10px;text-align: center;background: #cde3fb;">
            <p style="margin: 0;"><a href="javascript:;" onClick="$('#new-city').slideDown();">Add New City</a></p>
        </div>
        <div id="new-city" style="width: 100%;position: relative;text-align: right;padding: 10px;margin-top: 10px;background: #fff;border: 1px dotted #ccc;display: none;">
            <div class="input-control text"><input type="text" name="newcity" id="newcity" maxlength="50" spellcheck="false" placeholder="City Name" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <div class="input-control select">
                <select style="width: 100%;" name="state" id="state">
                <?php
                    dbConnect();
                    $result = mysql_query("SELECT srno, name FROM statelist ORDER BY name ASC") or die(mysql_error());
                    while($row = mysql_fetch_array($result)){
                        echo '<option value="'. $row['srno'] .'">' . $row['name'] . '</option>';
                    }
                    mysql_free_result($result);
                ?>
                </select>
            </div>
            <button onClick="addcity();" class="bg-color-blueDark fg-color-white" style="margin: 0;">Add City</button>
            <button style="margin: 0;" onClick="$('#new-city').slideUp();">Cancel</button>
        </div>        
        <div style="width: 100%;margin-top: 10px;max-height: 300px;overflow: auto;">
            <table class="hovered" style="width:100%">
            <?php
            dbConnect();
            $result = mysql_query("SELECT srno, name FROM citylist ORDER BY name ASC;");
            ?>
            <?php
            if(!mysql_num_rows($result))
            {
                echo '<tr><td style="text-align: center;"><h3>***No Records Found***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td style="font-weight:bold;width: 70%;">Location</td><td style="font-weight:bold;">Action</td></tr>';
                while($row = mysql_fetch_array($result))
		{
                    $arr = explode(' ', $row['name']);
                    $SearchString = implode('+', $arr);
                    echo '<tr>';
                    echo '<td><a href="https://www.google.co.in/#q=' . $SearchString . '" target="_blank">' . $row['name'] . '</a></td>';
                    if(decrypt($_COOKIE['Privileges'], $Salt)=="administrator")
                    {
                        echo '<td><a href="hotel_db_location_delete.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Are you sure you want to delete this location?\')) return true; else return false;">Delete</a></td>';
                    }
                    else
                    {
                        echo '<td>Delete</td>';
                    }
                    echo '</tr>';
		}
		mysql_free_result($result);
                $SearchString='';
            }
            ?>
            </table>
        </div>
    </div>
    <div style="float: left;width: 30%;height: 340px;overflow: hidden;margin-right: 20px;">
        <div style="width: 100%;padding: 10px;text-align: center;background: #cde3fb;">
            <p style="margin: 0;"><a href="javascript:;" onClick="$('#new-state').slideDown();">Add New State</a></p>
        </div>
        <div id="new-state" style="width: 100%;position: relative;text-align: right;padding: 10px;margin-top: 10px;background: #fff;border: 1px dotted #ccc;display: none;">
            <div class="input-control text"><input type="text" name="state" id="newstate" maxlength="50" spellcheck="false" placeholder="State Name" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <div class="input-control select">
                <select style="width: 100%;" name="country" id="country">
                    <?php
                    dbConnect();
                    $result = mysql_query("SELECT srno, name FROM countrylist ORDER BY name ASC") or die(mysql_error());
                    while($row = mysql_fetch_array($result)){
                        echo '<option value="'. $row['srno'] .'">' . $row['name'] . '</option>';
                    }
                    mysql_free_result($result);
                    ?>  
                    </select>
            </div>
            <button onClick="addstate();" class="bg-color-blueDark fg-color-white" style="margin: 0;">Add State</button>
            <button style="margin: 0;" onClick="$('#new-state').slideUp();">Cancel</button>
        </div>          
        <div style="width: 100%;margin-top: 10px;max-height: 300px;overflow: auto;">
            <table class="hovered" style="width:100%">
            <?php
            dbConnect();
            $result = mysql_query("SELECT srno, name FROM statelist ORDER BY name ASC;");
            ?>
            <?php
            if(!mysql_num_rows($result))
            {
                echo '<tr><td style="text-align: center;"><h3>***No Records Found***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td style="font-weight:bold;width: 70%;">State Name</td><td style="font-weight:bold;">Action</td></tr>';
                while($row = mysql_fetch_array($result))
		{
                    $arr = explode(' ', $row['name']);
                    $SearchString = implode('+', $arr);
                    echo '<tr>';
                    echo '<td><a href="https://www.google.co.in/#q=' . $SearchString . '" target="_blank">' . $row['name'] . '</a></td>';
                    if(decrypt($_COOKIE['Privileges'], $Salt)=="administrator")
                    {
                        echo '<td><a href="hotel_db_state_delete.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Deleting a State will delete corresponding Cities too. Click OK to confirm action\')) return true; else return false;">Delete</a></td>';
                    }
                    else
                    {
                        echo '<td>Delete</td>';
                    }
                    echo '</tr>';
		}
		mysql_free_result($result);
                $SearchString='';
            }
            ?>
            </table>
        </div>
    </div>
    <div style="float: left;width: 30%;height: 340px;overflow: hidden;margin-right: 20px;">
        <div style="width: 100%;padding: 10px;text-align: center;background: #cde3fb;">
            <p style="margin: 0;"><a href="javascript:;" onClick="$('#new-country').slideDown();">Add New Country</a></p>
        </div>
        <div id="new-country" style="width: 100%;position: relative;text-align: right;padding: 10px;margin-top: 10px;background: #fff;border: 1px dotted #ccc;display: none;">
            <div class="input-control text"><input type="text" name="country" id="newcountry" maxlength="50" spellcheck="false" placeholder="Country Name" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <button onClick="addcountry();" class="bg-color-blueDark fg-color-white" style="margin: 0;">Add Country</button>
            <button style="margin: 0;" onClick="$('#new-country').slideUp();">Cancel</button>
        </div>          
        <div style="width: 100%;margin-top: 10px;max-height: 300px;overflow: auto;">
            <table class="hovered" style="width:100%">
            <?php
            dbConnect();
            $result = mysql_query("SELECT srno, name FROM countrylist ORDER BY name ASC;");
            ?>
            <?php
            if(!mysql_num_rows($result))
            {
                echo '<tr><td style="text-align: center;"><h3>***No Records Found***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td style="font-weight:bold;width: 70%;">State Name</td><td style="font-weight:bold;">Action</td></tr>';
                while($row = mysql_fetch_array($result))
		{
                    $arr = explode(' ', $row['name']);
                    $SearchString = implode('+', $arr);
                    echo '<tr>';
                    echo '<td><a href="https://www.google.co.in/#q=' . $SearchString . '" target="_blank">' . $row['name'] . '</a></td>';
                    if(decrypt($_COOKIE['Privileges'], $Salt)=="administrator")
                    {
                        echo '<td><a href="hotel_db_country_delete.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Deleting a Country will delete corresponding States and Cities too. Click OK to confirm action\')) return true; else return false;">Delete</a></td>';
                    }
                    else
                    {
                        echo '<td>Delete</td>';
                    }
                    echo '</tr>';
		}
		mysql_free_result($result);
                $SearchString='';
            }
            ?>
            </table>
        </div>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>