<?php
    include_once("DbHelper.php");
    include_once("model/article.php");

    $helper = new DbHelper();
    if(isset($_GET["article"])) {
        $id = $_GET["article"];
        $result = $helper->get("articles", $id);
        $rows = $result->fetchAll();
    } else {
        header('Location: index.php');
        die();
    }
?>

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