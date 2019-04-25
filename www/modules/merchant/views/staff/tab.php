<?php
use \common\components\GlobalUrlService;

$mapping = [
    "index" =>  [
        "title" => "客服列表",
        "url" => GlobalUrlService::buildMerchantUrl("/staff/index")
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