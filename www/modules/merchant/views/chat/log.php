<?php
use \common\components\GlobalUrlService;
use \common\components\DataHelper;
use \common\components\StaticService;

?>
<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/chat/tab.php", ['current' => 'log']); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="row-in">
        <div class="title-3a">
            <div class="columns-16">
                <p>搜索结果：共<?=$pages['total_count'];?>条</p>
            </div>
        </div>
        <div class="columns-24">
            <table class="table-1">
                <thead>
                <tr>
                    <td width="12%">发送方</td>
                    <td>内容</td>
                    <td width="8%">接收方</td>
                    <td width="12%">时间</td>
                </tr>
                </thead>
                <tbody>
                <?php if( $list ):?>
                    <?php foreach( $list as $_item ):?>
                        <tr>
                            <td><?=DataHelper::encode( $_item['f_name'] );?></td>
                            <td><?=DataHelper::encode( $_item['content'] );?></td>
                            <td><?=DataHelper::encode( $_item['to_name'] );?></td>
                            <td><?=DataHelper::encode( $_item['created_time'] );?></td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td colspan="6" class="centered">暂无信息</td>
                    </tr>
                <?php endif;?>
                </tbody>
            </table>
        </div>
        <div class="columns-24 text-right">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/common/pagination.php",[
                'pages' => $pages,
                'url' => '/chat/log',
                'search_conditions' => [],
                'current_page_count' => count($list)
            ]);?>
        </div>
    </div>
</div>