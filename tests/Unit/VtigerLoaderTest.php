<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class VtigerLoaderTest extends TestCase
{
    public function testResolveNameToPathWithDottedNotation(): void
    {
        $path = Vtiger_Loader::resolveNameToPath('modules.Vtiger.views.Index');
        $this->assertStringEndsWith('includes' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Vtiger' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'Index.php', $path);
    }

    public function testResolveNameToPathWithTilde(): void
    {
        $path = Vtiger_Loader::resolveNameToPath('~modules/Vtiger/views/Index');
        $this->assertStringEndsWith('includes' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Vtiger' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'Index', $path);
    }

    public function testResolveNameToPathRejectsUnknownExtension(): void
    {
        $path = Vtiger_Loader::resolveNameToPath('modules.Vtiger.views.Index', 'txt');
        $this->assertSame('', $path);
    }

    public function testIncludePathAddsResolvedDirectory(): void
    {
        Vtiger_Loader::includePath('modules.Vtiger.views.Index');
        $resolvedDir = realpath(Vtiger_Loader::resolveNameToPath('modules.Vtiger.views.Index')); // file path
        $dir = dirname((string)$resolvedDir);
        $this->assertNotFalse(strpos(get_include_path(), $dir));
    }

    public function testGetComponentClassNameSelectsExistingView(): void
    {
        $class = Vtiger_Loader::getComponentClassName('View', 'Index', 'Vtiger');
        $this->assertSame('Vtiger_Index_View', $class);
    }

}
