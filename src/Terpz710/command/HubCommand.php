<?php

declare(strict_types=1);

namespace Terpz710\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

class HubCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
        parent::__construct(
            "hub",
            "Teleport to hub",
            "/hub",
            ["lobby", "spawn"]
        );
        $this->setPermission("hub.command");
    }

    public function execute(CommandSender $sender, string $label, array $args) {
        if (!$this->testPermission($sender)) {
            return;
        }

        if ($sender instanceof Player) {
            $spawnLocation = $sender->getWorld()->getSpawnLocation();
            $sender->teleport($spawnLocation);
            $sender->sendMessage(TextFormat::GREEN . "You have been teleported to hub");
        } else {
            $sender->sendMessage(TextFormat::RED . "This command can only be used by a player");
        }
    }
}
