 <?php ob_start(); ?>
</div>
<?php if($this->getContext()->getAuthentication() != null):?>
    <button class="btn btn-primary" onclick="window.location.href='/restaurants/create'">Create Restaurant</button>
<?php endif ?>
<br>
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Link</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($this->getContext()->getAttribute("restaurants") as $restaurant): ?>
        <tr>
            <td scope="row"><?= $restaurant->getId()?></td>
            <td><?= $restaurant->getName()?></td>
            <td>
                <a title="read" href="/restaurants/read/<?= $restaurant->getId()?>">
                    <img src="/public/icons/eye.svg" alt="read" height="24px"/>
                </a>
                <a title="write" href="/restaurants/update/<?= $restaurant->getId()?>">
                    <img src="/public/icons/edit.svg" alt="write" height="24px"/>
                </a>
                <a title="delete" href="/restaurants/delete/<?= $restaurant->getId()?>">
                    <img src="/public/icons/trash.svg" alt="delete" height="24px"/>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
    $content = ob_get_clean(); 
    include_once "./view/template.php";
?>