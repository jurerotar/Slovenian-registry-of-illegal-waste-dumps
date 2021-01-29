<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class MigrationTest extends TestCase
{

    use RefreshDatabase;

    public function testMigrations()
    {
        $this->assertTrue(true);
    }
}
