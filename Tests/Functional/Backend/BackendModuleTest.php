<?php
namespace AOE\Crawler\Tests\Functional\Backend;

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

use AOE\Crawler\Backend\BackendModule;
use Nimut\TestingFramework\TestCase\FunctionalTestCase;

/**
 * Class BackendModuleTest
 */
class BackendModuleTest extends FunctionalTestCase
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
     * @var BackendModule
     */
    protected $backendModule;

    /**
     * Creates the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->backendModule = $this->getAccessibleMock(
            BackendModule::class,
            ['dummyMethod'],
            [],
            '',
            false
        );
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['crawler'] = 'a:19:{s:9:"sleepTime";s:4:"1000";s:16:"sleepAfterFinish";s:2:"10";s:11:"countInARun";s:3:"100";s:14:"purgeQueueDays";s:2:"14";s:12:"processLimit";s:1:"1";s:17:"processMaxRunTime";s:3:"300";s:14:"maxCompileUrls";s:5:"10000";s:12:"processDebug";s:1:"0";s:14:"processVerbose";s:1:"0";s:16:"crawlHiddenPages";s:1:"0";s:7:"phpPath";s:12:"/usr/bin/php";s:14:"enableTimeslot";s:1:"1";s:11:"logFileName";s:0:"";s:9:"follow30x";s:1:"0";s:18:"makeDirectRequests";s:1:"0";s:16:"frontendBasePath";s:1:"/";s:22:"cleanUpOldQueueEntries";s:1:"1";s:19:"cleanUpProcessedAge";s:1:"2";s:19:"cleanUpScheduledAge";s:1:"7";}';
    }

    /**
     * @test
     */
    public function loadExtensionSettings()
    {
        $this->backendModule->loadExtensionSettings();
        $this->assertSame(
            unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['crawler']),
            $this->backendModule->getExtensionSettings()
        );
    }
}