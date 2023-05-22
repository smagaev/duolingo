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
    public $youtubeLink;
    public $ruleImage;
    public $ruleText;

    public function rules()
    {
        return [
            ['ruleName', required],
        ];
    }

    public static function getRuleByName($ruleName)
    {

        $path = Yii::getAlias(dirname(__DIR__)) . "/web/englishRules/";
        $model = new Rules();
        $model->ruleName = $ruleName;
        if (is_file($path . $ruleName . ".png")) $model->ruleImage = "/englishRules/" . $ruleName . ".png";
        if (is_file($path . $ruleName . ".jpg")) $model->ruleImage = "/englishRules/" . $ruleName . ".jpg";
        if (is_file($path . $ruleName . ".jpeg")) $model->ruleImage = "/englishRules/" . $ruleName . ".jpeg";
        if (is_file($path . $ruleName . ".gif")) $model->ruleImage = "/englishRules/" . $ruleName . ".gif";
        $ruleText = file_get_contents($path . $ruleName . ".php");
        preg_match_all('/Link:\s?\'?(\S*)[\'?]/i', $ruleText, $Links);
        preg_match_all('/<a.*?href=["\'](.*?)["\'].*?>/i', $ruleText, $Hrefs);
        $model->youtubeLink = array_merge($Hrefs[1], $Links[1]);
        $model->ruleText = preg_replace('/Link.*/i', '', $ruleText);
        return $model;
    }

}

