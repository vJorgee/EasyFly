<?php

namespace FlyUI;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {


    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "Plugin enabled!");
    }

    public function onDisable() {
$this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info(TextFormat::RED . "plugib disabled!");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "fly":
                if ($sender->hasPermission("fly.command")){
                     $this->openMyForm($sender);
                }else{     
                     $sender->sendMesseage(TextFormat::RED . "You do not have permissions to run this command");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function openMyForm($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $player->sendMessage(TextFormat::GREEN . "Fly mode enable!");
                    $player->addTitle("§l§6Fly", "§a§lEnable");
                    $player->setAllowFlight(true);
                break;
                    
                case 1:
                    $player->sendMessage(TextFormat::RED . "Fly mode disable!");
                    $player->addTitle("§l§6Fly", "§c§lDisable");
                    $player->setAllowFlight(false);
                break;
            }
            
            
            });
            $form->setTitle("§l§6FlyUI");
            $form->setContent("Select an option :)!");
            $form->addButton("§lEnable");
            $form->addButton("§lDisable");
            $form->addButton("§l§cExit");
            $form->sendToPlayer($player);
            return $form;                                            
    }
                                                                                                                                                                                                                                                                                          
}
