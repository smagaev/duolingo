<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Duolingo;

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
        $error_words = false;
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
          $session_id = Yii::$app->session->getId();
        $cache = Yii::$app->cache;
        if ($cache->get('count_words_in_db') == 5) {
            $cache->delete('words_' . $session_id);
        }
        $count_words_db = $cache->getOrSet('count_words_in_db', function () {
            return Duolingo::find()->count();
        });
        if ($count_words_db > 0) {
            $arr = $cache->getOrSet('words_' . $session_id, function () {
                return Duolingo::find()->column();
            });
            $count_words = count($arr);
            $count_ready = $count_words_db - $count_words;
            if ($count_words > 5) {
                $min = min($arr);
                $max = max($arr);
                for ($i = 0; $i < 5; $i++) {
                    $count = count($arr);
                    $id_rand = mt_rand($min, $max);
                    $words[$i] = Duolingo::findOne($id_rand);
                    unset($arr[$id_rand]);
                }
            } else {
                $min = min($arr);
                $max = max($arr);
                for ($i = 0; $i < count($arr)-1; $i++) {
                    $count = count($arr);
                    $id_rand = mt_rand($min, $max);
                    $words[$i] = Duolingo::findOne($id_rand);
                    unset($arr[$id_rand]);
                }
            }
            $cache->set('words_' . $session_id, $arr);
            return $this->render('index', compact('words', 'count_words_db', 'count_ready'));
        } else return "Error: In Data Base has not enough words for correct work. Please insert words on tab words";

    }

    public function actionWords()
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
                                    if (!Duolingo::find()->where(['word' => $eng])->one()) {
                                        $model = new Duolingo();
                                        $model->word = $eng;
                                        $model->var1 = $ru;
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
