<?php
/* @var $this \yii\web\View */
/* @var $content string */

use tests\app\assets\AppAsset;
use tests\app\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ? Html::encode($this->title) . ' - ' : '' ?><?= Yii::$app->name ?></title>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-default navbar-fixed-top navbar-fluid'],
    //'innerContainerOptions' => ['class' => 'container-fluid'],
]);
echo Nav::widget([
    'items' => [
        ['label' => Yii::t('app', 'Trails'), 'url' => ['/trail/index']],
        ['label' => Yii::t('app', 'Mails'), 'url' => ['/mail/index']],
        ['label' => Yii::t('app', 'Javascripts'), 'url' => ['/javascript/index']],
        ['label' => Yii::t('app', 'Errors'), 'url' => ['/error/index']],
    ],
    'options' => ['class' => 'navbar-nav'],
]);
echo Nav::widget([
    'items' => [
        ['label' => 'Project Homepage', 'url' => 'https://bedezign.github.io/yii2-audit/'],
    ],
    'options' => ['class' => 'navbar-nav navbar-right'],
]);
NavBar::end();

if (isset($this->params['jumbotron'])) {
    echo $this->render($this->params['jumbotron']);
}
?>

<div class="container">
    <?php if (isset($this->params['breadcrumbs'])) { ?>
        <div class="breadcrumbs">
            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'],
            ]) ?>
        </div>
    <?php } ?>
    <?= Alert::widget() ?>
    <?= $content ?>

    <footer class="text-center">
        <hr>
        <?= date('Y-m-d H:i:s'); ?>
        <br>
        <?= $this->render('@bedezign/yii2/audit/views/_audit_entry_id', ['style' => '']); ?>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>