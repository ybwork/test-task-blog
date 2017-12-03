console.log('Server has been started!');

var http = require('http');
var fs = require('fs');

var server = http.createServer();
    server.listen(3001);
var io = require('socket.io')(server);

io.sockets.on('connection', function(socket) {
  var requestData = socket.request;
  var auction = requestData._query['auction_id'];

  if (auction != 'undefined') {
    socket.join(auction);

    socket.on('betRoom', function(bet) {
      // for sending bet to this auction
      io.sockets.in(auction).emit('betRoom', bet);
      
      // for sending all bets to home page
      io.sockets.emit('betsHome', bet);
      socket.on('betsHome', function(data) {});
    });
  }
});