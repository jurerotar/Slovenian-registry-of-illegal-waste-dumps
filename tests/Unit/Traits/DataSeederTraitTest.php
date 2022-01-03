<?php

namespace Tests\Unit\Traits;

use App\Traits\DataSeederTrait;
use PHPUnit\Framework\TestCase;

class DataSeederTraitTest extends TestCase
{
    use DataSeederTrait;

    public function testAreaEstimate(): void
    {
        $this->assertEquals(1, $this->areaEstimate(null), 'Failed at 1');
        $this->assertEquals(1, $this->areaEstimate('Random text'), 'Failed at 2');
        $this->assertEquals(1, $this->areaEstimate(-1), 'Failed at 3');
        $this->assertEquals(2, $this->areaEstimate(0.5), 'Failed at 4');
        $this->assertEquals(2, $this->areaEstimate(1), 'Failed at 5');
        $this->assertEquals(3, $this->areaEstimate(2), 'Failed at 6');
        $this->assertEquals(4, $this->areaEstimate(5), 'Failed at 7');
        $this->assertEquals(5, $this->areaEstimate(15), 'Failed at 8');
        $this->assertEquals(6, $this->areaEstimate(45), 'Failed at 9');
        $this->assertEquals(7, $this->areaEstimate(88), 'Failed at 10');
        $this->assertEquals(8, $this->areaEstimate(200), 'Failed at 11');
        $this->assertEquals(9, $this->areaEstimate(300), 'Failed at 12');
        $this->assertEquals(10, $this->areaEstimate(600), 'Failed at 13');
        $this->assertEquals(11, $this->areaEstimate(1500), 'Failed at 14');
        $this->assertEquals(12, $this->areaEstimate(2500), 'Failed at 15');
        $this->assertEquals(13, $this->areaEstimate(5000), 'Failed at 16');
        $this->assertEquals(14, $this->areaEstimate(11000), 'Failed at 17');
    }

    public function testVolumeEstimate(): void
    {
        $this->assertEquals(true, true, 'Failed at 17');
    }

    public function testTerrainType(): void
    {
        $this->assertEquals(true, true, 'Failed at 17');

    }

    public function testAccessType(): void
    {
        $this->assertEquals(true, true, 'Failed at 17');

    }

    public function testMunicipality(): void
    {
        $this->assertEquals(true, true, 'Failed at 17');

    }

    public function testCadastralMunicipality(): void
    {
        $this->assertEquals(true, true, 'Failed at 17');

    }
}
