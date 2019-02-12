<?php

$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

//注册连接成功回调
$client->on("connect", function($cli) {
    $cli->send("开始计算\n");
});

//注册数据接收回调
$client->on("receive", function($cli, $data){
    echo "Received: ".$data."\n";
    $cli->close();
});

//注册连接失败回调
$client->on("error", function($cli){
    echo "连接失败\n";
});

//注册连接关闭回调
$client->on("close", function($cli){
    echo "关闭连接\n";
});

//发起连接
$client->connect('127.0.0.1', 10000, 0.5);

while (1){
  $a = rand(1,999);
  $b = rand(1,999);
  $cli->send($a.' * '.$b.' = '.$a*$b."\n");
  sleep(1);
}