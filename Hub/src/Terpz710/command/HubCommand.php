<?php

namespace Terpz710\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\world\WorldManager;

class HubCommand extends Command {

    private $plugin;
    private WorldManager $worldManager;

    public function __construct(Main $plugin, WorldManager $worldManager) {
        $this->plugin = $plugin;
        $this->worldManager = $worldManager;
        parent::__construct(
            "hub",
            "Teleport to hub",
            "/hub",
            ["lobby", "spawn"]
        );
        $this->setPermission("hub.command");
    }

    public function getPlugin() : Plugin {
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args) {
        if (!$this->testPermission($sender)) {
            return;
        }

        $spawnLocation = $this->worldManager->getDefaultWorld()->getSpawnLocation();

        if ($sender instanceof Player) {
            if (isset($args[0])) {
                if ($this->worldManager->getServer()->getPlayer($args[0])) {
                    $player = $this->worldManager->getServer()->getPlayer($args[0]);
                    $player->teleport($spawnLocation);
                    $player->sendMessage(TextFormat::GREEN . "You have been teleported to hub");
                    $sender->sendMessage(TextFormat::GREEN . "Teleported " . $player->getName() . " to hub");
                } else {
                    $sender->sendMessage(TextFormat::RED . "Player not found");
                }
            } else {
                $sender->teleport($spawnLocation);
                $sender->sendMessage(TextFormat::GREEN . "You have been teleported to hub");
            }
        } else {
            if (isset($args[0])) {
                if ($this->worldManager->getServer()->getPlayer($args[0])) {
                    $player = $this->worldManager->getServer()->getPlayer($args[0]);
                    $player->teleport($spawnLocation);
                    $player->sendMessage(TextFormat::GREEN . "You have been teleported to hub");
                    $sender->sendMessage(TextFormat::GREEN . "Teleported " . $player->getName() . " to hub");
                } else {
                    $sender->sendMessage(TextFormat::RED . "Player not found");
                }
            } else {
                $sender->sendMessage(TextFormat::RED . "Please enter a player name");
            }
        }
    }
}
