<?php

namespace app\module\admin\models;


class Buh extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'buh';
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
            'name' => 'Наименование',
        ];
    }

    public function getId($text){
        $count = Buh::find()->where(['name' => $text])->count();
        if($count > 0){
            return Buh::findOne(['name' => $text])->id;
        }else{
            $executor =  new Buh();
            $executor->name = $text;
            $executor->save();
            return Buh::findOne(['name' => $text])->id;
        }
    }

    public function getName($id){
        if(Buh::find()->where(['id' => $id])->exists()){
            return Buh::findOne($id)->name;
        }
        return false;
    }
}