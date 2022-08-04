<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.getenv('SQL_IP').';dbname=sirias',
    'username' => 'root',
    'password' => getenv('SQL_ROOT_PASSWORD'),
    'charset' => 'utf8',
];
