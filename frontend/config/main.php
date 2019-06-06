<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
//    'controllerMap' => [
//	    'user'=> 'lowbase\user\controllers\UserController'
//    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ''
        ],


//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
//        ],
        'user' => [
	        'identityClass' => 'lowbase\user\models\User',
	        'enableAutoLogin' => true,
	        'loginUrl' => ['/login'],
	        'on afterLogin' => function($event) {
		        lowbase\user\models\User::afterLogin($event->identity->id);
	        }
        ],
        'authClientCollection' => [
	        'class' => 'yii\authclient\Collection',
	        'clients' => [
		        'vkontakte' => [
			        // https://vk.com/editapp?act=create
			        'class' => 'lowbase\user\components\oauth\VKontakte',
			        'clientId' => '?',
			        'clientSecret' => '?',
			        'scope' => 'email'
		        ],
//		        'google' => [
//			        // https://console.developers.google.com/project
//			        'class' => 'lowbase\user\components\oauth\Google',
//			        'clientId' => '?',
//			        'clientSecret' => '?',
//		        ],
		        'twitter' => [
			        // https://dev.twitter.com/apps/new
			        'class' => 'lowbase\user\components\oauth\Twitter',
			        'consumerKey' => '?',
			        'consumerSecret' => '?',
		        ],
		        'facebook' => [
			        // https://developers.facebook.com/apps
			        'class' => 'lowbase\user\components\oauth\Facebook',
			        'clientId' => '?',
			        'clientSecret' => '?',
		        ],
		        'github' => [
			        // https://github.com/settings/applications/new
			        'class' => 'lowbase\user\components\oauth\GitHub',
			        'clientId' => '?',
			        'clientSecret' => '?',
			        'scope' => 'user:email, user'
		        ],
//		        'yandex' => [
//			        // https://oauth.yandex.ru/client/new
//			        'class' => 'lowbase\user\components\oauth\Yandex',
//			        'clientId' => '?',
//			        'clientSecret' => '?',
//		        ],
	        ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
	            //Взаимодействия с пользователем на сайте
	            '<action:(login|logout|signup|confirm|reset|profile|remove|online)>' => 'lowbase-user/user/<action>',
	            //Взаимодействия с пользователем в панели админстрирования
	            'admin/user/<action:(index|update|delete|view|rmv|multidelete|multiactive|multiblock)>' => 'lowbase-user/user/<action>',
	            //Авторизация через социальные сети
	            'auth/<authclient:[\w\-]+>' => 'lowbase-user/auth/index',
	            //Просмотр пользователя
	            'user/<id:\d+>' => 'lowbase-user/user/show',
	            //Взаимодействия со странами в панели админстрирования
	            'admin/country/<action:(index|create|update|delete|view|multidelete)>' => 'lowbase-user/country/<action>',
	            //Поиск населенного пункта (города)
	            'city/find' => 'lowbase-user/city/find',
	            //Взаимодействия с городами в панели администрирования
	            'admin/city/<action:(index|create|update|delete|view|multidelete)>' => 'lowbase-user/city/<action>',
	            //Работа с ролями и разделением прав доступа
	            'admin/role/<action:(index|create|update|delete|view|multidelete)>' => 'lowbase-user/auth-item/<action>',
	            //Работа с правилами контроля доступа
	            'admin/rule/<action:(index|create|update|delete|view|multidelete)>' => 'lowbase-user/auth-rule/<action>',
	            'notes/view/<slug>'=> 'notes/view',
	            'author/profile/<slug>'=> 'author/profile',
	            'author/whishlist/<slug>'=>'author/whishlist/',
	            'author/cart/<slug>'=>'author/cart',
	            'author/delete/<id>'=>'author/delete/',
	            'notes/download/<slug>'=>'notes/download/',
	            'review/edit/<slug>'=>'review/edit',
	            'notes/need/<id>'=>'notes/need/',
                'notes/update/<slug>'=>'notes/update/',
                'notes/change/<slug>'=>'notes/change/',
                'student/profile/<slug>'=>'student/profile/'
            ],
        ],

    ],
    'modules' => [
	    'user' => [
		    'class' => '\lowbase\user\Module',
		    'customViews' => [
			    // Меняем стандартное отображение профиля
			    'signup ' => '@frontend/views/user/signup'
		    ]
	    ],
	    'pdfjs' => [
		    'class' => '\yii2assets\pdfjs\Module',
	    ],





    ],
    'params' => $params,
];
