<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\module\admin\models\Invoices;
use kartik\date\DatePicker;
use app\module\admin\models\Org;
use app\module\admin\models\Executor;
use yii\widgets\LinkPager;

$model = new Invoices();
//$model->search = null;





$id_org = isset($_POST['Invoices']['id_org']) ? $_POST['Invoices']['id_org'] : null;
$id_executor = isset($_POST['Invoices']['id_executor']) ? $_POST['Invoices']['id_executor'] : null;
$_invoices = isset($_POST['Invoices']['invoices']) ? $_POST['Invoices']['invoices'] : null;
$date_to = isset($_POST['Invoices']['date_to']) ? $_POST['Invoices']['date_to'] : null;
$date_do = isset($_POST['Invoices']['date_do']) ? $_POST['Invoices']['date_do'] : null;

$original = null;
?>
<div class="col-sm-12">
    <div class="row col-sm-10 col-sm-offset-1">
        <?php
            $form = ActiveForm::begin(['id' => 'ads']);
            $model->id_org = $id_org;
//            $model->id_org_parent = $_POST['Invoices']['id_org_parent'];
            $model->id_executor = $id_executor;
            $model->invoices = $_invoices;
            $model->date_to = isset($date_to) ? $date_to : null;
            $model->date_do = isset($date_do) ? $date_do : null;
        ?>
        <div class="row">
            <div class="col-sm-1">
                <?= Html::a('<span class="btn btn-primary glyphicon glyphicon-arrow-left" style="display: inline-block"></span>', ['index']) ?>
                <?= Html::a('<span class="btn btn-primary glyphicon glyphicon-refresh" style="display: inline-block"></span>', ['reports']) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'id_org')->dropDownList(ArrayHelper::map(Org::find()->where(['type' => null])->orderBy(['name' => SORT_ASC])->all(), 'id','name'), ['prompt' => 'Выбр. организацию'])->label(false) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'invoices')->textInput(['maxlength' => true, 'placeholder' => 'счет-фактура'])->label(false) ?>
            </div>
            <div class="col-sm-2">
                <?php
                echo DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_to',
                    'attribute2' => 'date_do',
                    'options' => ['placeholder' => 'Start date'],
                    'options2' => ['placeholder' => 'End date'],
                    'type' => DatePicker::TYPE_RANGE,
                    'form' => $form,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ]
                ]);
                ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'id_executor')->dropDownList(ArrayHelper::map(Executor::find()->orderBy(['name' => SORT_DESC])->all(), 'id','name'), ['prompt' => 'Выбр. исполнителя'])->label(false) ?>
            </div>
            <div class="col-sm-1">
                <?= Html::submitButton('' , ['class' => 'btn btn-primary col-sm-12 glyphicon glyphicon-search']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

    <br>
    <div class="col-sm-10 col-sm-offset-1" style="width: 1550px">
        <?php ActiveForm::begin(['action' => Url::to(['print'])]); ?>

        <table class="table table-condensed table-bordere table-hover table-striped table-text">
            <tr class="text-center" style="font-size: 12pt">
                <td class="bg-info text-left">
                    <input type=checkbox id="checkbox" />
                    <?= Html::submitButton('' , ['class' => 'btn btn-success btn-xs glyphicon glyphicon-print']) ?>
                </td>
            </tr>
            <?php foreach ($invoices as $item){ ?>

                <tr class="tools" >
                    <?php
                        if(isset($item->original)) { $original = $item->original == 1 ? "Оригинал" : "Копия";}
                        $text = '<span class="reports">';
                        $text.= '<div class="reports-item">';
                        $text.= '<div>'.$item->org->name.'</div>';
                        $text.= '<div>'.$item->invoices.' от '.Invoices::getDate($item->date).'</div>';
                        $text.= '<div>'.$item->comment->name.'</div>';
                        $text.= '<div>'.$original.'</div>';
                        $text.= '<div>'.$item->count.'</div>';
                        $text.= '</div>';
                        $text.= '</span>';
                    ?>
                    <td style="margin: 0; padding: 0"><?= Html::checkbox('report[]', false, ['label' =>$text , 'value' => $item->id , 'class' => 'chekboxReport']); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?= LinkPager::widget([ 'firstPageLabel' => 'Первая' ,'pagination' => $pagination, 'lastPageLabel' => 'Последняя']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>


