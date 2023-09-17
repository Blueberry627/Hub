<?php

namespace Terpz710\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;
use Terpz710\Hub as Main;
use pocketmine\world\WorldManager;

class SetHubCommand extends Command {

    private $plugin;
    private WorldManager $worldManager;

    public function __construct(Main $plugin, WorldManager $worldManager) {
        $this->plugin = $plugin;
        $this->worldManager = $worldManager;
        parent::__construct(
            "sethub",
            "Set the hub",
            "/sethub <x> <y> <z>",
            ["setlobby", "setspawn"]
        );
        $this->setPermission("sethub.command");
    }

    public function getPlugin() : Plugin {
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args) {
        if (!$this->testPermission($sender)) {
            return;
        }

        if ($sender instanceof Player) {
            if (isset($args[0]) && isset($args[1]) && isset($args[2])) {
                $x = $args[0];
                $y = $args[1];
                $z = $args[2];

                $pos = new Vector3($x, $y, $z);
                $pos->round();

                $sender->getLevel()->setSpawnLocation($pos);
                $sender->sendMessage(TextFormat::GREEN . "Hub location set to ($x, $y, $z)");
            } else {
                $sender->sendMessage(TextFormat::RED . "Please enter all three coordinates");
            }
        } else {
            $sender->sendMessage(TextFormat::RED . "This command can only be used by players");
        }
    }
}
