<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Modal;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

        $items = [
            ['label' => 'Реестр исходящих входящих документов', 'url' => ['/admin/invoices/index']],
            ['label' => 'Орг / договора', 'url' => ['/org']]
        ];
    NavBar::begin([
        'brandLabel' => 'СИРиАС продакшен',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' =>
            Yii::$app->user->isGuest ? (
                $items
            ) : ([
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>']
            )

    ]);
    NavBar::end();
    ?>

    <div class="container col-sm-12">
        <?= $content ?>
    </div>

    <div class="body-content">
        <p>
            <?php
            // Using a select2 widget inside a modal dialog
            Modal::begin([
                'options' => [
                    'id' => 'modal',
                    'tabindex' => false, // important for Select2 to work properly
                ],
                'size' => 'modal-lg',
            ]);
            echo "<div id='modalContent'>  </div>";
            Modal::end();
            ?>
        </p>
    </div>

</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
