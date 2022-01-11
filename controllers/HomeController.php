<?php
/**
 * Created by PhpStorm.
 * User: smagaev
 * Date: 11.01.2022
 * Time: 16:21
 */

namespace app\controllers;


use yii\web\Controller;

class HomeController extends Controller
{

    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('index');
    }

}