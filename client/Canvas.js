var $canvas = (function() {
    var canvasElement;
    var context;

    function initialize(id) {
        canvasElement = document.getElementById(id);
        context = canvasElement.getContext('2d');
    }

    function getWidth() { return canvasElement.width; }
    function getHeight() { return canvasElement.height; }

    function drawCircle(x, y, radius, color) {
        context.beginPath();
        context.arc(x, y, radius, 0, 2 * Math.PI);
        if (color) {
            context.fillStyle = '#' + color;
            context.fill();
        } else {
            context.stroke();
        }
    }

    function clear() {
        context.clearRect(0, 0, getWidth(), getHeight());
    }

    return {
        init: initialize,
        getWidth: getWidth,
        getHeight: getHeight,
        drawCircle: drawCircle,
        clear: clear
    }
}());