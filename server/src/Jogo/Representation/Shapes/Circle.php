<?php
namespace Jogo\Representation\Shapes;

class Circle {
    protected $r;
    public $color;

    public function __construct($r) {
        $this->r = $r;
        $this->color = '000';
    }

    public function toArray() {
        return [
            'r' => $this->r,
            'color' => $this->color
        ];
    }
}