const app = require('express')();
const http = require('http').Server(app);
const io = require('socket.io')(http);
const port = process.env.PORT || 3000;

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

io.on('connection', (socket) => {
	  var clientIp = socket.request.connection.remoteAddress;
	io.emit('chat message', 'New connection from ' + clientIp);
  socket.on('chat message', msg => {
	console.log(msg);
    io.emit('chat message', msg);
  });
});

http.listen(port, () => {
  console.log(`Socket.IO server running at http://localhost:${port}/`);
});
