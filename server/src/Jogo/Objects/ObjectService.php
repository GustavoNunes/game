<?php
namespace Jogo\Objects;

class ObjectService {
    protected $objects = [
        'soldiers' => []
    ];

    public function createSoldiers($num) {
        for ($i = 0; $i < $num; $i++) {
            $soldier = new Soldier();
            $this->objects['soldiers'][] = $soldier;
            $soldier->id = $i + 1;
        }
    }

    public function update() {
        $this->verifyCollisions();
        foreach($this->objects['soldiers'] as $soldier) {
            $soldier->runAI();
        }
    }

    public function getRenderState() {
        $objectStates = [];
        array_walk_recursive($this->objects, function($obj) use (&$objectStates) {
            $objectStates[] = $obj->getRenderState();
        });
        return $objectStates;
    }

    protected function verifyCollisions() {
        foreach($this->objects['soldiers'] as $soldier) {
            array_walk_recursive($this->objects, function($object) use ($soldier) {
                if ($soldier != $object) {
                    $soldier->verifyCollisionWith($object);
                }
            });
        };
    }

    protected function getObjectsNear($object) {

        array_walk_recursive($this->objects, function($otherObject) use ($object) {
            if ($soldier != $object) {
                $soldier->verifyCollisionWith($object);
            }
        });

    }
}