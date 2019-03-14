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
            <th scope="col">Article Id</th>
            <th scope="col">Title</th>
            <th scope="col">Link</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($this->getContext()->getAttribute("articles") as $article): ?>
        <tr>
            <td scope="row"><?= $article->getId()?></td>
            <td><?= $article->getTitle()?></td>
            <td>
                <a title="read" href="/articles/read/<?= $article->getId()?>">
                    <img src="/public/icons/eye.svg" alt="read" height="24px"/>
                </a>
                <a title="write" href="/articles/update/<?= $article->getId()?>">
                    <img src="/public/icons/edit.svg" alt="write" height="24px"/>
                </a>
                <a title="delete" href="/articles/delete/<?= $article->getId()?>">
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