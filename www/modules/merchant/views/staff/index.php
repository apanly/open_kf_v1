<?php
use \common\components\GlobalUrlService;
use \common\components\DataHelper;
use \common\services\Constants;
?>
<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/staff/tab.php", ['current' => 'index']); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="row-in">
        <div class="title-3a">
            <div class="columns-16">
                <p>搜索结果：共<?=$pages['total_count'];?>人</p>
            </div>
            <div class="columns-8 right">
                <a href="<?=GlobalUrlService::buildMerchantUrl("/staff/set");?>" class="btn-small style-3 mg-r10">+添加客服</a>
            </div>
        </div>
        <div class="columns-24">
            <table class="table-1">
                <thead>
                <tr>
                    <td width="8%">客服标识</td>
                    <td>客服昵称</td>
                    <td width="8%">客服头像</td>
                    <td width="8%">客服状态</td>
                    <td width="8%">在线状态</td>
                    <td width="20%">操作</td>
                </tr>
                </thead>
                <tbody>
                <?php if( $list ):?>
                    <?php foreach( $list as $_item ):?>
                        <tr>
                            <td><?=DataHelper::encode( $_item['sn'] );?></td>
                            <td><?=DataHelper::encode( $_item['nickname'] );?></td>
                            <td>
                                <div class="avatar-1">
                                    <img src="<?=GlobalUrlService::buildWwwStaticUrl( "/images/{$_item['avatar']}" );?>"/>
                                </div>

                            </td>
                            <td class="<?=($_item['status'])?"color-success":"color-danger";?>">
                                <?=Constants::$login_status_map[ $_item['status'] ];?>
                            </td>
                            <td class="<?=(!$_item['online_status'])?"color-success":"color-danger";?>">
                                <?=Constants::$online_status_map[ $_item['online_status'] ];?>
                            </td>
                            <td>
                                <a class="color-theme edit" href="<?=GlobalUrlService::buildMerchantUrl("/staff/set",[ "id" => $_item['id'] ]);?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>编辑
                                </a>
                            </td>
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
                'url' => '/staff/index',
                'search_conditions' => [],
                'current_page_count' => count($list)
            ]);?>
        </div>
    </div>
</div>