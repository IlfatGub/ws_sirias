<?php

use app\module\admin\models\Buh;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\typeahead\TypeaheadBasic;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\LinkPager;
use app\module\admin\models\Invoices;
use kartik\date\DatePicker;
use app\module\admin\models\Org;

$model = new \app\module\admin\models\SearchForm();
//$model->search = null;

$_GET['sort'] = isset( $_GET['sort']) ?  $_GET['sort'] : null;
$_GET['search'] = isset( $_GET['search']) ?  $_GET['search'] : null;
$_GET['page'] = isset( $_GET['page']) ?  $_GET['page'] : null;
?>
    <div class="col-sm-12">
            <div class="row col-sm-10 col-sm-offset-1">
                <?php $form = ActiveForm::begin(['action' => Url::toRoute(['index'])]); ?>
                <div class="row">
                    <div class="col-sm-2">
                        <?= Html::a('<span class="btn btn-primary glyphicon glyphicon-arrow-left" style="display: inline-block"></span>', ['index']) ?>
                        <?= Html::button('', [ 'value' =>Url::to(['create']), 'class' => 'btn btn-success glyphicon glyphicon-plus modalButton', 'title'=>'Добавить шкаф',])?>
                        <?= Html::a('<span class="btn btn-primary glyphicon glyphicon-briefcase" style="display: inline-block"></span>', ['reports']) ?>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        echo $form->field($model, 'search')->widget(TypeaheadBasic::classname(), [
                            'data' => ArrayHelper::map(Org::find()->all(), 'name', 'name'),
                            'options' => [
                                'style' => 'font-size:10pt;',
                                'placeholder' => 'Поиск...',
                                'autofocus'   => "autofocus",
                                'id'          => 'search',
                            ],
                            'scrollable'    => TRUE,
                            'dataset' => [
                                'limit' => 20,
                                'class' => 'sizes',
                            ],
                            'pluginOptions' => [
                                'highlight' => TRUE,
                                'minLength' => 1,
                            ],
                            'pluginEvents' => [
                                "typeahead:select" => "function() { location.href='http://sit.snhrs.ru/index.php/admin/usb/index?UsbSearch[search]='+document.getElementById('search').value }",],
                        ])->label(false);
                        ?>
                    </div>

                    <div class="col-sm-3">
                        <?= Html::submitButton('' , ['class' => 'btn btn-primary col-sm-12 glyphicon glyphicon-search']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>


        <div class="col-sm-12 ">

            <?= isset($_GET['search']) ? 'Резульатат поиска: '.$_GET['search'].'<div style="float:right;"> Количество записей: '.$count.'</div> <br>' : '' ?>

            <table class="table table-condensed table-bordere table-hover table-striped table-text" style="font-size: 8pt;">
                <tr class="text-center" style="font-size: 12pt">
                    <td><a href="<?= Url::toRoute(['index' , 'sort' => $_GET['sort']{0} == '-' ? '+id_org_parent': '-id_org_parent' , 'search' => $_GET['search'],  'page' => $_GET['page']  ] )?>">Подр. </a></td>
                    <td><a href="<?= Url::toRoute(['index' , 'sort' => $_GET['sort']{0} == '-' ? '+id_org'       : '-id_org'        , 'search' => $_GET['search'],  'page' => $_GET['page']  ] )?>">Организация </a></td>
                    <td><a href="<?= Url::toRoute(['index' , 'sort' => $_GET['sort']{0} == '-' ? '+invoices'     : '-invoices'      , 'search' => $_GET['search'],  'page' => $_GET['page']  ] )?>">Номер, дата договора </a></td>
                    <td><a href="<?= Url::toRoute(['index' , 'sort' => $_GET['sort']{0} == '-' ? '+date'         : '-date'          , 'search' => $_GET['search'],  'page' => $_GET['page']  ] )?>">Номер, дата документа </a></td>
                    <td><a href="<?= Url::toRoute(['index' , 'sort' => $_GET['sort']{0} == '-' ? '+document'     : '-document'      , 'search' => $_GET['search'],  'page' => $_GET['page']  ] )?>">Наименование первичного документа</a></td>
                    <td><a href="<?= Url::toRoute(['index' , 'sort' => $_GET['sort']{0} == '-' ? '+date_document': '-date_document' , 'search' => $_GET['search'],  'page' => $_GET['page']  ] )?>">Оригинал/копия</a></td>
                    <td><a href="<?= Url::toRoute(['index' , 'sort' => $_GET['sort']{0} == '-' ? '+id_executor'  : '-id_executor'   , 'search' => $_GET['search'],  'page' => $_GET['page']  ] )?>">Кол экз. </a></td>
                    <td><a href="<?= Url::toRoute(['index' , 'sort' => $_GET['sort']{0} == '-' ? '+sum'          : '-sum'           , 'search' => $_GET['search'],  'page' => $_GET['page']  ] )?>">Примечание </a></td>
                    <td></td>
                </tr>

                <?php foreach ($invoices as $item){ ?>
                    <tr class="tools" >
                        <td>
                            <?= $item->type == 2 ? "<span class='badge badge-success'>Copy</span>" : '' ?>
                            <?= isset($item->parent->name) ? $item->parent->name : null ?>
                        </td>
                        <td><?= $item->org->name ?></td>
                        <td><?= isset($item->document) ? $item->document : 'asd' ?> </td>
                        <td><?= $item->invoices .' от '. date("Y-m-d", $item->date)  ?></td>
                        <td><?= isset($item->comment->name) ? $item->comment->name : '2' ?></td>
                        <td><?php if(isset($item->original)) {echo $item->original == 1 ? "Оригинал" : "Копия";} ?></td>
                        <td><?= $item->count ?></td>
                        <td><?= $item->note ?></td>
                        <td>
                            <?php
                            Pjax::begin(['id' =>'invoices'.$item->id, 'enablePushState' => false]);
                            echo Html::beginForm(['index', 'type'=>$item->id, 'search' => $_GET['search'], 'page' => $_GET['page'], 'sort' => $_GET['sort']], 'post', ['data-pjax' => '0', 'class' => 'form-inline ']);
                            if($item->type == 0){$text = 'Вернули'; $class = 'danger'; }else{$text = 'Ok'; $class = 'success';}
                            echo Html::submitButton($text, ['class' => 'col-sm-12 btn btn-xs btn-'.$class, 'name' => 'hash-button']);
                            echo Html::endForm();
                            Pjax::end();
                            ?>
                        </td>
                        <td style="width: 90px">
                            <div class="tools-layer" style="float: right;">
                                <?php

                                    echo Html::a('<span class="btn btn-warning glyphicon glyphicon-copyright-mark btn-xs"></span>',
                                        [
                                            'copy',
                                            'id' => $item->id,
                                        ]);

                                    echo Html::button('',
                                        [
                                            'value' =>Url::to(['update', 'id'=>$item->id, 'search' => $_GET['search'], 'page' => $_GET['page'], 'sort' => $_GET['sort']]),
                                            'class' => 'modalButton btn btn-primary glyphicon glyphicon-pencil btn-xs mx-1',
                                            'title' => Yii::t('yii', 'Изменить')
                                        ]
                                    );
                                echo Html::a('<span class="btn btn-danger glyphicon glyphicon-trash btn-xs"></span>',
                                    [
                                        'delete',
                                        'id' => $item->id,
                                    ],
                                    [
                                        'data' => ['confirm' => 'Вы действительно хотите удалить?','method' => 'post'],
                                        'title' => Yii::t('yii', 'Удалить запись'),
                                        'data-pjax' => '0',
                                    ])
                                ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <?= LinkPager::widget([ 'firstPageLabel' => 'Первая' ,'pagination' => $pagination, 'lastPageLabel' => 'Последняя']) ?>
        </div>
    </div>


