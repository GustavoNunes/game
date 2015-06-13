<?php
namespace Jogo\Representation\Position;

class Position {
    protected $x;
    protected $y;

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function toArray() {
        return [
            'x' => $this->x,
            'y' => $this->y
        ];
    }

    public function updatePosition($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
}