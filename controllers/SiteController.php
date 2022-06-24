<?php

namespace app\controllers;

use app\components\MyFunctions;
use Yii;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Duolingo;
use app\models\Statistika;
use app\models\Options;
use app\models\Exclude;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'words'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['words'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */


    public function actionIndex()
    {
        $quantity = Yii::$app->request->get('quantity');
        if (Yii::$app->request->get('err_db')) {
            yii::$app->session->setFlash('danger', '*** НЕТ СЛОВ В БАЗЕ ДАННЫХ ***');
            return $this->redirect('/words');
        }
        $params = Yii::$app->request->get();
        $user_id = Yii::$app->getUser()->id;
        //meta tags
       if ($user_id) {
            MyFunctions::addExcludingWords($user_id, $params);

            MyFunctions::addTableStat($user_id, $quantity);
        }
        if (!isset($user_id)) {
            $session = Yii::$app->session;
            if (!$session->isActive) {
                $session->open();
            }
            $session_id = Yii::$app->session->getId();
        } else {
            $session_id = $user_id;
        }

        $cache = Yii::$app->cache;
        if (!$level = Yii::$app->cache->get('level_' . $session_id) or !$count_words_db = $cache->get('count_words_in_db' . $session_id))
            return $this->redirect(['/setlevel', 'level' => 1]);

        /*get cache*/

        if ($count_words_db > 0) {
            $arr = $cache->get('words_' . $session_id);
        }

        /*End set cache*/


        $count_words = count($arr);
        $count_ready = $count_words_db - $count_words;
        if ($count_words > 5) {
            for ($i = 0; $i < 5; $i++) {
                $id_rand = array_rand($arr, 1);
                $words[$i] = Duolingo::findOne($arr[$id_rand]);
                unset($arr[$id_rand]);
                sort($arr);
            }
        } else {
            $count = count($arr);
            for ($i = 0; $i < $count; $i++) {
                $id_rand = array_rand($arr, 1);
                $words[$i] = Duolingo::findOne($arr[$id_rand]);
                unset($arr[$id_rand]);
                sort($arr);
            }
        }
        $cache->set('words_' . $session_id, $arr);
        if (!isset($words)) {
            //   Yii::$app->session->setFlash('success', "Вы выучили все слова на этом уровне, выберите другой или этот еще раз!");
            return $this->redirect(['/setlevel']);
        }

        //revert source and destination (word <>translate)
        $revert = rand(1, 2);
        if ($revert == 1) {
            foreach ($words as $val) {
                $temp = $val['var1'];
                $val['var1'] = $val['word'];
                $val['word'] = $temp;
            }
        }

        return $this->render('index', compact('words', 'count_words_db', 'count_ready'));


    }

    /**
     *
     */
    public function actionSetlevel()
    {
        $user_id = Yii::$app->getUser()->id;

        $session_id = MyFunctions::initSession($user_id);

        if (!$level = Yii::$app->request->get('level')) {

            $level = Yii::$app->cache->get('level_' . $session_id);
        } else {
            Yii::$app->cache->set('level_' . $session_id, $level); /*if level came through get request save it to cache */
        }

        if (MyFunctions::initCacheWithExcludingWords($user_id, $level, $session_id)) {

            Yii::$app->getResponse()->redirect(['/']);
        } else {
            Yii::$app->getResponse()->redirect(['/', 'err_db' => 'no_words']);
        }
    }

    public function actionStat()
    {
        $userId = yii::$app->user->getId();
        $countStadied = Statistika::find()->where(['=', 'user_id', $userId])->sum('quantity');
        $grafic_data = Statistika::find()->select('data, quantity')->where(['user_id' => $userId])->andWhere(['>=', 'data', date("Y-m", time()) . "-01"])->asArray()->all();
        return $this->render('stat', compact('countStadied', 'grafic_data'));
    }

    public
    function actionLevel()
    {

        $userId = Yii::$app->getUser()->id; //for unregistered user
        if (!$userId) $userId = 100;
        if (Duolingo::find()->where(['user_id' => $userId])->count() > 0) {
            for ($i = 1; $i < 7; $i++) {
                $i < 6 ? $countL[$i] = Duolingo::find()->where(['count_words' => $i])->andWhere(['user_id' => $userId])->count()
                    : $countL[$i] = Duolingo::find()->where(['>', 'count_words', $i - 1])->andWhere(['user_id' => $userId])->count();
            }
        } else {
            for ($i = 1; $i < 7; $i++) {
                $i < 6 ? $countL[$i] = Duolingo::find()->where(['count_words' => $i])->count()
                    : $countL[$i] = Duolingo::find()->where(['>', 'count_words', $i - 1])->count();
            }
        }

        return $this->render('level', compact('countL'));
    }

    public
    function actionWords()
    {
        $ok = false;
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('words');
        } else {
            set_time_limit(180);
            $string = $request->post('Words')['words'];
            $array = explode(chr(13), $string);
            foreach ($array as $val) {
                $arr = explode(':', $val);
                if (trim($arr[0])) {
                    {
                        if (isset($arr[0])) {
                            if (trim($arr[0]) > "") {
                                $eng = trim($arr[0]);
                                if (isset($arr[1])) {
                                    $ru = trim($arr[1]);
                                    $userId = Yii::$app->getUser()->id;
                                    if (!Duolingo::find()->where(['word' => $eng, 'user_id' => $userId])->one()) {
                                        $model = new Duolingo();
                                        $model->word = $eng;
                                        $model->count_words = str_word_count($eng);
                                        $model->var1 = $ru;
                                        $model->user_id = $userId;
                                        if ($model->validate()) {

                                            if ($model->save()) {
                                                if (!$ok) {
                                                    $ok = true;
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($ok) {
                Yii::$app->session->setFlash('success', "All ok, the words are added");
                Yii::$app->cache->flush();
            } else {
                Yii::$app->session->setFlash('error', 'Please, check the format ...');
            }
            return $this->render('words');
        }
    }

    public function actionOptions()
    {
        $userID= Yii::$app->getUser()->identity->id;
       if(!$model = Options::find() -> where(['user_id'=>$userID])-> one()){
           $model = new Options([
               'user_id' => $userID,
               'timer1' => Yii::$app->params['timer1'],
               'timer2' => Yii::$app->params['timer2'],
               'timer3' => Yii::$app->params['timer3'],
               'timer4' => Yii::$app->params['timer4'],
               'timer5' => Yii::$app->params['timer5'],
               'timer6' => Yii::$app->params['timer6'],
               'sourceWords' => 0
           ]);
       }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                   $model->save();
            }
        }

        return $this->render('options', [
            'model' => $model,
        ]);
    }

    public
    function actionDeleteWords()
    {
        $userId = Yii::$app->getUser()->id;
        Duolingo::deleteAll(['user_id' => $userId]);
        Statistika::deleteAll(['user_id' => $userId]);
        Yii::$app->session->setFlash('success', 'All words delete from data base');
        return $this->goBack();
    }

    public
    function actionClear()
    {
        Yii::$app->cache->flush();
        return $this->goBack();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public
    function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public
    function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public
    function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public
    function actionAbout()
    {
        return $this->render('about');
    }
}
