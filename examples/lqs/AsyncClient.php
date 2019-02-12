<?php

//异步
go(function (){
    $db = new Swoole\MySQL;
    $server = array(
        'host' => '127.0.0.1:3306',
        'user' => 'root',
        'password' => '136LQS15opq',
        'database' => 'test',
    );

    $db->connect($server, function ($db, $result) {
        $db->query("show tables", function (Swoole\MySQL $db, $result) {
            var_dump($result);
            $db->close();
        });
    });
});



