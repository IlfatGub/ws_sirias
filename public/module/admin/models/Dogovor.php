<?php

    namespace app\module\admin\models;

    class Dogovor extends \yii\db\ActiveRecord
    {

        public static function tableName()
        {
            return 'dogovora';
        }



        public function rules()
        {
            return [
                [['name','id_org', 'visible'], 'safe'],
            ];
        }

        public function attributeLabels()
        {
            return [

            ];
        }


    }
