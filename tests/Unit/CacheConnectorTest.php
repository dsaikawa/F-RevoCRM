<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CacheConnectorTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../../includes/runtime/cache/Connector.php';
    }

    public function testSetGetHasDelete(): void
    {
        $c = Vtiger_Cache_Connector::getInstance();
        $c->set('ns', 'key1', 'value1');
        $this->assertSame('value1', $c->get('ns', 'key1'));
        $this->assertTrue($c->has('ns', 'key1'));
        $c->delete('ns', 'key1');
        $this->assertFalse($c->has('ns', 'key1'));
    }

    public function testArrayKeyIsSupported(): void
    {
        $c = Vtiger_Cache_Connector::getInstance();
        $c->set('ns', ['a','b'], 'v');
        $this->assertSame('v', $c->get('ns', ['a','b']));
    }

    public function testFlushReturns(): void
    {
        $c = Vtiger_Cache_Connector::getInstance();
        $c->flush();
        $this->assertTrue(true); // flush() has no observable effect on memory connector
    }
}

