<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UtilHelperTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../../modules/Vtiger/helpers/Util.php';
    }

    public function testReplaceSpaceWithUnderScores(): void
    {
        $this->assertSame('Hello_World', Vtiger_Util_Helper::replaceSpaceWithUnderScores('Hello World'));
    }

    public function testTransformUploadedFiles(): void
    {
        $files = [
            'att' => [
                'name' => [0 => 'a.txt', 1 => 'b.txt'],
                'type' => [0 => 'text/plain', 1 => 'text/plain'],
                'tmp_name' => [0 => '/tmp/a', 1 => '/tmp/b'],
                'error' => [0 => 0, 1 => 0],
                'size' => [0 => 1, 1 => 2],
            ],
        ];
        $out = Vtiger_Util_Helper::transformUploadedFiles($files);
        $this->assertSame('a.txt', $out['att'][0]['name']);
        $this->assertSame('/tmp/b', $out['att'][1]['tmp_name']);
    }
}
