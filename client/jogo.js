window.onload = function() {

    var server = new WebSocket('ws://localhost:8080');
    server.onopen = function(e) {
        console.log("Connection established!");
        $canvas.init('canvas');
    };

    // Inicializar o canvas
    $canvas.init('canvas');

    // Criação da estrutura do jogo
    var objects = [];

    // Recebimento de dados do servidor
    server.onmessage = function(m) {
        objects = JSON.parse(m.data);
    };

    // Loop de renderização do jogo
    var drawLoop = function() {
        $canvas.clear();
        for (i = 0; i < objects.length; i++) {
            $canvas.drawCircle(objects[i].x, objects[i].y, objects[i].r, objects[i].color);
        }
    }

    MainLoop.setDraw(drawLoop).start();
}