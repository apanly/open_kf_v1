<?php

use yii\helpers\Html;
use www\assets\CSAsset;
use \common\components\GlobalUrlService;
CSAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
    <link rel="icon" href="<?=GlobalUrlService::buildWwwStaticUrl("/images/favicon.ico");?>" type="image/x-icon"/>
	<title><?=Yii::$app->params["company"]["title"];?>客服控制台</title>
	<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
	<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="javascript:void(0);"><?=Yii::$app->params["company"]["title"];?>客服控制台</a>
	<ul class="navbar-nav px-3">
		<li class="nav-item text-nowrap">
			<a class="nav-link" href="javascript:void(0);">退出</a>
		</li>
	</ul>
</nav>

<div class="container-fluid">
	<div class="row">
		<nav class="col-md-1 col-lg-1 bg-light sidebar" style="margin-top:50px; ">
			<div class="sidebar-sticky">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link active" href="javascript:void(0);">
                            <i class="fa fa-commenting" aria-hidden="true"></i>
							当前会话
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0);">
							<span data-feather="file"></span>
							待接入会话
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<main role="main"  class="col-md-11 ml-sm-auto col-lg-11">
			<?= $content ?>
		</main>
	</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
