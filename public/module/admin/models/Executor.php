<?php

namespace app\module\admin\models;


class Executor extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'executor';
    }

    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
        ];
    }

    /*
     * Получаем АйДи исполнителя по тексту
     * если его нет, то добавляем в базу и выводим его АйДИ
     */
    public function getId($text){
        $count = Executor::find()->where(['name' => $text])->count();
        if($count > 0){
            return Executor::findOne(['name' => $text])->id;
        }else{
            $executor =  new Executor();
            $executor->name = $text;
            $executor->save();
            return Executor::findOne(['name' => $text])->id;
        }
    }

    /*
     * Выводин контактный телефон
     */
    public function getPhone($name){
        return Executor::findOne(['name' => $name])->phone;
    }
}