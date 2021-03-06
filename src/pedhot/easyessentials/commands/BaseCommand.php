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

use CortexPE\Commando\BaseCommand as CortexPeBaseCommand;
use pedhot\easyessentials\commands\defaults\FlyCommand;
use pedhot\easyessentials\EasyEssentials;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

abstract class BaseCommand extends CortexPeBaseCommand {

    public function __construct(Plugin $plugin, string $name, string $description = "", array $aliases = []) {
        parent::__construct($plugin, $name, $description, $aliases);
    }

    public function getPerms(string $name): string {
        return "essentials.command." . str_replace("/", "", strtolower($name));
    }

    public static function registerDefaultCommands(): void {
        Server::getInstance()->getCommandMap()->registerAll(EasyEssentials::getInstance()->getName(), [
            new FlyCommand(EasyEssentials::getInstance(), "fly", "Fly command")
        ]);
    }

}