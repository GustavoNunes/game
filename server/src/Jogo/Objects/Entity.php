<?php
namespace Jogo\Objects;

use Jogo\GameSettings;

abstract class Entity extends Object {
    protected $decisionTimeout = null; // Date em milisegundos - até quando o soldado está ocupado para novas decisões
    protected $vx;
    protected $vy;

    public function runAI() {
        if ($this->decisionTimeout < now()) {
            $this->pickMovementDirection();
        }
        $this->move();
    }

    protected function pickMovementDirection() {
        switch (rand(0, 9)) {
            case 0: $this->vx = $this->vy = 0; break;
            case 1: $this->vx = $this->movementSpeed; break;
            case 2: $this->vx = -$this->movementSpeed; break;
            case 3: $this->vy = $this->movementSpeed; break;
            case 4: $this->vy = -$this->movementSpeed; break;
            case 5: $this->vx = $this->movementSpeed; $this->vy = $this->movementSpeed; break;
            case 6: $this->vx = -$this->movementSpeed; $this->vy = $this->movementSpeed; break;
            case 7: $this->vx = $this->movementSpeed; $this->vy = -$this->movementSpeed; break;
            case 8: $this->vx = -$this->movementSpeed; $this->vy = -$this->movementSpeed; break;
        }
        $this->decisionTimeout = now() + rand(500, 3000);
    }

    protected function move() {
        if ($this->vy != 0 || $this->vx != 0) {
            $destination = $this->position->toArray();
            $collision = false;

            $destination['x'] += $this->vx;
            $destination['y'] += $this->vy;

            // World boundary collision
            if (0 + $this->radius > $destination['x'] || $destination['x'] > GameSettings::$worldWidth - $this->radius ||
                0 + $this->radius > $destination['y'] || $destination['y'] > GameSettings::$worldHeight - $this->radius) {
                $collision = true;
            }

            if (!$collision) {
                $this->position->updatePosition($destination['x'], $destination['y']);
            }
        }
    }
}