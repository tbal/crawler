<?php
namespace AOE\Crawler\Tests\Functional\Service;

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

use AOE\Crawler\Service\ExtensionSettingsService;
use Nimut\TestingFramework\TestCase\FunctionalTestCase;

/**
 * Class ExtensionSettingsServiceTest
 */
class ExtensionSettingsServiceTest extends FunctionalTestCase
{
    /**
     * @var array
     */
    protected $coreExtensionsToLoad = ['cms', 'core', 'frontend', 'version', 'lang', 'extensionmanager', 'fluid'];

    /**
     * @var array
     */
    protected $testExtensionsToLoad = ['typo3conf/ext/crawler'];

    /**
     * @var ExtensionSettingsService
     */
    protected $subject;

    /*
     * Setup
     */
    public function setUp()
    {
        parent::setUp();
        $this->subject = $this->getAccessibleMock(ExtensionSettingsService::class, ['dummy']);
    }

    /**
     * @test
     */
    public function setSettingExpectSettingToBeSet()
    {
        $this->subject->setSetting('crawler-test-setting', 'crawler-test-setting-value');
        $this->assertSame(
            'crawler-test-setting-value',
            $this->subject->getSetting('crawler-test-setting')
        );
    }

    /**
     * @test
     */
    public function setSettingOverridesExistingSetting()
    {
        $sleepTime = (int) $this->subject->getSetting('sleepTime');
        $updatedSleepTime = $sleepTime + 1001;

        $this->subject->setSetting('sleepTime', $updatedSleepTime);

        $this->assertSame(
            $updatedSleepTime,
            (int) $this->subject->getSetting('sleepTime')
        );
    }

}