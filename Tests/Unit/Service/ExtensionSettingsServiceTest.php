<?php
namespace AOE\Crawler\Tests\Unit\Service;

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
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Class ExtensionSettingsServiceTest
 */
class ExtensionSettingsServiceTest extends UnitTestCase
{

    /**
     * @var ExtensionSettingsService
     */
    protected $subject;

    /**
     * Set Up
     */
    public function setUp()
    {
        $settings = [
            'sleepTime' => [
                'value' => 1001,
            ],
            'phpPath' => [
                'value' => '/usr/bin/php']
        ];

        $this->subject = $this->getAccessibleMock(ExtensionSettingsService::class, ['getAllSettings'], [], '', false);
        $this->subject->expects($this->any())->method('getAllSettings')->willReturn($settings);
    }

    /**
     * @test
     */
    public function getSettingExpectsEmptySettingsAsKeyIsUnknown()
    {
        $this->assertEquals(
            '',
            $this->subject->getSetting('no_valid_key')
        );
    }

    /**
     * @test
     */
    public function getSettingExpectsReturnValue()
    {
        $this->assertEquals(
            1001,
            $this->subject->getSetting('sleepTime')
        );

        $this->assertEquals(
            '/usr/bin/php',
            $this->subject->getSetting('phpPath')
        );
    }
}
