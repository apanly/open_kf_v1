<?php
use \common\components\GlobalUrlService;

$mapping = [
    "index" =>  [
        "title" => "接入指引",
        "url" => GlobalUrlService::buildMerchantUrl("/help/index")
    ]
];
?>

<ul class="tab_title style_1">
    <?php foreach( $mapping as $_key => $_item ):?>
        <li <?php if($current == $_key ):?> class="current" <?php endif;?>>
            <a href="<?=$_item['url'];?>"><?=$_item["title"];?></a>
        </li>
    <?php endforeach;?>
</ul>