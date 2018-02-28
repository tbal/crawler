<?php
namespace AOE\Crawler\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2018 AOE GmbH <dev@aoe.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use org\bovigo\vfs\vfsStream;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility;

/**
 * Class ExtensionSettingsService
 */
class ExtensionSettingsService
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function __construct()
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * @param $settingKey
     *
     * @return string
     */
    public function getSetting($settingKey)
    {
        $extensionSetting = $this->getAllSettings();
        if (array_key_exists($settingKey, $extensionSetting)) {
            return $extensionSetting[$settingKey]['value'];
        }

        return '';
    }

    /**
     * @param $settingKey
     * @param $settingValue
     *
     * @return void
     */
    public function setSetting($settingKey, $settingValue)
    {
        /** @var ConfigurationUtility $configurationUtility */
        $configurationUtility = $this->objectManager->get(ConfigurationUtility::class);

        // Current configuration
        $configuration = [];//$configurationUtility->getCurrentConfiguration('crawler');

        // Add new configuration value
        $newConfiguration = [$settingKey => $settingValue];

        ArrayUtility::mergeRecursiveWithOverrule($newConfiguration, $configuration);
        $configurationUtility->writeConfiguration(
            $configurationUtility->convertValuedToNestedConfiguration($newConfiguration),
            'crawler'
        );
    }

    /**
     * @return array
     */
    public function getAllSettings()
    {
        /** @var ConfigurationUtility $configurationUtility */
        $configurationUtility = $this->objectManager->get(ConfigurationUtility::class);
        return $configurationUtility->getCurrentConfiguration('crawler');
    }
}
