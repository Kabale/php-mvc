<?php ob_start() ?>   
<img class='displayed' src='/public/img/503.jpg' alt='503 under construct' style='display:block;margin-left:auto;margin-right:auto;'>


<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>

