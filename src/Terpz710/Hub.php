<?php

declare(strict_types=1);

namespace Terpz710;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\world\WorldManager;
use Terpz710\command\HubCommand;
use Terpz710\command\SetHubCommand;
use Terpz710\command\DeleteHubCommand;

class Hub extends PluginBase implements Listener {

    /** @var WorldManager */
    private $worldManager;

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register("hub", new HubCommand());
        $this->getServer()->getCommandMap()->register("sethub", new SetHubCommand());
        $this->getServer()->getCommandMap()->register("deletehub", new DeleteHubCommand());
        $this->getWorldManager()->getDefaultWorld();
    }

    public function onPlayerDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $spawnLocation = $player->getWorld()->getSpawnLocation();
        $player->teleport($spawnLocation);
    }

    public function getWorldManager(): WorldManager {
        if ($this->worldManager === null) {
            $this->worldManager = $this->getServer()->getWorldManager();
        }
        return $this->worldManager;
    }
}
