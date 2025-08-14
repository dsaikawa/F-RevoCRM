<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class GlobalsTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../../includes/runtime/Globals.php';
    }

    public function testVglobalSetAndGet(): void
    {
        $this->assertFalse(vglobal('foo'));
        vglobal('foo', 'bar');
        $this->assertSame('bar', vglobal('foo'));
    }
}

