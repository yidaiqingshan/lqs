<?php

////创建Server对象，监听 127.0.0.1:9501端口
//$serv = new swoole_server("127.0.0.1", 9501);
//
////监听连接进入事件
//$serv->on('connect', function ($serv, $fd) {
//    echo "Client: Connect.\n";
//});
//
////监听数据接收事件
//$serv->on('receive', function ($serv, $fd, $from_id, $data) {
//    $serv->send($fd, "Server: ".$data);
//});
//
////监听连接关闭事件
//$serv->on('close', function ($serv, $fd) {
//    echo "Client: Close.\n";
//});
//
////启动服务器
//$serv->start();

//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("127.0.0.1", 9502);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();