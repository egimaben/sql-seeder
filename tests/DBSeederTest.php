<?php

namespace egimaben\sql_seeder;

class ExampleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that true does in fact equal true
     */
    public function testTrueIsTrue()
    {
        
        $this->assertEquals("'name'",DBSeeder::quoteString('name'));
    }
}
