<?php


namespace app\module\admin\models;
use yii\base\Model;

class SearchForm extends Model
{
    public $search;

    public function rules()
    {
        return[
            ['search', 'string']
        ];
    }
}