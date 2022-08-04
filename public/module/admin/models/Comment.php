<?php
namespace app\module\admin\models;


class Comment extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'comment';
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
     * Получаем АйДи комментария(примечание) по тексту
     * если его нет, то добавляем в базу и выводим его АйДИ
     */
    public function getId($text){
        $query = Comment::findOne(['name' => $text]);
        $count = Comment::find()->where(['name' => $text])->count();
        if($count > 0){
            if ($query->visible == 1){
                $query->visible = 0;
                $query->save();
            }

            return $query->id;
        }else{
            $executor =  new Comment();
            $executor->name = $text;
            $executor->save();
            return Comment::findOne(['name' => $text])->id;
        }
    }

}