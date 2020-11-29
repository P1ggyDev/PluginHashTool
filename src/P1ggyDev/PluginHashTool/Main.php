<?php

namespace P1ggyDev\PluginHashTool;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase {
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
        if($cmd->getName() == "hash") {
            if(!$sender instanceof Player) {
                if(empty($args[0])) {
                    $sender->sendMessage(C::YELLOW . "Usage: /hash <plugin name> \n" . C::RED . "Example: /hash <plugin name>");                    
                    return true;
                } else {
                    $pluginName = $args[0];
                    $pluginDirectory = $this->getServer()->getDataPath() . "plugins/" . $pluginName . ".phar";
                    if(file_exists($pluginDirectory)) {
                        $hashStr = hash_file("sha256", $pluginDirectory);
                        $sender->sendMessage(C::GREEN . $pluginName . ".phar " . $hashStr);
                        return true;
                    } else {
                        $sender->sendMessage(C::RED . "Plugin not found!");
                        return true;
                    }
                }
            } else {
                $sender->sendMessage(C::RED . "Please use this command in console");
            }
        }
        return true;
    }
}