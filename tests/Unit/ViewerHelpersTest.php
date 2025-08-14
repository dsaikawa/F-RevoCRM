<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ViewerHelpersTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../../includes/runtime/Viewer.php';
        require_once __DIR__ . '/../../includes/runtime/Globals.php';
    }

    public function testVresourceUrlAppendsVersionForLocalPaths(): void
    {
        $GLOBALS['vtiger_current_version'] = '7.4.1';
        $this->assertSame('foo.css?v=7.4.1', vresource_url('foo.css'));
    }

    public function testVresourceUrlUnchangedForAbsoluteUrls(): void
    {
        $GLOBALS['vtiger_current_version'] = '7.4.1';
        $this->assertSame('https://cdn.example.com/x.js', vresource_url('https://cdn.example.com/x.js'));
    }

    public function testGetTemplatePathResolvesExistingTemplate(): void
    {
        $viewer = Vtiger_Viewer::getInstance();
        $tpl = $viewer->getTemplatePath('DetailViewHeader.tpl', 'Vtiger');
        $this->assertSame('modules/Vtiger/DetailViewHeader.tpl', $tpl);
    }
}
