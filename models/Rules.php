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
    public $youtubeLinks;
    public $ruleImage;
    public $ruleText;

    public function rules()
    {
        return [
            ['ruleName', required],
        ];
    }

    public function getYoutubeLinks(){
        return $this->youtubeLink;
    }

    public function getRuleName(){
        return $this->ruleName;
    }

    public function getRuleImage(){
        return $this->ruleImage;
    }

    public function getRuleText(){
        return $this->ruleText;
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
        $model->youtubeLinks = array_merge($Hrefs[1], $Links[1]);
        $model->ruleText = preg_replace('/Link:\s?\'?(\S*)[\'?]/i', '', $ruleText);
        $model->ruleText = preg_replace('/<a.*?href=["\'](.*?)["\'].*?a>/i', '', $ruleText);
        return $model;
    }

    public static function getNamesRules(){
        $found = array();
        $i = 0;
        $path = Yii::getAlias(dirname(__DIR__)) . "/web/englishRules/";
        $dir = opendir( $path );
        while( ($file = readdir($dir)) !== false ){
               $file = explode( '.',$file);
           if( $file [1] == "php"){
               $found[$i] = $file[0];
               $i++;
           };
        }
        closedir($dir);
        return $found;
    }


}

