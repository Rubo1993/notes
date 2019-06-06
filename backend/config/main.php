<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
	    'gridview' =>  [
		    'class' => '\kartik\grid\Module'
	    ],
	    'lowbase-user' => [
		    'class' => '\lowbase\user\Module',
	    ],

    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',

//	                    'baseUrl' => '/admin'
        ],


        'view' => [
            'theme' => [
                'pathMap' => [
                    '@vendor/lowbase/yii2-user/views/user' => '@app/views/user'
                ],
            ],
        ],


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

        'authManager' => [
	        'class' => 'yii\rbac\DbManager',
	        'itemTable' => 'lb_auth_item',
	        'itemChildTable' => 'lb_auth_item_child',
	        'assignmentTable' => 'lb_auth_assignment',
	        'ruleTable' => 'lb_auth_rule'
        ],
	    

        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            ],
        ],

    ],
    'params' => $params,
];
