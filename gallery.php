<?php include 'functions.php'; ?>
<?php SecurityCheck();
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=showcase.php">';
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/favicon_main.ico" type="image/x-icon">
        <title>Photo Gallery</title>
        <script src="js/jquery.js"></script>
        <script src="galleria/galleria-1.2.9.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <style>
            #galleria{ width: 100%; height: 600px; background: #000; margin: 0; }
        </style>
    </head>
    <body class="metrouicss" style="background-image:url('images/grid.png');background-repeat:repeat;">
        <div id="container" style="width:100%;margin:auto;">
            <div style="color:#FFF;-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.2);box-shadow: 0 1px 3px rgba(0,0,0,.2);">
                <div id="galleria">
                <?php
                dbConnect();
                $result = mysql_query("SELECT * FROM imagelist WHERE hid=$KEY") or die(mysql_error());
                if(!mysql_num_rows($result)){
                    echo '<meta http-equiv="refresh" content="0; url=showcase.php">';
                    die();
                }                
                while($row=mysql_fetch_array($result))
                {
                        echo'<a href="' . $row['imagepath'] . '"><img src="' . $row['imagepath'] . '" data-title="' . $row['caption'] . '" data-description="' . $row['description'] . '" data-big="' . $row['imagepath'] . '"></a>';
                }
                ?>
                </div>
                <script>
                    Galleria.loadTheme('galleria/themes/classic/galleria.classic.min.js');
                    Galleria.run("#galleria");
                </script>
            </div>
        </div>
    </body>
</html>
            