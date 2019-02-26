<?php
    ob_start()
?>
    <div class="container">
        <h1>Index</h1>
       
    </div>
<?php
    $content = ob_get_clean();
    include_once "template.php";
?>