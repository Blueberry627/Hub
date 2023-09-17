<?php

declare(strict_types=1);

namespace Terpz710;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;
use Terpz710\command\HubCommand;
use Terpz710\command\SetHubCommand;

class Hub extends PluginBase implements Listener {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register("hub", new HubCommand($this));
    }

    public function onPlayerDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $spawnLocation = $player->getWorld()->getSpawnLocation();
        $player->teleport($spawnLocation);
    }
}
