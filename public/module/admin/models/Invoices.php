<?php

namespace app\module\admin\models;
use DateTime;

class Invoices extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'invoices';
    }

    public $date_do;
    public $date_to;
//    public $date2;
//    public $date_document_2;
//    public $buh_n;
//
//    public $_date;
//    public $_id_comment;
//    public $_id_org_parent;
//    public $_id_org;
//    public $document;

    public function rules()
    {
        return [
            [['id_org','original', 'date2','date_do','date_to','id_executor','sum','id_comment','type', 'invoices','document','date_document', 'buh', 'id_org_parent', 'count',  'date','note'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_org' => 'Наименование контрагента-поставщика',
            'date' => 'Дата первичного документа',
            'date_document' => 'Дата договора с контрагенотом-поставщиком',
            'id_executor' => 'Исполнитель',
            'sum' => 'Сумма',
            'id_comment' => 'Наименование первичного документа',
            'type' => '',
            'invoices' => 'Номер первичного документа',
            'id_org_parent' => 'Подр.',
            'document' => 'Номер договора с контрагенотом-поставщиком',
            'buh' => 'Скан в 1с',
            'count' => 'Количетсво экземпляров',
            'original' => 'Оригинал/копия',
            'note' => 'Примечание',
        ];
    }

    public function afterFind()
    {




//        $this->date2 = $this->getDate($this->date, 1);
//        $this->date = $this->getDate($this->date);
//        $this->date_document_2 = isset($this->date_document) ? $this->getDate($this->date_document) : '-';
////        $this->date_document_2 = $this->getDate($this->date_document);
//        $this->id_comment =     $this->id_comment ? $this->comment->name : '';
////        $this->id_executor =    $this->executor->name ? $this->executor->name : '';
//        $this->id_org =         isset($this->org->name) ? $this->org->name : '';
//        $this->id_org_parent =  isset($this->parent->name) ? $this->parent->name : '';
//        $this->buh_n =          isset($this->buh->name) ? $this->buh->name : '';
    }

    public function getComment()
    {
        return $this->hasOne(Comment::className(),['id'=>'id_comment']);
    }
    public function getOrg()
    {
        return $this->hasOne(Org::className(),['id'=>'id_org']);
    }
    public function getParent()
    {
        return $this->hasOne(Org::className(),['id'=>'id_org_parent']);
    }
    public function getExecutor()
    {
        return $this->hasOne(Executor::className(),['id'=>'id_executor']);
    }
    public function getBuh()
    {
        return $this->hasOne(Buh::className(),['id'=>'buh']);
    }

    /*
     * date - дата которую необходимо перевети
     * перевод в юникс дату
     */
    public function getTimestamp($date)
    {
        $date = new DateTime($date);
        return $date->getTimestamp();
    }

    /*
     * dates - дата которую необходимо перевети
     * перевод в дату в обычном виде
     */
    public static function getDate($dates, $format=null)
    {
        $date = new DateTime();
        $date->setTimestamp($dates);
        if(isset($format)){
            return $date->format('Y.m.d');
        }else{
            return $date->format('d.m.Y');
        }
    }

    public function updateInvoices($id, $value = null)
    {
        $mod = Invoices::findOne($id);
        $mod->id_org = Org::getId($mod->id_org);
        $mod->id_org_parent = Org::getId($mod->id_org_parent);
        $mod->id_executor = Executor::getId($mod->id_executor);
        $mod->id_comment = Comment::getId($mod->id_comment);
        $mod->date = Invoices::getTimestamp($mod->date);
        if (isset($value)){
            $mod->sum = $value;
        }else{
            $mod->type =  $mod->type == 1 ? 0 : 1;
        }
        $mod->save();
    }
}
