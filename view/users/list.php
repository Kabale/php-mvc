<?php ob_start(); ?>
</div>
<button class="btn btn-primary" onclick="window.location.href='/users/create'">Create User</button>
<br>
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">User Id</th>
            <th scope="col">Fullname</th>
            <th scope="col">Link</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td scope="row"><?= $user->getId()?></td>
            <td><?= $user->getFirstname() . " " . $user->getLastname()?></td>
            <td>
                <a title="read" href="/users/read/<?= $user->getId()?>">
                    <img src="/public/icons/eye.svg" alt="read" height="24px"/>
                </a>
                <a title="write" href="/users/update/<?= $user->getId()?>">
                    <img src="/public/icons/edit.svg" alt="write" height="24px"/>
                </a>
                <a title="delete" href="/users/delete/<?= $user->getId()?>">
                    <img src="/public/icons/trash.svg" alt="delete" height="24px"/>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
    $content = ob_get_clean(); 
    $title = "List Users";
    include_once "./view/template.php";
?>