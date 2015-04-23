
<!DOCTYPE html>
<html>
<head>
    <title>Beauty code usage</title>
</head>
    <body>

        <div style="position:absolute; height:64px; width:256px; top:50%; left:50%; margin-top:-32px; margin-left:-128px; font-size:32px;">

        <?php
        require_once('beautyCode.php');

        $bcode = new beautyCode('',6);
        echo $bcode->hash;
        ?>

        </div>

    </body>
</html>


