<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class RuntimeConfigsTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../../includes/runtime/Configs.php';
    }

    public function testSingletonInstance(): void
    {
        $a = Vtiger_Runtime_Configs::getInstance();
        $b = Vtiger_Runtime_Configs::getInstance();
        $this->assertSame($a, $b);
    }

    public function testGetConnectorReturnsDefaultWhenUnset(): void
    {
        unset($GLOBALS['runtime_connectors']);
        $configs = Vtiger_Runtime_Configs::getInstance();
        $this->assertSame('Vtiger_Cache_Connector', $configs->getConnector('cache', 'Vtiger_Cache_Connector'));
    }

    public function testGetConnectorFromGlobal(): void
    {
        $GLOBALS['runtime_connectors'] = ['cache' => 'Vtiger_Cache_Connector'];
        $configs = Vtiger_Runtime_Configs::getInstance();
        $this->assertSame('Vtiger_Cache_Connector', $configs->getConnector('cache', 'Default_Class'));
    }

    public function testGetValidationRegexDefault(): void
    {
        unset($GLOBALS['validation_regex']);
        $configs = Vtiger_Runtime_Configs::getInstance();
        $this->assertSame('^.*$', $configs->getValidationRegex('anything', '^.*$'));
    }
}

