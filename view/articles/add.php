<?php
    include_once("model/article.php");
    include_once("DbHelper.php");

    $helper = new DbHelper();
    $article = new Article();

    if(isset($_POST["article"]))
    {
        // CREATE OBJECT
        if(isset($_POST["title"]))
            $article->setTitle($_POST["title"]);
        if(isset($_POST["content"]))
            $article->setContent($_POST["content"]);
        if(isset($_POST["author"]))
            $article->setAuthor($_POST["author"]);
        if(isset($_POST["category"]))
            $article->setCategory($_POST["category"]);
        
        // SEND OBJECT TO DATABASE
        if(isset($_POST["id"]) && $_POST["id"] != "")
            $helper->update("articles", $article, $_POST["id"]);
        else
            $helper->add("articles", $article);

        // REDIRECT USER TO LIST
        header('Location: index.php');
        die();
    }

    if(isset($_GET["article"]))
    {
        $id = $_GET["article"];
        $result = $helper->get("articles", $id);
        $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
        
        if(count($articles) > 0)
            $article = $articles[0];
    }
?>

<form method="post">
    <div class="col-md-12" style="display:none;">
        <input name="id" class="form-controle" value="<?= $article->getId() ?>">
    </div>
    <div class="col-md-12">
        <label for="title">Title</label>
        <input name="title" class="form-control" value="<?= $article->getTitle() ?>">
    </div>
    <div class="col-md-12">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" rows="10"><?= $article->getContent() ?></textarea>
    </div>
    <div class="col-md-12">
        <label for="author">Author</label>
        <input name="author" class="form-control" value="<?= $article->getAuthor() ?>">
    </div>
    <div class="col-md-12">
        <label for="category">Category</label>
        <input name="category" class="form-control" value="<?= $article->getCategory() ?>">
    </div>
    <br>
    <div class="col-md-12">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="article"><?php if($article->getId() == ""): ?>Create <?php else: ?>Update <?php endif ?> Article</button>
    </div>
</form>