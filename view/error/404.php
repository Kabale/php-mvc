<?php ob_start() ?>   
<img class='displayed' src='/public/img/404.gif' alt='404 not found' style='display:block;margin-left:auto;margin-right:auto;'>

<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>

