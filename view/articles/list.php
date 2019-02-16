<?php
    include_once("DbHelper.php");
    include_once("model/article.php");

    $helper = new DbHelper();
    $result = $helper->get("articles");
    $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
?>

<?php ob_start(); ?>
<button class="btn btn-primary" onclick="window.location.href='/articles/create'">Create Article</button>
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
        <?php foreach($articles as $article): ?>
        <tr>
            <td scope="row"><?= $article->getId()?></td>
            <td><?= $article->getTitle()?></td>
            <td>
                <a title="read" href="?action=read&article=<?= $article->getId()?>">
                    <img src="/public/icons/eye.svg" alt="read" height="24px"/>
                </a>
                <a title="write" href="?action=write&article=<?= $article->getId()?>">
                    <img src="/public/icons/edit.svg" alt="write" height="24px"/>
                </a>
                <a title="delete" href="?action=delete&article=<?= $article->getId()?>">
                    <img src="/public/icons/trash.svg" alt="delete" height="24px"/>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
    $content = ob_get_clean(); 
    $title = "List Articles";
    include_once "./view/template.php";
?>