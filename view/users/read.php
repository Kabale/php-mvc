<?php ob_start(); ?>

<div id="user">
    <div class="d-block ">
        <label class="font-weight-bold" for="id">Id :</label>
        <span name="id"><?=$user->getId()?></div>
    </div>
 
    <div class="d-block ">
        <label class="font-weight-bold" for="title">Firstname :</label>
        <span name="firstname"><?=$user->getFirstname()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="lastname">Lastname :</label>
        <span name="lastname"><?=$user->getLastname()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="email">Email :</label>
        <span name="email"><?=$user->getEmail()?></div>
    </div>
</div>

<?php
    $title = "Read User";
    $content = ob_get_clean();
    include_once  "./view/template.php";
?>