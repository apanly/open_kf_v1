<?php
use \common\components\GlobalUrlService;

$mapping = [
    "index" =>  [
        "title" => "商户设置",
        "url" => GlobalUrlService::buildMerchantUrl("/setting/config-info")
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