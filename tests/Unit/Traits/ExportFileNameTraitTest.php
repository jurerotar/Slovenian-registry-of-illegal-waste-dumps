<?php

namespace Tests\Unit\Traits;

use App\Traits\ExportFileNameTrait;
use PHPUnit\Framework\TestCase;

class ExportFileNameTraitTest extends TestCase
{
    use ExportFileNameTrait;

    public function testName()
    {
        $this->assertSame('a_b_c.extension', $this->name('a-b c', 'extension'));
        $this->assertSame('a_b_c.json', $this->name('a-b c'));
    }

    public function testDateName()
    {
        $this->assertSame(now()->format('Y_m_d') . '_name.extension', $this->dateName('name', 'extension'));
        $this->assertSame(now()->format('Y_m_d') . '_name.json', $this->dateName('name'));
    }
}
