<?php

    /**
     * @var  $model  \app\module\admin\models\Org;
     * @var  $dogovor  \app\module\admin\models\Dogovor;
     */


    use app\module\admin\models\Dogovor;
    use app\module\admin\models\Org;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;


    $_dog = isset($_GET['dog']) ? $_GET['dog'] : null;
    $_dogovor = isset($_GET['dogovor']) ? $_GET['dogovor'] : null;
?>


<style>
   .form-control{
       width: 80%;
   }
</style>

<div class="col-lg-12 row">



    <div class="col-lg-5 card">


        <div>
            <?php ActiveForm::begin(['action' => ['/site/org'], 'method' => 'get']); ?>
            <?= Html::input('org', 'org', $_dogovor, [
                'class' => 'form-control form-control-sm  col-md-8 col-xs-8',
                'placeholder' => 'Введите наименование организации',
                'id' => 'search',
            ]) ?>
            <button class="btn ml-2  btn-success col-md-2 as fa-search" style="margin-left: 10px" type="submit">Добавить</button>
            <?php ActiveForm::end(); ?>
        </div>
        <br><br>
        <hr>

        <table class="table table-sm table-hover  col-lg-5 fs-12">
            <tr>
                <td>Организация</td>
                <td>/</td>
            </tr>
            <?php
                foreach ($model as $item): ?>
                    <?php $class = Dogovor::findOne(['id_org'=>$item->id]) ? 'alert-warning' : '' ?>
                    <?php if ($item->type != 1): ?>
                        <tr class="<?=$class?>">
                            <td><?= Html::a($item->name, ['/org', 'dog' => $item->id,],
                                    ['data' => ['method' => 'post',]]);
                                ?>


                            </td>
                            <td><?= Html::a('<span class="fas fa-window-close text-danger float-right">Удалить</span>', ['/org', 'delete' => $item->id,],
                                    ['data' => ['method' => 'post',]]);
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
        </table>
    </div>

    <div class="col-lg-7">


        <?php if ($_dog): ?>

            <div class="alert alert-info">
                <label for=""> Наименование организации </label>
                <?= Html::input('username', 'string', Org::findOne($_dog)->name,
                    ['class' => 'form-control form-control-sm input-noborder',
                        'onchange' => '$.post(" '.Url::toRoute(['org-edit']).'?id_org='.$_dog.'&text='.'"+$(this).val());'
                    ])
                ?>

            </div>

            <div>
                <?php ActiveForm::begin(['action' => ['/site/org', 'dog' => $_dog], 'method' => 'get']); ?>
                <?= Html::input('dogovor', 'dogovor', $_dogovor, [
                    'class' => 'form-control form-control-sm  col-md-8 col-xs-8',
                    'placeholder' => 'Введите договор',
                    'id' => 'search',
                ]) ?>
                <button class="btn ml-2  btn-success col-md-2 as fa-search" style="margin-left: 10px" type="submit">Добавить</button>
                <?php ActiveForm::end(); ?>
            </div>


            <?php if ($dogovor):
                $i = 0; ?>
                <table class="table table-sm  table-hover table-striped col-lg-6 " style="margin-top: 5px">

                    <tr>
                        <td>#</td>
                        <td>Договор</td>
                    </tr>
                    <?php foreach ($dogovor as $item): ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td>
                                <?= Html::input('username', 'string', $item->name,
                                        [
                                                'class' => 'form-control form-control-sm input-noborder',
                                            'onchange' => '$.post(" '.Url::toRoute(['org-edit']).'?id_dog='.$item->id.'&text='.'"+$(this).val());',
                                            'style' => 'border: 0px solid white',
                                        ])
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>
