<?php

namespace app\components;

use app\models\Duolingo;
use app\models\Exclude;
use app\models\Statistika;
use yii;

class MyFunctions
{
    static function addExcludingWords($userId, $params)
    {
        if (isset($userId)) {
            foreach ($params as $key => $val) {
                if (strpos($key, 't_') === 0) {
                    $key = explode('_', $key)[1];
                    if ($model = Exclude::find()->where(['=', 'word_id', $key])->andWhere(['=', 'user_id', $userId])->one()) {
                        $model->time = $val;
                        $model->save();
                    } else {
                        $model = new Exclude();
                        $model->user_id = $userId;
                        $model->word_id = $key;
                        $model->time = $val;
                        $model->save();
                    }
                }
            }
        }
    }

    static function addTableStat($user_id, $quantity)
    {
        if ($user_id) {
            if (isset($quantity)) {
                $data = date('Y-m-d');
                $stat = Statistika::find()->where(['=', 'user_id', $user_id])->andWhere(['=', 'data', $data])->one();
                if (isset($stat)) {
                    $stat->quantity += $quantity;
                    $stat->save();
                } else {
                    $stat = new Statistika();
                    $stat->user_id = $user_id;
                    $stat->data = $data;
                    $stat->quantity = $quantity;
                    $stat->save();
                }
            }
        }
    }

    static function initCacheWithExcludingWords($user_id, $level, $session_id)
    {
        if ($level == 6) {
            if ($user_id)
                $models = Duolingo::find()->where(['>', 'count_words', 5])->andWhere(['user_id' => $user_id]);
            else $models = Duolingo::find()->where(['>', 'count_words', 5])->andWhere(['user_id' => 100]); /*for unregistered user*/

        } else {
            if ($user_id)
                $models = Duolingo::find()->where(['count_words' => $level, 'user_id' => $user_id]);
            else $models = Duolingo::find()->where(['count_words' => $level, 'user_id' => 100]);
        }
        $count = $models->count();
        if ($count > 0) {
            $arr = $models->column();

        } else {
            /* block for users, who don't have any words in db */
            $models = Duolingo::find()->where(['count_words' => $level, 'user_id' => 100]);
            $count = $models->count();
            if($count == 0) return false;
            $arr = $models->column();
            /* end of block for users, who don't have any words in db */
        }
        //exclude
        switch ($level) {
            case 1 :
                $limit = 100;
                break;
            case 2 :
                $limit = 1200;
                break;
            case 3 :
                $limit = 140;
                break;
            case 4 :
                $limit = 160;
                break;
            case 5 :
                $limit = 300;
                break;
            case 6 :
                $limit = 1250;
                break;
            case 7 :
                $limit = 400;
                break;
        }

        if ($user_id) { /*for registered user*/
            $excl_models = Exclude::find()->select('word_id')->where(['=', 'user_id', $user_id])->andWhere(['<', 'time', $limit])->asArray()->column();
            //   var_dump ($excl_models);
            $_arr = array_diff($arr, $excl_models);
            if (count($_arr) !== 0) {
                $arr = $_arr; //if all words are studied begin again once zero
                Exclude::find()->where(['=', 'user_id', $user_id]); //Нужно доработать эту функцию - удалять не все таймеры
                //Yii::$app->session->setFlash('success', 'Вы изучили все слова! Пройдите еще раз или выберите другой уровень!');
            }
        }

        //set cache
        $cache = Yii::$app->cache;
        $cache->set('level_' . $session_id, $level); //set level
        $cache->set('count_words_in_db' . $session_id, $count); //set count words in db
        $cache->set('words_' . $session_id, $arr); //array of id of words
        return true;

    }

    static function initSession($user_id)
    {
        if (!isset($user_id)) {
            $session = Yii::$app->session;
            if (!$session->isActive) {
                $session->open();
            }
            $session_id = Yii::$app->session->getId();

        } else {
            $session_id = $user_id;
        }
        return $session_id;
    }
}