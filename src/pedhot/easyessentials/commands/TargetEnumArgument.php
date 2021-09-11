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

namespace pedhot\easyessentials\commands;

use CortexPE\Commando\args\StringEnumArgument;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class TargetEnumArgument extends StringEnumArgument {

    public function getTypeName(): string {
        return "string";
    }

    public function parse(string $argument, CommandSender $sender) {
        return $argument;
    }

    public function getEnumValues(): array {
        $playerNames = [];
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $playerNames[$player->getName()] = $player;
        }
        return array_keys($playerNames);
    }

    public function getEnumName(): string {
        return "player list";
    }

}