<?php
    ob_start()
?>
    <div class="container">
        <h2>Enter your location</h2>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary btn-dark" type="button" onclick="btnSearch()"><img class="icon icon-white" src="/public/icons/search.svg" alt="search" height="20px"/></button>
            </div>
            <input id="location" type="text" class="form-control" placeholder="Enter your location" aria-label="" aria-describedby="basic-addon1" onkeypress="keyEnter(event)">
        </div>

        <div class="col-xs-12">
            <div id="map" style="width: 100%; height: 530px;"></div>
            <div id="lon" style="display:none;"><?php if($this->getContext()->getAttribute("location") != null): ?> <?=$this->getContext()->getAttribute("location")->lon?> <?php else:?>49.6833300<?php endif?></div> 
            <div id="lat" style="display:none;"><?php if($this->getContext()->getAttribute("location") != null): ?> <?=$this->getContext()->getAttribute("location")->lat?> <?php else:?>5.8166700<?php endif?></div>
        </div>

        <div id="restaurant">
            <?php $count = 0; ?>
            <?php foreach($this->getContext()->getAttribute("restaurants") as $restaurant): ?>
                <?php if($count % 3 == 0) : ?></div><div class="d-flex"><?php endif?>        
                    <div class="p-2 flex-fill thumbnail">
                        <a href="/restaurants/read/<?= $restaurant->getId() ?>">
                            <?php if($restaurant->getImage() != null) : ?>
                                <img class="thumbnail-img" src="data:<?=$restaurant->getImage()->getType()?>;base64,<?=base64_encode($restaurant->getImage()->getContent())?>" />
                            <?php else : ?>
                                <img class="thumbnail-img" src="/public/img/restaurant.jpg">
                            <?php endif ?>
                            <div class="caption">
                                <h4 class="name"><?= $restaurant->getName() ?></h4>
                                <p><?= $restaurant->getLocation() ?></p>
                                <p><?= $restaurant->getDistance() . "Km" ?></p>
                                <div class="lat" style="display:none;"><?= $restaurant->getLat() ?></div>
                                <div class="lon" style="display:none;"><?= $restaurant->getLon() ?></div>
                            </div>
                        </a>
                    </div>       
                <?php $count += 1 ?>
            <?php endforeach ?>
        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="/vendor/bmatzner/leaflet-bundle/Bmatzner/LeafletBundle/Resources/public/css/leaflet.css"/>
    <script src="/vendor/bmatzner/leaflet-bundle/Bmatzner/LeafletBundle/Resources/public/js/leaflet.js"></script>
    <script src="/public/js/script_home.js"></script>
<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>