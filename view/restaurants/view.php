<?php ob_start(); ?>

<div id="restaurant">
<?php $count = 0; ?>
<?php foreach($this->getContext()->getAttribute("restaurants") as $restaurant): ?>
    <?php if($count % 3 == 0) : ?></div><div class="d-flex"><?php endif?>        
        <div class="p-2 flex-fill thumbnail">
            <a href="/restaurants/read/<?= $restaurant->getId() ?>">
                <?php if($restaurant->getImage() != null) : ?>
                    <img class="thumbnail-img" src="data:<?=$restaurant->getImage()->getType()?>;base64,<?=base64_encode($restaurant->getImage()->getContent())?>" />
                <?php else : ?>
                    <img src="/public/img/restaurant.jpg">
                <?php endif ?>
                <div class="caption">
                    <h4><?= $restaurant->getName() ?></h4>
                    <p><?= $restaurant->getDistance() . "Km" ?></p>
                </div>
            </a>
        </div>
    <?php $count += 1 ?>
<?php endforeach ?>
        
    
</div>
<?php
    $content = ob_get_clean();
    include_once  "./view/template.php";
?>