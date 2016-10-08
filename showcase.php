<?php include 'header.php'; ?>
<?php
if($_POST)
{
  $KEY=$_POST['searchparam'];
  //header('Location: showcase_results.php?KEY=' . $KEY);
  echo '<meta http-equiv="refresh" content="0; url=showcase_results.php?KEY=' . $KEY . '">';
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Hotel Showcase</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div class="input-control text" style="width:30%;margin-left:3px;">
        <input type="text" name="searchparam" list="hotellist" autofocus required oninput="loadResults('resultset','showcaseResults','request.php',this.value)" placeholder="Search Hotel" class="with-helper" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><a href="javascript:;"><button class="btn-search"></button></a>
        <datalist id="hotellist" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;">
            <?php
            dbConnect();
            $result=mysql_query("SELECT name FROM hotellist ORDER BY name") or die(mysql_error());
            while($row = mysql_fetch_array($result))
            {
                echo '<option value="' . $row['name'] . '">';
            }
            mysql_free_result($result);
            ?>
        </datalist>        
    </div>
    <p style="width: 30%;text-align: right;margin: 2px;"><a href="javascript:;" onclick="alert('For city-wise results:\nPrefix a colon to the city name.\n\nEg. :Pune\n\nFor all results:\nJust type in a *')">[Filter]</a></p>
    <div id="resultset" style="float:left;width:95%;height:300px;overflow:auto;"></div>
</div>
</div>
<?php include 'footer.html'; ?>