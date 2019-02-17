
<?php ob_start() ?>   
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

<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>