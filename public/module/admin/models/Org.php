<?php
namespace app\module\admin\models;


class Org extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'org';
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

    /*
     * Получаем АйДи организации по тексту
     * если его нет, то добавляем в базу и выводим его АйДИ
     */
    public function getId($text, $type = null){
        $count = Org::find()->where(['name' => $text])->count();
        if($count > 0){
            return Org::findOne(['name' => $text])->id;
        }else{
            $org =  new Org();
            $org->name = $text;
            isset($type) ? $org->type = 1 : $org->type = null;
            $org->save();
            return Org::findOne(['name' => $text])->id;
        }
    }

}