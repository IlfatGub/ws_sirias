<?php

namespace app\controllers;

use app\module\admin\models\Comment;
use app\module\admin\models\Dogovor;
use app\module\admin\models\Org;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

date_default_timezone_set('Asia/Yekaterinburg');


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['/admin/invoices/index']);
    }






    /**
     * Занятость сотрудников
     */
    public function actionDogovora($name){

        $model = Dogovor::find()->where(['id_org' => Org::findOne(['name' => $name, 'visible' => 0])->id])->all();
        $option = '';

        if (count($model) > 0) {
            $data = true;

            $option .= "<option value=''>- Выбрать договор -</option>";
            foreach ($model as $item) {
                $option .= "<option value = '" . $item->name . "'>" . $item->name . "</option>";
            }
        } else {
            $data = false;
            $option .= "<option></option>";
        }

        $result = [
            "select" => $option,
            "data" => $data,
        ];

        return json_encode($result);
    }



    public function actionOrgEdit($text, $id_org = null, $id_dog = null){
        if ($text and $id_org){
            try{
                $_org = Org::findOne($id_org);
                $_org->name = $text;
                $_org->save();
            } catch (\Exception $ex) {
                print_r($ex->getMessage());
            }
        }

        if ($text and $id_dog){
            try{
                $_dog = Dogovor::findOne($id_dog);
                $_dog->name = $text;
                $_dog->save();
            } catch (\Exception $ex) {
                print_r($ex->getMessage());
            }
        }
    }


    public function actionTest(){

//        $model = Comment::find()->all();
//        foreach ($model as $item) {
//            try{
//            $upd = Comment::findOne($item->id);
//            $upd->visible = 1;
//            $upd->save();
//            } catch (\Exception $ex) {
//                print_r($ex->getMessage());
//            }
//        }
    }



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionOrg($delete = null, $dog = null, $dogovor = null, $org = null)
    {

        if (isset($delete)){
            $org = Org::findOne($delete);
            $org->visible = 1;
            $org->save();
        }



        if (isset($org)){
            try{
                $_new_dog = new Org();
                $_new_dog->name = $org;
                $_new_dog->visible = 0;
                $_new_dog->save();

                $this->redirect(['org']);
            } catch (\Exception $ex) {
                print_r($ex->getMessage());
            }
        }


        if (isset($dog) and isset($dogovor)){
            try{
                $_new_dog = new Dogovor();
                $_new_dog->name = $dogovor;
                $_new_dog->id_org = $dog;
                $_new_dog->save();

                $this->redirect(['org', 'dog' => $dog]);
            } catch (\Exception $ex) {
                print_r($ex->getMessage());
            }
        }

        if (isset($dog)){
            $dogovor = Dogovor::find()->where(['id_org' => $dog])->orderBy(['id' => SORT_ASC])->all();
        }



        $model = Org::find()->where(['visible' => 0])->orderBy(['name' =>SORT_ASC])->asArray()->all();
        return $this->render('org',
            [
                'model' => json_decode(json_encode($model)),
                'dogovor' => $dogovor,
            ]
        );
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
