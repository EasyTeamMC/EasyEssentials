<?php

/**
 *
 *  _____               _____                    __  __  ____ 
 * | ____|__ _ ___ _   |_   _|__  __ _ _ __ ___ |  \/  |/ ___|
 * |  _| / _` / __| | | || |/ _ \/ _` | '_ ` _ \| |\/| | |    
 * | |__| (_| \__ \ |_| || |  __/ (_| | | | | | | |  | | |___ 
 * |_____\__,_|___/\__, ||_|\___|\__,_|_| |_| |_|_|  |_|\____|
 *                 |___/
 *
 * 
 * Copyright 2021 EasyTeamMC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 *
 * @author EasyTeamMC
 * @link https://github.com/EasyTeamMC/EasyEssentials
 *
 */

namespace pedhot\easyessentials\commands\defaults;

use pedhot\easyessentials\commands\BaseCommand;
use pedhot\easyessentials\commands\TargetEnumArgument;
use pedhot\easyessentials\EasyEssentials;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\command\utils\NoSelectorMatchException;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class FlyCommand extends BaseCommand {

    protected function prepare(): void {
        $this->setUsage("/fly <player: target>");
        $this->registerArgument(0, new TargetEnumArgument("target", true));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        if (!$this->testPermission($sender)) return;
        if (!$sender instanceof Player) {
            if (empty($args["target"])) {
                throw new InvalidCommandSyntaxException();
            }
            if (($player = Server::getInstance()->getPlayer($args["target"])) instanceof Player) {
                if ($player->getAllowFlight()) {
                    $player->setAllowFlight(false);
                    $player->setFlying(false);
                    $sender->sendMessage(TextFormat::RED . EasyEssentials::getInstance()->getLanguage()->translateString("commands.fly.success.disabled.other", [$player->getName()]));
                }else {
                    $player->setAllowFlight(true);
                    $player->setFlying(true);
                    $sender->sendMessage(TextFormat::GREEN . EasyEssentials::getInstance()->getLanguage()->translateString("commands.fly.success.enabled.other", [$player->getName()]));
                }
            }else {
                throw new NoSelectorMatchException();
            }
            return;
        }
        if (empty($args["target"])) {
            if ($sender->hasPermission($this->getPerms("fly"))) {
                if ($sender->getAllowFlight()) {
                    $sender->setAllowFlight(false);
                    $sender->setFlying(false);
                    $sender->sendMessage(TextFormat::RED . EasyEssentials::getInstance()->getLanguage()->translateString("commands.fly.success.disabled"));
                }else {
                    $sender->setAllowFlight(true);
                    $sender->setFlying(true);
                    $sender->sendMessage(TextFormat::GREEN . EasyEssentials::getInstance()->getLanguage()->translateString("commands.fly.success.enabled"));
                }
                return;
            }
            $sender->sendMessage(TextFormat::RED . EasyEssentials::getInstance()->getLanguage()->translateString("commands.generic.permission"));
            return;
        }
        if ($sender->hasPermission($this->getPerms("fly.other"))) {
            if (($player = Server::getInstance()->getPlayer($args["target"])) instanceof Player) {
                if ($player->getAllowFlight()) {
                    $player->setAllowFlight(false);
                    $player->setFlying(false);
                    $sender->sendMessage(TextFormat::RED . EasyEssentials::getInstance()->getLanguage()->translateString("commands.fly.success.disabled.other", [$player->getName()]));
                }else {
                    $player->setAllowFlight(true);
                    $player->setFlying(true);
                    $sender->sendMessage(TextFormat::GREEN . EasyEssentials::getInstance()->getLanguage()->translateString("commands.fly.success.enabled.other", [$player->getName()]));
                }
            }else {
                throw new NoSelectorMatchException();
            }
            return;
        }
        $sender->sendMessage(TextFormat::RED . EasyEssentials::getInstance()->getLanguage()->translateString("commands.generic.permission"));
    }

}