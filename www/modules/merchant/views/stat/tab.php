<?php
use \common\components\GlobalUrlService;

$mapping = [
    "trace" =>  [
        "title" => "访问记录",
        "url" => GlobalUrlService::buildMerchantUrl("/stat/trace")
    ],
    "uuid" => [
        'title' => "UUID统计",
        "url" => GlobalUrlService::buildMerchantUrl("/stat/uuid"),
        "status" => 1
    ],
    "source" => [
        'title' => "来源统计",
        "url" => GlobalUrlService::buildMerchantUrl("/stat/source"),
        "status" => 1
    ],
    "os" => [
        'title' => "操作系统统计",
        "url" => GlobalUrlService::buildMerchantUrl("/stat/os"),
        "status" => 1
    ],
    "browser" => [
        'title' => "浏览器统计",
        "url" => GlobalUrlService::buildMerchantUrl("/stat/browser"),
        "status" => 1
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