<?php

return [
    'oracle' => [
        'driver' => 'oracle',
        'tns' => env('DB_TNS_ORACLE', "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.168.105.233)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = mvtreina.hospitalsantamonica.org) (SID = orcl))"),
        'host' => env('DB_HOST_ORACLE', '10.168.105.233'),
        'port' => env('DB_PORT_ORACLE', 1521),
        'database' => env('DB_DATABASE_ORACLE', 'ORCL'),
        'service_name' => env('DB_SERVICE_NAME', 'mvtreina.hospitalsantamonica.org'),
        'username' => env('DB_USERNAME_ORACLE', 'dbamv'),
        'password' => env('DB_PASSWORD_ORACLE', 'odp3j#'),
        'charset' => env('DB_CHARSET', 'AL32UTF8'),
        'prefix' => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        'edition' => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
        'load_balance' => env('DB_LOAD_BALANCE', 'yes'),
        'max_name_len' => env('ORA_MAX_NAME_LEN', 30),
        'dynamic' => [],
        'sessionVars' => [
            'NLS_TIME_FORMAT' => 'HH24:MI:SS',
            'NLS_DATE_FORMAT' => 'YYYY-MM-DD HH24:MI:SS',
            'NLS_TIMESTAMP_FORMAT' => 'YYYY-MM-DD HH24:MI:SS',
            'NLS_TIMESTAMP_TZ_FORMAT' => 'YYYY-MM-DD HH24:MI:SS TZH:TZM',
            'NLS_NUMERIC_CHARACTERS' => '.,',
        ],
    ],
];
