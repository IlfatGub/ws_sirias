<?php

use app\module\admin\models\Buh;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\typeahead\TypeaheadBasic;
use app\module\admin\models\Org;
use app\module\admin\models\Executor;
use app\module\admin\models\Comment;
use kartik\date\DatePicker;
use kartik\select2\Select2;
?>



<?php


if (!$model->isNewRecord){
    $model->id_org_parent = Org::findOne($model->id_org_parent)->name;
    $model->id_org = Org::findOne($model->id_org)->name;
    $model->id_comment = Comment::findOne($model->id_comment)->name;
    $model->date = date("Y-m-d", $model->date);
}else{
    $model->date = date('Y-m-d');
}



?>
<div class="device-form">

    <?php $form = ActiveForm::begin([
        'id' => 'device-form',
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'id_org_parent')->widget(TypeaheadBasic::classname(), [
                'data' => ArrayHelper::map(Org::find()->select(['name'])->where(['type' => 1])->andWhere(['visible' => 0])->distinct()->all(),'name', 'name'),
                'options' => ['placeholder' => '', 'autocomplete' =>'off'],
                'pluginOptions' => ['highlight'=>true, 'minLength' => 0],
                'scrollable' => true,
                'dataset' => [
                    'limit' => 20,
                ],
            ]);
            ?>
        </div>


    </div>
    <div class="row">
        <div class="col-sm-6">

            <?= $form->field($model, 'id_org')->dropDownList(
                    ArrayHelper::map(Org::find()->select(['name'])->where(['type' => null])->andWhere(['visible'=>0])->distinct()->all(),'name', 'name'),
                    ['prompt'=>'- Выбрать организацию -']

            ) ?>


        </div>

        <div class="col-lg-6">
            <?php
            echo $form->field($model, 'id_comment')->widget(TypeaheadBasic::classname(), [
                'data' => ArrayHelper::map(Comment::find()->select('name')->distinct('name')->where(['visible' => 0])->all(), 'name','name'),
                'options' => ['placeholder' => '', 'autocomplete' =>'off'],
                'pluginOptions' => ['highlight'=>true, 'minLength' => 0],
                'scrollable' => true,
                'dataset' => [
                    'limit' => 20,
                ],
            ]);
            ?>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php
            if ($model->isNewRecord){
                echo $form->field($model, 'invoices[]')->widget(Select2::classname(), [
                    'options' => ['multiple' => true],
                    'pluginOptions' => ['tags' => true]
                ]);
            }else{
                echo $form->field($model, 'invoices')->textInput(['maxlength' => true]);
            }
            ?>
        </div>

        <div class="col-sm-6">
            <?php
            echo '<label class="control-label">Дата первичного документа</label>';
//            $model->isNewRecord ? $model->date = date('Y-m-d') : $model->date = $model->date2;  //Указваем сегоднешную дату

            echo DatePicker::widget([
                'model' => $model, 'attribute' => 'date',
                'language' => 'ru',
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php
                echo $form->field($model, 'document')->dropDownList(['']);
            ?>
        </div>

    </div>





    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'original')->dropDownList([1 => 'Оригинал', 2 => 'Копия']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'count')->dropDownList([1 => '1 экз.', 2 => '2 экз.', 3 => '3 экз.', 4 => '4 экз.', ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'note')->textarea(['row' => 2]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
