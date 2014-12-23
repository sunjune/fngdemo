<?php

if (!empty($_REQUEST["password"])) {
    if ($_REQUEST["password"] === 'fngame') {

        setcookie("passgate", 'asdjfpaodf', 0, '', '', false, true);

        header("Refresh:0; URL=/");
        exit;
    } else {
        setcookie("passgate", "");

        header("Refresh:0; URL=/");
        exit;
    }
}
header("Refresh:0; URL=/");
exit;
?>
