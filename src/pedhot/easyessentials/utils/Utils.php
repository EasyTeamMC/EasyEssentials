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

namespace pedhot\easyessentials\utils;

use JackMD\ConfigUpdater\ConfigUpdater;
use pedhot\easyessentials\EasyEssentials;
use pedhot\easyessentials\lang\BaseLang;

class Utils {

    /** @var BaseLang */
    private static $baseLang;

    public static function configInit(): void {
        if (!is_dir(EasyEssentials::getInstance()->getDataFolder())) {
            @mkdir(EasyEssentials::getInstance()->getDataFolder());
        }
        if (!is_dir(EasyEssentials::getInstance()->getDataFolder() . "lang")) {
            @mkdir(EasyEssentials::getInstance()->getDataFolder() . "lang");
        }
        EasyEssentials::getInstance()->saveDefaultConfig();
        foreach (EasyEssentials::getInstance()->getResources() as $resource) {
            EasyEssentials::getInstance()->saveResource($resource->getFilename());
        }
        foreach (["eng.ini"] as $str) {
            EasyEssentials::getInstance()->saveResource("lang/" . $str);
        }
    }

    public static function checkConfigs(): void {
        ConfigUpdater::checkUpdate(EasyEssentials::getInstance(), EasyEssentials::getInstance()->getConfig(), "config-version", Version::LATEST_CONFIG_VERSION);
    }

    public static function registerBaseLang(): void {
        self::$baseLang = new BaseLang(EasyEssentials::getInstance()->getProperty("language", BaseLang::FALLBACK_LANGUAGE));
    }

    /**
     * @return BaseLang
     */
    public static function getBaseLang(): BaseLang {
        return self::$baseLang;
    }

}