<?php

namespace app\models;


/*
 * model for english rules help
 */
use Yii;
use yii\base\BaseObject;
use yii\base\Model;


class Rules extends Model
{
    public $ruleName;
    public $ruleImage;
    public $ruleText;

    public function rules(){
        return[
            ['ruleName', required],
        ];
    }

    public static function getRuleByName($ruleName){
        $model = new Rules();
        $model->ruleName = $ruleName;
        $model->ruleImage = '';
        $model->ruleText = include(Yii::getAlias('@app') . "/englishRules/" . $ruleName . ".php");
        return $model;
    }

}

