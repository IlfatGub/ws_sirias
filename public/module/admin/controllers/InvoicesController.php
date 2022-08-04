<?php

namespace app\module\admin\controllers;

use app\module\admin\models\Comment;
use app\module\admin\models\Executor;
use app\module\admin\models\Invoices;
use app\module\admin\models\Org;
use app\module\admin\models\Buh;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\module\admin\models\SearchForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\data\Pagination;

class InvoicesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'create', 'view', 'delete', 'print', 'reports'],
                'rules' => [
                    [
                        'allow' => true,
                        'ips' => ['10.224.30.*', '10.224.12.*', '10.224.7.219', '10.224.7.205'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $model = new SearchForm();
        if($model->load(Yii::$app->request->post())){
            $search = Html::encode($model->search);
            return $this->redirect(Url::toRoute(['index', 'search'=>$search]));
        }
        return true;
    }

    public function actionElement($id, $sum = null){
        if(isset($sum)){
            Invoices::updateInvoices($id, $sum);
        }
    }

    public function actionIndex($type = null, $search = null, $sort = null, $page = 1)
    {
        $query = Invoices::find();
        $query->joinWith(['comment', 'org', 'buh', 'parent']);



        //Если переменная $type не пуста, то меняем статус записи
        if(isset($type)){
            Invoices::updateInvoices($type);
        }

        //Если переменная $search не пуста, то включаем выборку в запрос
        if(isset($search)){
            $query
//                ->orFilterWhere(['like', 'executor.name',     $search])
//                ->orFilterWhere(['like', 'parent.name',        $search])
                ->orFilterWhere(['like', 'comment.name',        $search])
                ->orFilterWhere(['like', 'org.name',            $search])
                ->orFilterWhere(['like', 'document',            $search])
//                ->orFilterWhere(['=', 'invoices.date',          strtotime($search)])
                ->orFilterWhere(['like', 'invoices',            $search]);
        }

        //Если переменная $sort не пуста, то включаем сортировку
        isset($sort) ? $query->orderBy(['invoices.'.substr($sort, 1)=> $sort{0} == '-' ? SORT_DESC : SORT_ASC]) : $query->orderBy(['invoices.id' => SORT_DESC]);

        $pagination = new Pagination([
            'defaultPageSize' => 40,
            'totalCount' => $query->count(),
        ]);

        $invoices = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'invoices' => $invoices,
            'pagination' => $pagination,
            'count' =>  $query->count(),
            'active_page' => Yii::$app->request->get('page', $page),
            'count_pages' => $pagination->getPageCount()
        ]);

    }



    public function actionExcell(){
        return $this->render('excell');
    }


    public function actionReports(){

        $model = new Invoices();

        $query = Invoices::find();
        $query->joinWith(['executor', 'comment', 'org', 'buh']);
        $query->orderBy(['invoices.id' => SORT_DESC]);

        $pagination = new Pagination([
            'defaultPageSize' => 60,
            'totalCount' => $query->count()
        ]);

        if ($model->load(Yii::$app->request->post())) {
        //Если переменная $search не пуста, то включаем выборку в запрос
            $query
                ->andFilterWhere(['=', 'invoices.id_executor',           $model->id_executor])
                ->andFilterWhere(['=', 'invoices.id_org',                $model->id_org])
//                ->orFilterWhere(['=', 'invoices.id_org_parent',         $model->id_org_parent])
                ->andFilterWhere(['Like', 'invoices.invoices',              $model->invoices])
                ->andFilterWhere(['>=', 'invoices.date',                $model->date_to ? strtotime($model->date_to) : null])
                ->andFilterWhere(['<=', 'invoices.date',                $model->date_do ? strtotime($model->date_do) : null]);

            $invoices = $query
                ->all();

            return $this->render('reports', [
                'invoices' => $invoices,
            ]);
        } else {

            $invoices = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('reports', [
                'invoices' => $invoices,
                'pagination' => $pagination,
                'active_page' => Yii::$app->request->get('page', 1),
                'count_pages' => $pagination->getPageCount()
            ]);
        }
    }

    public function actionPrint(){

        $this->layout = 'print';
        $run = false;
        $model = new Invoices();

        if ($_POST['report']) {
            $model = Invoices::find()->where(['id' => $_POST['report']])->all();
            $run = true;
        }

        return $this->render('print', [
            'run' => $run,
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Invoices();

        if ($model->load(Yii::$app->request->post())) {
            foreach ($model->invoices as $item) {
                $newRecord =new Invoices();
                $newRecord->invoices = $item;
                $newRecord->document = $model->document;
                $newRecord->id_org = Org::getId($model->id_org);
                $newRecord->id_org_parent = Org::getId($model->id_org_parent, 1);
//                $newRecord->id_executor = Executor::getId($model->id_executor);
                $newRecord->id_comment = Comment::getId($model->id_comment);
//                $newRecord->sum = $model->sum;
                $newRecord->date = Invoices::getTimestamp($model->date);
//                $newRecord->date_document = Invoices::getTimestamp($model->date_document);
                $newRecord->type = 1;
                $newRecord->original = $model->original;
                $newRecord->note = $model->note;
                $newRecord->count = $model->count;
//                $newRecord->buh = Buh::getId($model->buh);
                $newRecord->save();
            }

            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionCopy($id){
        $old = Invoices::findOne($id);


        try{
            $new = new Invoices();
            $new->attributes = $old->attributes;
            $new->type = 2;
            $new->save();
        } catch (\Exception $ex) {
            print_r($ex->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionQuery(){

        $model = Invoices::find()->where(['=', 'id_executor', 15])->all();

        foreach ($model as $item ){
            $upd = Invoices::findOne($item->id);

//            $date1 = explode('.', $upd->date);
//            $date = $date1[2].'-'.$date1[1].'-'.$date1[0];
//
            $upd->id_org = Org::getId($upd->id_org);
            $upd->id_executor = 6;
            $upd->id_comment = Comment::getId($upd->id_comment);
            $upd->date = Invoices::getTimestamp($item->date);
            $upd->save();
        }

        $model = Invoices::find()->all();

        return $this->render('query', [ 'model' => $model]);
    }

    public function actionUpdate($id, $search = null, $sort = null, $page = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            try{
                $model->id_org = Org::getId($model->id_org);
                $model->id_org_parent = Org::getId($model->id_org_parent, 1);
//            $model->id_executor = Executor::getId($model->id_executor);
                $model->id_comment = Comment::getId($model->id_comment);
                $model->date = strtotime($model->date);
                $model->type = 1;
                $model->save();

            } catch (\Exception $ex) {
                print_r($ex->getMessage());
            }


            return $this->redirect(['index', 'search' => $search, 'sort' => $sort, 'page' => $page]);

        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Invoices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
