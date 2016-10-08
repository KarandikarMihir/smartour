<?php include 'header.php'; ?>
<?php
if($_POST)
{
  $KEY=$_POST['searchparam'];
  //header('Location: application_enq_search_results.php?KEY=' . $KEY);
  echo '<meta http-equiv="refresh" content="0; url=application_enq_search_results.php?KEY=' . $KEY . '">';
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Select Customer</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div class="input-control text" style="width:36%;margin-left:3px;">
        <input type="text" name="searchparam" class="with-helper" autofocus onKeyUp="loadResults('resultset','custResults','request.php',this.value)" placeholder="Serial number or name of the customer" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><a href="" OnClick=onclick="formSubmit()"><button class="btn-search"></button></a>
    </div>
    <p><i class="icon-new-tab"></i><a href="customer_new.php?mode=enquiry">Add new customer</a></p>
    <div id="resultset" style="float:left;width:95%;height:340px;overflow:auto;">

    </div>
</div>
</div>
<?php include 'footer.html'; ?>