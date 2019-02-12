<?php

$client = new swoole_client(SWOOLE_SOCK_TCP);

//连接到服务器
if (!$client->connect('127.0.0.1', 10000, 0.5))
{
    die("connect failed.");
}
while (1){
    //向服务器发送数据
    if (!$client->send("hello ".rand(1,999)."\n"))
    {
        die("send failed.");
    }
//从服务器接收数据
    $data = $client->recv();
    if (!$data)
    {
        die("recv failed.");
    }
    echo $data;
    sleep(1);
}

//关闭连接
$client->close();