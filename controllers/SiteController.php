<?php

namespace app\controllers;

use app\components\Taxi;
use app\models\MyUser;
use app\models\RegistrationForm;
use app\models\UploadImageForm;
use app\models\User;
use Yii;
use yii\base\DynamicModel;
use yii\bootstrap\Progress;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\Sort;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use yii\web\View;
use yii\helpers\VarDumper;

class SiteController extends Controller
{
    public $layout = "newlayout";
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['about', 'contact'],
                'rules' => [
                    [
                        'actions' => ['about'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['contact', 'about'],
                        'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            [
                'class' => 'yii\filters\pageCache',
                'only' => ['index'],
                'duration' => 60
            ],
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index'],
                'lastModified' => function ($action, $params) {
            $q = new \yii\db\Query();
            return $q->from('news')->max('created_at');
                },
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
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
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $model->scenario =  ContactForm::SCENARIO_EMAIL_FROM_USER;
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionShowContactModel() {
        $mContactForm = new \app\models\ContactForm();
        $mContactForm->name = "contactForm";
        $mContactForm->email = "user@gmail.com";
        $mContactForm->subject = "subject";
        $mContactForm->body = "body";
        return \yii\helpers\Json::encode($mContactForm);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $email = "admin@support,com";
        $phone = "0655232896";
        \Yii::$app->view->on(View::EVENT_BEGIN_BODY, function () {
            echo date('m.d.Y H:i:s');
        });
        return $this->render('about', [
            'email' => $email,
            'phone' => $phone
        ]);
    }

    public function actionSpeak($message = "default message") {
        return $this->render("speak", ["message" => $message]);
    }

    public function actionTestWidget() {
        return $this->render('testwidget');
    }

    public function actionTestGet() {
        var_dump(Yii::$app->request->headers);
    }

    public function actionTestResponse() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'id' => '1',
            'name' => 'Ivan',
            'age' => 24,
            'country' => 'Poland',
            'city' => 'Warsaw'
        ];
    }

    public function actionMaintenance(){
        echo "<h1>Maintenance</h1>";
    }

    public function actionRoutes() {
        return $this->render('routes');
    }

    public function actionRegistration() {
        $model = new RegistrationForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request>post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return $this->render('registration', ['model' => $model]);
    }

    public function actionAdHocValidation() {
        $model = DynamicModel::validateData([
            'username' => 'Coen',
            'email' => 'coen@badbit.nl'
        ], [
            [['username', 'email'], 'string', 'max' => 12],
            ['email', 'email'],
        ]);

        if($model->hasErrors()) {
            var_dump($model->errors);
        } else {
            echo "<b>succes</b>";
        }
    }

    public function actionShowFlash() {
        $session = Yii::$app->session;
        $session->SetFlash('greeting', 'Hello user!');
        return $this->render('showflash');
    }

    public function actionReadCookies() {
        $cookies = Yii::$app->request->cookies;
        $language = $cookies->getValue('language', 'ru');
        if(($cookie = $cookies->get('language')) !== null) {
            $language = $cookie->value;
        }
        if(isset($cookie['language'])) {
            $language = $cookies['language']->value;
        }
        if($cookies->has('language')) {
            echo"Current language: $language";
        }
    }

    public function actionSendCookies() {
        // get cookies from the "response" component
        $cookies = Yii::$app->response->cookies;
        // add a new cookie to the response to be sent
        $cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => 'ru-RU',
        ]));
        $cookies->add(new \yii\web\Cookie([
            'name' => 'username',
            'value' => 'John',
        ]));
        $cookies->add(new \yii\web\Cookie([
            'name' => 'country',
            'value' => 'USA',
        ]));
    }

    public function actionUploadImage() {
        $model = new UploadImageForm();
        if(Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->upload()) {
                echo "file successfully uploaded";
                return;
            }
        }
        return $this->render('upload', ['model' => $model]);
    }

    public function actionFormatter() {
        return $this->render('formatter');
    }

    public function actionPagination() {
        //preparing the query
        $query = MyUser::find();
        // get the total number of users
        $count = $query->count();
        //creating the pagination object
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 10]);
        //limit the query using the pagination and retrieve the users
        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('pagination', [
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }

    public function actionSorting(){
        $sort = new Sort(['attributes' => ['id', 'name', 'email'],]);
        $models = MyUser::find()
            ->orderBy($sort->orders)
            ->all();
        return $this->render('sorting', [
            'models' => $models,
            'sort' => $sort
        ]);
    }

    public function actionProperties() {
        $object = new Taxi();
        $phone = $object->phone;
        var_dump($phone);
        $object->phone= '79005448877';
        var_dump($object);
    }

    public function actionDataProvider() {
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'SELECT * FROM user',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
        ]);
        $users = $provider->getModels();
        var_dump($users);
    }

    public function actionDataWidget() {
        $dataProvider = new ActiveDataProvider([
            'query' => MyUser::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('datawidget', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionTestEvent() {
        $model = new MyUser();
        $model->name = "Coen";
        $model->email = "coen@badbit.nl";
        if($model->save()) {
            $model->trigger(MyUser::EVENT_NEW_USER);
        }
    }

    public function actionTestBehavior() {
        $model = new Myuser();
        $model->name = "Coen";
        $model->email = "coen@badbit.nl";
        if($model->save()) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $data = MyUser::find()->asArray()->all();
        return $data ;
        }
    }

    public function actionTestInterface () {
        $container = new \yii\di\Container();
        $container->set
        ("\app\components\MyInterface","\app\components\First");
        $obj = $container->get("\app\components\MyInterface");
        $obj->test(); // print "First class"
        $container->set
        ("\app\components\MyInterface","\app\components\Seccond");
        $obj = $container->get("\app\components\MyInterface");
        $obj->test(); // print "Second class"
    }

    public function actionTestDb() {
        // insert a new row of data
        $user = new MyUser();
        $user->name = 'MyCustomUser2';
        $user->email = 'mycustomuser@gmail.com';
        $user->save();
        var_dump($user->attributes);
        echo "<br><br>";

        // update an existing row of data
        $user = MyUser::findOne(['name' => 'MyCustomUser2']);
        $user->email = 'newemail@gmail.com';
        $user->save();
        var_dump($user->attributes);
    }

    public function actionTestCache() {
        $cache = Yii::$app->cache;

        $data = $cache->get("my_cached_data");
        if($data === false) {
            $data = date("d.m.Y H:i:s");
            //cache set duration in seccondes
            $cache->set("my_cached_data", $data, 30);
        }
        var_dump($data);
    }

    public function actionQueryCaching() {
        $duration = 10;
        $result = MyUser::getDb()->cache(function ($db) {
            return MyUser::find()->count();
        }, $duration);
        var_dump($result);
        $user = new MyUser();
        $user->name = "cached user name";
        $user->email = "cachedusername@mail.com";
        $user->save();
        echo "<br>";
        echo"============== <br>";
        var_dump(MyUser::find()->count());
    }

    public function actionFragmentCaching() {
        $user = new MyUser();
        $user->name = "cached username";
        $user->email = "cachedusername@gmail.com";
        $user->save();
        $models = MyUser::find()->all();
        return $this->render('cachedview', ['models' => $models]);
    }

    public function actionAliases() {
        Yii::setAlias("@components", "@app/components");
        Yii::setAlias("@imagesUrl", "@web/images");
        var_dump(Yii::getAlias('@components'));
        echo "<br>";
        var_dump(Yii::getAlias('@imagesUrl'));
    }

    public function actionLog() {
        Yii::trace('trace log message');
        Yii::info('info log message');
        Yii::warning('warning log message');
        Yii::error('error log message');
    }

    public function actionShowError() {
        throw new NotFoundHttpException("Carnaval ging te hard");
    }

    public function actionAuth() {

        $password = "asd%#G3";

        //generates password hasg
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        var_dump($hash);
        echo"<br>=================<br>";

        //validates password hash
        if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
            echo "correct password<br>";
        } else {
            echo "incorrect password";
        }

        //generate a token
        $key = Yii::$app->getSecurity()->generateRandomString();
        var_dump($key);
        echo"<br>=================<br>";

        //encrypt data with a secret key
        $encryptedData = Yii::$app->getSecurity()->encryptByPassword("mydata", $key);
        var_dump($encryptedData);
        echo"<br>=================<br>";

        //decrypt data with a secret key
        $data = Yii::$app->getSecurity()->decryptByPassword($encryptedData, $key);
        var_dump($data);
        echo"<br>=================<br>";

        //hash data with a secret key
        $data = Yii::$app->getSecurity()->hashData("mygenuinedata", $key);
        var_dump($data);
        echo"<br>=================<br>";

        //validate data with a secret key
        $data = Yii::$app->getSecurity()->validateData($data, $key);
        var_dump($data);
        echo"<br>=================<br>";
    }

    public function actionTranslation() {
        $username = 'Vladimir';
        // display a translated message with username being "Vladimir"
        echo \Yii::t('app', 'Hello, {username}!', [
            'username' => $username,
        ]), "<br>";
        $username = 'John';
        // display a translated message with username being "John"
        echo \Yii::t('app', 'Hello, {username}!', [
            'username' => $username,
        ]), "<br>";
        $price = 150;
        $count = 3;
        $subtotal = 450;
        echo \Yii::t('app', 'Price: {0}, Count: {1}, Subtotal: {2}', [$price, $count, $subtotal]);
    }




}
