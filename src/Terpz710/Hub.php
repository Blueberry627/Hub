<?php

declare(strict_types=1);

namespace Terpz710;

use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\permission\Permission;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\world\WorldManager;
use Terpz710\command\HubCommand;
use Terpz710\command\SetHubCommand;

class Hub extends PluginBase implements Listener {

    private WorldManager $worldManager;
    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register("hub", new HubCommand($this));
        $this->getServer()->getCommandMap()->register("sethub", new SetHubCommand($this, $this->worldManager));

        $this->worldManager = new WorldManager($this->getServer(), $this->getDataFolder(), $this->getServer()->getWorldManager());
    }

    public function onPlayerDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $spawnLocation = $this->worldManager->getDefaultWorld()->getSpawnLocation();
        $player->teleport($spawnLocation);
    }
}
