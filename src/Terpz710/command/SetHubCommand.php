<?php

declare(strict_types=1);

namespace Terpz710\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;
use pocketmine\math\Vector3;
use Terpz710\Hub as Main;

class SetHubCommand extends Command {

    public function __construct() {
        parent::__construct(
            "sethub",
            "Set the hub",
            "/sethub <x> <y> <z>",
            ["setlobby", "setspawn"]
        );
        $this->setPermission("sethub.command");
    }

    public function execute(CommandSender $sender, string $label, array $args) {
        if (!$this->testPermission($sender)) {
            return;
        }

        if ($sender instanceof Player) {
            if (isset($args[0]) && isset($args[1]) && isset($args[2])) {
                $x = (float)$args[0];
                $y = (float)$args[1];
                $z = (float)$args[2];

                $pos = new Vector3($x, $y, $z);
                $pos->round();

                $sender->getWorld()->setSpawnLocation($pos);
                $sender->sendMessage(TextFormat::GREEN . "Hub location set to ($x, $y, $z)");
            } else {
                $sender->sendMessage(TextFormat::RED . "Please enter all three coordinates");
            }
        } else {
            $sender->sendMessage(TextFormat::RED . "This command can only be used by players");
        }
    }
}
