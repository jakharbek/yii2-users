Users Functionality
===================
Users Functionality

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist jakharbek/yii2-users "*"
```

or add

```
"jakharbek/yii2-users": "*"
```

to the require section of your `composer.json` file.


Configuration
------------

Connect the module to the public (frontend) part:

module path
```
jakharbek\users\modules\user\Module
```

and specify the path to the token confirmation controller
```
'confirmLink', 'unConfirmLink'
```

example

```
'modules' => [
      	
	...
        
	'users' => [
            'class' => 'jakharbek\users\modules\user\Module',
            'confirmLink' => 'http://sitename.loc/users/token/confirm?token=',
            'unConfirmLink' => 'http://sitename.loc/users/token/unconfirm?token=',
        ],
    ],
```




Connect the module to the admin (backend) part:

module path
```
jakharbek\users\modules\admin\Module
```

and specify the path to the token confirmation controller from frontend public part
```
'confirmLink', 'unConfirmLink'
```

example

```
'modules' => [
      	
	...
        
	'users' => [
            'class' => 'jakharbek\users\modules\admin\Module',
            'confirmLink' => 'http://sitename.loc/users/token/confirm?token=',
            'unConfirmLink' => 'http://sitename.loc/users/token/unconfirm?token=',
        ],
    ],
```

After you have to connect the controllers

```
'controllerMap' => [
        'login' => 'jakharbek\users\modules\admin\controllers\LoginController',
        'logout' => 'jakharbek\users\modules\admin\controllers\LogoutController',
    ],
```

and you also need to configure the mail component and should be under the mailer ID

and add in main params your email
```
[
    'email_from' => 'your@mail',
]
```

and you must make migration.
you can find migrations from folder migrations in extension's folder


