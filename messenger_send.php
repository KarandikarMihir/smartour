<?php include 'header.php'; ?>
<?php
if ($_POST) {
    dbConnect();
    $result = mysql_query("INSERT INTO messenger(message, sender, recipient) VALUES('" . $_POST['message'] . "','" . decrypt($_COOKIE['Identification'], $Salt) . "','" . $_POST['recipient'] . "')") or die(mysql_error());
    if($result){
        $success=1;
    }
    else{
        $success=0;
    }
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Send Message</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <?php
    if(isset($success)){
        if($success){
            echo '<p style="padding: 10px;margin-bottom: 25px;background: #ebebff;border: solid 1px #0000ff;width: 95%;"><span class="label info">Note</span> Your message has been sent to <b>'.$_POST['recipient'].'</b></p>';
            echo '<meta http-equiv="refresh" content="2">';
        }
        else{
            echo '<p style="padding: 10px;margin-bottom: 25px;background: #ffebeb;border: solid 1px #FF0000;width: 95%;"><span class="label info">Note</span> Server failed to send the message to <b>'.$_POST['recipient'].'</b></p>';
            echo '<meta http-equiv="refresh" content="2">';
        }
    }
    dbConnect();
    $result = mysql_query("SELECT username, name FROM useraccounts") or die(mysql_error());
    $UserName = decrypt($_COOKIE['SmarTourID'], $Salt);
    ?>
    <form method="post" action="messenger_send.php">
        <div class="input-control select">
            <select style="width:50%;font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" autofocus required name="recipient">
                <?php
                while ($row = mysql_fetch_array($result)) {
                    if (!($UserName == $row['username']))
                        echo '<option>' . $row['name'] . '</option>';
                }
                mysql_free_result($result);
                ?>
            </select>
        </div>
        <div class="input-control textarea">
            <textarea name="message" placeholder="..your message goes here" style="width:50%;height:200px;resize: none;font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;"></textarea>
        </div>
        <input type="submit" name="submit" value="Send" />
    </form>
</div>
</div>
<?php include 'footer.html'; ?>