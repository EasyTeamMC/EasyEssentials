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

namespace pedhot\easyessentials;

use pedhot\easyessentials\commands\BaseCommand;
use pedhot\easyessentials\lang\BaseLang;
use pedhot\easyessentials\singleton\SingletonTrait;
use pedhot\easyessentials\utils\Utils;
use pocketmine\plugin\PluginBase;

class EasyEssentials extends PluginBase {
    use SingletonTrait;

    public function onLoad() {
        $this->init();
    }

    public function onEnable() {
        Utils::configInit();
        Utils::checkConfigs();
        Utils::registerBaseLang();
        BaseCommand::registerDefaultCommands();
    }

    /**
     * @param string $variable
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getProperty(string $variable, $defaultValue = null) {
        return $this->getConfig()->getNested($variable, $defaultValue);
    }

    public function getLanguage(): BaseLang {
        return Utils::getBaseLang();
    }

}