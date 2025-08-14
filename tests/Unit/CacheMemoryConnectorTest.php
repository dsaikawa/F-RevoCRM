<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CacheMemoryConnectorTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../../includes/runtime/cache/Connectors.php';
    }

    public function testSetGetDeleteAndFlush(): void
    {
        $m = Vtiger_Cache_Connector_Memory::getInstance();
        $m->set('K', 'V');
        $this->assertSame('V', $m->get('K'));
        $m->delete('K');
        $this->assertFalse($m->get('K'));
        $this->assertTrue($m->flush());
    }
}

