<?php ob_start(); ?>

<div id="articles">
    <div class="d-block ">
        <label class="font-weight-bold" for="id">Id :</label>
        <span name="id"><?=$rows[0]['id']?></div>
    </div>
 
    <div class="d-block ">
        <label class="font-weight-bold" for="title">Title :</label>
        <span name="title"><?=$rows[0]['title']?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="content">Content :</label>
        <span name="content"><?=$rows[0]['content']?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="author">Author :</label>
        <span name="author"><?=$rows[0]['author']?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="creationDate">Creation Date :</label>
        <span name="creationDate"><?=$rows[0]['creationDate']?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="updateDate">Update Date :</label>
        <span name="updateDate"><?=$rows[0]['updateDate']?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="category">Category :</label>
        <span name="category"><?=$rows[0]['category']?></div>
    </div>
</div>

<?php
    $title = "Read Article";
    $content = ob_get_clean();
    include_once  "./view/template.php";
?>