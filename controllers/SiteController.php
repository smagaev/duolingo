<?php

namespace app\controllers;

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
        $parms = Yii::$app->request->get();
        $user_id = Yii::$app->getUser()->id;
        //meta tags
        Yii::$app->view->registerMetaTag(['name' => "description", "content" => "Этот сайт поможет вам быстро изучить английский, немецкий и другие языки"]);

        /*Insert times in table "excluding"*/
        if (isset($user_id)) {
            foreach ($parms as $key => $val) {
                if (strpos($key, 't_') === 0) {
                    $key = explode('_', $key)[1];
                    if ($model = Exclude::find()->where(['=', 'word_id', $key])->andWhere(['=', 'user_id', $user_id])->one()) {
                        $model->time = $val;
                        $model->save();
                    } else {
                        $model = new Exclude();
                        $model->user_id = $user_id;
                        $model->word_id = $key;
                        $model->time = $val;
                        $model->save();
                    }
                }
            }
        }
        if (!isset($user_id)) {
            $session = Yii::$app->session;
            if (!$session->isActive) {
                $session->open();
            }
            $session_id = Yii::$app->session->getId();
        } else {
            $session_id = $user_id;

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
        /*End insert times in table "excluding" */

        $cache = Yii::$app->cache;

        /*Clear cache after achieved of end*/

        if ($cache->get('count_words_in_db' . $session_id) == 0) {
            $cache->delete('count_words_in_db' . $session_id);
            $cache->delete('words_' . $session_id);
        }


        /*Set cache*/
        if (!isset($user_id)) {
            $count_words_db = $cache->getOrSet('count_words_in_db' . $session_id, function () {
                return Duolingo::find()->count();
            });
        } else {
            if (!$count_words_db = $cache->get('count_words_in_db' . $session_id)) {
                $count_words_db = Duolingo::find()->where(['user_id' => $user_id])->count();
                $cache->set('count_words_in_db' . $session_id, $count_words_db);
            }
        };
        /*End set cache*/

        if ($count_words_db > 0) {
            if (!isset($user_id)) {
            $arr = $cache->getOrSet('words_' . $session_id, function () {
                return Duolingo::find()->column();
            });
            } else {
                if (!$arr= $cache->get('words_' . $session_id)){
                    $arr =  Duolingo::find()->where(['user_id' => $user_id])->column();
                    $cache->set('words_' . $session_id, $arr);
                }
            }

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
            if (!isset($words)) return "<a href='/clear'> вы прошли курс</a>";

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
        } else {
            Yii::$app->session->setFlash('warning', Yii::t('app', 'Error empty db'));
            return $this->redirect(['/words', 'language' => Yii::$app->request->get('language')]);
        }

    }

    /**
     *
     */
    public function actionSetlevel()
    {
        $user_id = Yii::$app->getUser()->id;
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
        //set vars
        $level = Yii::$app->request->get('level');
        if ($user_id) {
            if ($level == 6) {
                $models = Duolingo::find()->where(['>', 'count_words', 5])->andWhere(['user_id' => $user_id]);
            } else {
                $models = Duolingo::find()->where(['count_words' => $level, 'user_id' => $user_id]);
            }
        } else {
            if ($level == 6) {
                $models = Duolingo::find()->where(['>', 'count_words', 5]);
            } else {
                $models = Duolingo::find()->where(['=', 'count_words', $level]);
            }
        }
        $count = $models->count();
        if ($count > 0) {
            $arr = $models->column();

        }
        //exclude
        switch ($level) {
            case 1 :
                $limit = 100;
                break;
            case 2 :
                $limit = 120;
                break;
            case 3 :
                $limit = 140;
                break;
            case 4 :
                $limit = 160;
                break;
            case 5 :
                $limit = 180;
                break;
            case 6 :
                $limit = 300;
                break;
            case 7 :
                $limit = 400;
                break;
        }
        $excl_models = Exclude::find()->select('word_id')->where(['=', 'user_id', $user_id])->andWhere(['>', 'time', $limit])->asArray()->column();
        //   var_dump ($excl_models);
        $arr = array_diff($arr, $excl_models);
        //   var_dump($arr); die;

        //set cache
        $cache->set('level_' . $session_id, $level); //set level
        $cache->set('count_words_in_db' . $session_id, $count); //set count words in db
        $cache->set('words_' . $session_id, $arr); //array of id of words

        Yii::$app->getResponse()->redirect('/index');
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
        $userId = Yii::$app->getUser()->id;
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
