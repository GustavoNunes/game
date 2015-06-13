<?php
namespace Jogo\Objects;

class Soldier extends Entity {
    protected $radius = 10;
    protected $movementSpeed = 3;

    public function handleCollision(Object $object) {
        if ($object instanceof Soldier) {
            switch (rand(1,5)) {
                case 1: $this->shape->color = 'D00'; break;
                case 2: $this->shape->color = '0D0'; break;
                case 3: $this->shape->color = '00D'; break;
                case 4: $this->shape->color = 'D0D'; break;
            }
        }
    }
}