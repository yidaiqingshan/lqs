<?php

//异步mysql客户端
go(function (){
    $db = new Swoole\MySQL;
    $server = array(
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '136lqs15opq',
        'database' => 'yidai',
    );

    $db->connect($server, function ($db, $result) {
        var_dump($db);
        var_dump($result);
//        $db->query("show tables", function (Swoole\MySQL $db, $result) {
//            var_dump($result);
//            $db->close();
//        });
    });
});
