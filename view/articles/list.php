<?php
    include_once("DbHelper.php");
    include_once("model/article.php");

    $helper = new DbHelper();
    $result = $helper->get("articles");
    $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
?>

<button class="btn btn-primary" onclick="window.location.href='index.php?action=write'">Create Article</button>
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
                <a title="read" href="?action=read&article=<?= $article->getId()?>"><ion-icon name="eye"></ion-icon></span></a>
                <a title="write" href="?action=write&article=<?= $article->getId()?>"><ion-icon name="create"></ion-icon></a>
                <a title="delete" href="?action=delete&article=<?= $article->getId()?>"><ion-icon name="trash"></ion-icon></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>