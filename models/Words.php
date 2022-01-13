<?php
/**
 * Created by PhpStorm.
 * User: smagaev
 * Date: 13.01.2022
 * Time: 12:02
 */

namespace app\models;


use yii\base\Model;

class Words extends Model
{
    public $words;

    public function rules(){
        return [
            ['words', 'required'],
        ];
    }
}