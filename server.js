var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8890);
io.on('connection',function(socket){
   console.log("new client connected");
    var redisClient = redis.createClient();
    var store = socket.handshake.query.id_store;

    if (store != null) {
        redisClient.subscribe(store);
        redisClient.subscribe('0');
        console.log('Suscribe to: ' + store)
    } else {
        redisClient.subscribe('all');
        console.log('Suscribe to all')
    }

    redisClient.on('message', function(channel, data){
        data = JSON.parse(data);

        if (data.action == 'new_order') {
            console.log('New order created by: ' + data.data);
        } else if (data.action == 'new_user') {
            console.log('New user created: ' + data.data);
        }

        socket.emit(data.action, data.data);
    });

    socket.on('disconnect',function(){
        console.log("client disconnect");
        redisClient.quit();
    });
});