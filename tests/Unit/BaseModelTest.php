<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class BaseModelTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../../includes/runtime/BaseModel.php';
    }

    public function testSetGetAndHas(): void
    {
        $m = new Vtiger_Base_Model(['a' => 1]);
        $this->assertTrue($m->has('a'));
        $this->assertSame(1, $m->get('a'));
        $m->set('b', 'x');
        $this->assertSame('x', $m->get('b'));
    }

    public function testIsEmptyAndDataMutators(): void
    {
        $m = new Vtiger_Base_Model();
        $this->assertTrue($m->isEmpty('z'));
        $m->setData(['k' => 'v']);
        $this->assertSame(['k' => 'v'], $m->getData());
    }
}

