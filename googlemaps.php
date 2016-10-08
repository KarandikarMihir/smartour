<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Google Maps</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div id="binder">
        <form action="http://maps.google.com/maps" method="get" target="_blank">
            <div class="input-control text" style="width:38%;margin-left:3px;display:inline-block;vertical-align:middle;">
                <input type="text" name="saddr" autofocus class="with-helper" placeholder="Destination from Pune, Maharashtra" /><button class="btn-search"></button>
            </div>
            <span style="padding-left:20px"></span><input type="hidden" name="daddr" value="Pune, Maharashtra" /><input type="submit" style="vertical-align:middle;" value="Find your path" />
            <p style="font-size: smaller;color: #ff0000;"><em>*An active Internet connection is a prerequisite.</em></p>
        </form>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>