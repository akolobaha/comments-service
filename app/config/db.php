<?php

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db_name = getenv('DB_NAME');

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host=${host};prot=${port};dbname=${db_name}",
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
