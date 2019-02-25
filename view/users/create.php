<?php ob_start() ?>   
<form method="post">
    <div class="col-md-12" style="display:none;">
        <input name="id" class="form-controle" value="<?= $user->getId() ?>">
    </div>
    <div class="col-md-12">
        <label for="firstname">Firstname</label>
        <input name="firstname" class="form-control" value="<?= $user->getFirstname() ?>">
    </div>
    <div class="col-md-12">
        <label for="lastname">Lastname</label>
        <input name="lastname" class="form-control" value="<?= $user->getLastname() ?>">
    </div>
    <div class="col-md-12">
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" value="<?= $user->getEmail() ?>">
    </div>
    <div class="col-md-12">
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" value="<?= $user->getPassword() ?>">
    </div>
    <br>
    <div class="col-md-12">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="user"><?php if($user->getId() == ""): ?>Create <?php else: ?>Update <?php endif ?> User</button>
    </div>
</form>

<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>