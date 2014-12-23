<?php
if (!array_key_exists("passgate", $_COOKIE)) {
    passgate_form();
    exit;
}

function passgate_form() {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>FNG</title>
            <link href="style/style.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <form id="index_login" action="/passgate_login.php" method="post">
                <input type="hidden" name="url" value="">
                    <div class="dl">
                        <div class="lf">
                            <input type="password" name="password" />
                        </div>
                        <div class="lr">
                            <input type="submit" value=" 登 录 " />
                        </div>
                    </div>
            </form>
        </body>
    </html>
    <?php
}
?>
