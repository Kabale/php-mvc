<?php ob_start(); ?>

<div id="articles">
    <div class="d-block ">
        <label class="font-weight-bold" for="id">Id :</label>
        <span name="id"><?=$article->getId()?></div>
    </div>
 
    <div class="d-block ">
        <label class="font-weight-bold" for="title">Title :</label>
        <span name="title"><?=$article->getTitle()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="content">Content :</label>
        <span name="content"><?=$article->getContent()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="author">Author :</label>
        <span name="author"><?=$article->getAuthor()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="creationDate">Creation Date :</label>
        <span name="creationDate"><?=$article->getCreationDate()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="updateDate">Update Date :</label>
        <span name="updateDate"><?=$article->getUpdateDate()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="category">Category :</label>
        <span name="category"><?=$article->getCategory()?></div>
    </div>
</div>

<?php
    $title = "Read Article";
    $content = ob_get_clean();
    include_once  "./view/template.php";
?>