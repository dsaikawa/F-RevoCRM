<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CacheTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../../includes/runtime/Cache.php';
    }

    public function testSetGetDelete(): void
    {
        Vtiger_Cache::set('ns1', 'k1', 'v1');
        $this->assertSame('v1', Vtiger_Cache::get('ns1', 'k1'));
        Vtiger_Cache::delete('ns1', 'k1');
        $this->assertFalse(Vtiger_Cache::get('ns1', 'k1'));
    }

    public function testPicklistValuesHelpers(): void
    {
        $cache = Vtiger_Cache::getInstance();
        $this->assertFalse($cache->getPicklistValues('Status'));
        $cache->setPicklistValues('Status', ['Open','Closed']);
        $this->assertSame(['Open','Closed'], $cache->getPicklistValues('Status'));
    }

    public function testAssignedPicklistValuesRoleBased(): void
    {
        $cache = Vtiger_Cache::getInstance();
        $this->assertFalse($cache->getAssignedPicklistValues('Status', 'H1'));
        $cache->setAssignedPicklistValues('Status', 'H1', ['New','In Progress']);
        $this->assertTrue($cache->hasAssignedPicklistValues('Status', 'H1'));
        $this->assertSame(['New','In Progress'], $cache->getAssignedPicklistValues('Status', 'H1'));
    }

    public function testOwnerNameHelpers(): void
    {
        $cache = Vtiger_Cache::getInstance();
        $this->assertFalse($cache->getOwnerName(99));
        $cache->setOwnerName(99, 'Taro');
        $this->assertTrue($cache->hasOwnerName(99));
        $this->assertSame('Taro', $cache->getOwnerName(99));
    }
}

