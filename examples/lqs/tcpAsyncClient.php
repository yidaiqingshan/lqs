<?php

go(function (){
    $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

//注册连接成功回调
    $client->on("connect", function($cli) {
//        $cli->send("连接成功\n");
        $cli->send("GET / HTTP/1.1\r\n\r\n");
//        sleep(1);
//        $cli->send("开始计算\n");
//        sleep(1);
    });

//注册数据接收回调
    $client->on("receive", function($cli, $data){
        echo "Received: ".$data."\n";
        $cli->send(str_repeat('A', 100)."\n");
        sleep(1);
    });

//注册连接失败回调
    $client->on("error", function($cli){
        echo "Connect failed\n";
    });

//注册连接关闭回调
    $client->on("close", function($cli){
        echo "Connection close\n";
    });

//发起连接
    $client->connect('127.0.0.1', 10000, 0.5);
});



