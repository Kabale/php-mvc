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
    <?php if($user->getId() == ""): ?>
        <div class="col-md-12">
            <label for="newPassword">New Password</label>
            <input name="newPassword" type="password" class="form-control" value="">
        </div>
        <div class="col-md-12">
            <label for="repeatPassword">Repeat Password</label>
            <input name="repeatPassword" type="password" class="form-control" value="">
        </div>
    <?php else: ?>
        <br>
        <div class="row" style="padding-left:20px;">
            <div class="col-md-6">
                <label for="isPasswordReset">Reset Password </label>
                <input name="isPasswordReset" type="checkbox" class="cb-class" />
            </div>
            <div class="col-md-6">
                <label for="isUserEnabled">User Enabled </label>
                <input name="isUserEnabled" type="checkbox" class="cb-class" checked/>
            </div>
        </div>
        <div id="ResetPassword" style="display:none;">
            <div class="col-md-12">
                <label for="oldPassword">Old Password</label>
                <input name="oldPassword" type="password" class="form-control" value="">
            </div>
            <div class="col-md-12">
                <label for="newPassword">New Password</label>
                <input name="newPassword" type="password" class="form-control" value="">
            </div>
            <div class="col-md-12">
                <label for="repeatPassword">Repeat Password</label>
                <input name="repeatPassword" type="password" class="form-control" value="">
            </div>
        </div>
    <?php endif ?>
</form>
<br>
<br>
<div class="col-md-12">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="user"><?php if($user->getId() == ""): ?>Create <?php else: ?>Update <?php endif ?> User</button>
    </div>
<script src="/public/js/script_user_create.js"></script>

<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>