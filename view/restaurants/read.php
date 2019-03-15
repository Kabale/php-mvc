<?php ob_start(); ?>

<div id="articles">
    <div class="d-block ">
        <label class="font-weight-bold" for="id">Id :</label>
        <span name="id"><?=$this->getContext()->getAttribute("restaurant")->getId()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="Name">Name :</label>
        <span name="title"><?=$this->getContext()->getAttribute("restaurant")->getName()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="content">Location :</label>
        <span name="content"><?=$this->getContext()->getAttribute("restaurant")->getLocation()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="author">CreatedBy :</label>
        <span name="author"><?=$this->getContext()->getAttribute("restaurant")->getCreatedBy()->getUsername()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="creationDate">Creation Date :</label>
        <span name="creationDate"><?=$this->getContext()->getAttribute("restaurant")->getCreationDate()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="updateDate">Update Date :</label>
        <span name="updateDate"><?=$this->getContext()->getAttribute("restaurant")->getUpdateDate()?></div>
    </div>
    <b>Coordonnees : </b>
    <div class="d-block ">
        <label class="font-weight-bold" for="category">Latitude :</label>
        <span name="category"><?=$this->getContext()->getAttribute("restaurant")->getLat()?></div>
    </div>
    <div class="d-block ">
        <label class="font-weight-bold" for="category">Longitude :</label>
        <span name="category"><?=$this->getContext()->getAttribute("restaurant")->getLon()?></div>
    </div>
    <?php if($this->getContext()->getAttribute("restaurant")->getImage()!= null):?>
    <div class="d-block ">
        <?php echo '<img src="data:'.$this->getContext()->getAttribute("restaurant")->getImage()->getType().';base64,'.base64_encode($this->getContext()->getAttribute("restaurant")->getImage()->getContent()) .'" />' ?>;
    </div>
    <?php endif ?>
</div>

<?php
    $content = ob_get_clean();
    include_once  "./view/template.php";
?>