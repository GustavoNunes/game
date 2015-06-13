<?php
namespace Jogo\Objects;

use Jogo\GameSettings;
use Jogo\Representation\Position\Position;
use Jogo\Representation\Shapes\Circle;

abstract class Object {
    protected $radius;
    protected $status = [];
    protected $position;
    public $shape;

    public function __construct() {
        $x = rand(0 + $this->radius, GameSettings::$worldWidth - $this->radius);
        $y = rand(0 + $this->radius, GameSettings::$worldHeight - $this->radius);

        $this->position = new Position($x, $y);
        $this->shape = new Circle($this->radius);
    }

    protected function setStatus($value) {
        $this->status[] = $value;
    }

    public function getRenderState() {
        return array_merge($this->position->toArray(), $this->shape->toArray());
    }

    public function verifyCollisionWith(Object $obj) {
        if ($this->shape instanceof Circle && $obj->shape instanceof Circle) {
            $other = $obj->position->toArray();
            $thisPosition = $this->position->toArray();

            $dx = $thisPosition['x'] - $other['x'];
            $dy = $thisPosition['y'] - $other['y'];
            $distance = sqrt(pow($dx, 2) + pow($dy, 2));

            if ($distance < $this->radius + $obj->shape->toArray()['r']) {
                $this->handleCollision($obj);
            }
        }
    }

    abstract public function handleCollision(Object $object);
}