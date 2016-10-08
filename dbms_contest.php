<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Database Connection</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <?php 
    $conn=mysql_connect("127.0.0.1", "root", "michbharii") or die(mysql_error());
    if($conn)
    {
        if(mysql_select_db("smartourbeta", $conn))
	{
            echo '<h2 class="icon-info" style="color:#008000"> Connection Established Successfully</h2>';
	}   
    }
    else
    {
        echo '<h2 class="icon-warning" style="color:#FF0000"> Could Not Establish Connection</h2>';
    }
    ?>
</div>
</div>
<?php include 'footer.html'; ?>