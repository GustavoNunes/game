<?php
namespace Jogo;

use Jogo\Objects\ObjectService;

class GameWorld {
    protected $connection;
    protected $eventLoop;
    protected $objectService;
    protected $gameSettings;

    public function __construct($connection, $eventLoop) {
        $this->connection = $connection;
        $this->eventLoop = $eventLoop;
        $this->objectService = new ObjectService();

        $this->initializeGame();

        $this->configureUpdateLoop(0.015);
        $this->configureRenderLoop(0.015);
    }

    protected function initializeGame() {
        $this->objectService->createSoldiers(GameSettings::$numSoldiers);
    }

    protected function configureUpdateLoop($timer) {
        $this->eventLoop->addPeriodicTimer($timer, function () {
            $this->objectService->update();
        });
    }

    protected function configureRenderLoop($timer) {
        $this->eventLoop->addPeriodicTimer($timer, function () {
            $gameObjects = $this->objectService->getRenderState();
            $this->connection->broadcast($gameObjects);
        });
    }
}