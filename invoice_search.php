<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Search Invoice</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div class="input-control text" style="width:30%;margin-left:3px;">
        <input type="text" name="searchparam" autofocus onKeyUp="loadResults('resultset','invoiceResults','request.php',this.value)" class="with-helper" placeholder="Serial number or name of applicant" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" maxlength="40" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><a href="" OnClick=onclick="formSubmit()"><button class="btn-search"></a></button>
    </div>
    <div id="resultset" style="float:left;width:95%;height:340px;overflow:auto;"></div>
</div>
</div>
<?php include 'footer.html'; ?>