<?php ob_start(); ?>

<div id="articles">
    <div class="d-block ">
        <label class="font-weight-bold" for="id">Id :</label>
        <span name="id"><?=$this->getContext()->getAttribute("article")->getId()?></div>
    </div>
 
    <div class="d-block ">
        <label class="font-weight-bold" for="title">Title :</label>
        <span name="title"><?=$this->getContext()->getAttribute("article")->getTitle()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="content">Content :</label>
        <span name="content"><?=$this->getContext()->getAttribute("article")->getContent()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="author">Author :</label>
        <span name="author"><?=$this->getContext()->getAttribute("article")->getAuthor()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="creationDate">Creation Date :</label>
        <span name="creationDate"><?=$this->getContext()->getAttribute("article")->getCreationDate()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="updateDate">Update Date :</label>
        <span name="updateDate"><?=$this->getContext()->getAttribute("article")->getUpdateDate()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="category">Category :</label>
        <span name="category"><?=$this->getContext()->getAttribute("article")->getCategory()?></div>
    </div>
</div>

<?php
    $title = "Read Article";
    $content = ob_get_clean();
    include_once  "./view/template.php";
?>