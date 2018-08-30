<?php

namespace egimaben\sql_seeder;

class DBSeederTest extends \PHPUnit\Framework\TestCase
{
    private $db ;
    protected function setUp(){
        $this->db = new DBSeeder();
    }
    public function testMethods()
    {
        
        $this->assertEquals("'name'",DBSeeder::quoteString('name'));
        
    }
    public function testNumberColumnTrue(){
        //when number column but in lower case
        $this->assertTrue(DBSeeder::isNumberColumn('tinyint(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('smallint(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('mediumint(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('int(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('bigint(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('float(3,2)'));
        $this->assertTrue(DBSeeder::isNumberColumn('double(3,2)'));
        $this->assertTrue(DBSeeder::isNumberColumn('decimal(3,2)'));
        $this->assertTrue(DBSeeder::isNumberColumn('year(3)'));
        //when number column but in upper case
        $this->assertTrue(DBSeeder::isNumberColumn('TINYINT(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('SMALLINT(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('MEDIUMINT(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('INT(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('BIGINT(3)'));
        $this->assertTrue(DBSeeder::isNumberColumn('FLOAT(3,2)'));
        $this->assertTrue(DBSeeder::isNumberColumn('DOUBLE(3,2)'));
        $this->assertTrue(DBSeeder::isNumberColumn('DECIMAL(3,2)'));
        $this->assertTrue(DBSeeder::isNumberColumn('YEAR(3)'));
        
        
    }
    public function testNumberColumnFalse(){
       //when not number column but lower case
        $this->assertFalse(DBSeeder::isNumberColumn('date()'));
        $this->assertFalse(DBSeeder::isNumberColumn('datetime()'));
        $this->assertFalse(DBSeeder::isNumberColumn('timestamp()'));
        $this->assertFalse(DBSeeder::isNumberColumn('time()'));
        $this->assertFalse(DBSeeder::isNumberColumn('char(2)'));
        $this->assertFalse(DBSeeder::isNumberColumn('varchar(11)'));
        $this->assertFalse(DBSeeder::isNumberColumn('tinytext'));
        $this->assertFalse(DBSeeder::isNumberColumn('text'));
        $this->assertFalse(DBSeeder::isNumberColumn('blob'));
        $this->assertFalse(DBSeeder::isNumberColumn('mediumtext'));
        $this->assertFalse(DBSeeder::isNumberColumn('mediumblob'));
        $this->assertFalse(DBSeeder::isNumberColumn('longtext'));
        $this->assertFalse(DBSeeder::isNumberColumn('longblob'));
        $this->assertFalse(DBSeeder::isNumberColumn('enum'));
        $this->assertFalse(DBSeeder::isNumberColumn('set'));

        $this->assertFalse(DBSeeder::isNumberColumn('DATE()'));
        $this->assertFalse(DBSeeder::isNumberColumn('DATETIME()'));
        $this->assertFalse(DBSeeder::isNumberColumn('TIMESTAMP()'));
        $this->assertFalse(DBSeeder::isNumberColumn('TIME()'));
        $this->assertFalse(DBSeeder::isNumberColumn('CHAR(2)'));
        $this->assertFalse(DBSeeder::isNumberColumn('VARCHAR(11)'));
        $this->assertFalse(DBSeeder::isNumberColumn('TINYTEXT'));
        $this->assertFalse(DBSeeder::isNumberColumn('TEXT'));
        $this->assertFalse(DBSeeder::isNumberColumn('BLOB'));
        $this->assertFalse(DBSeeder::isNumberColumn('MEDIUMTEXT'));
        $this->assertFalse(DBSeeder::isNumberColumn('MEDIUMBLOB'));
        $this->assertFalse(DBSeeder::isNumberColumn('LONGTEXT'));
        $this->assertFalse(DBSeeder::isNumberColumn('LONGBLOB'));
        $this->assertFalse(DBSeeder::isNumberColumn('ENUM'));
        $this->assertFalse(DBSeeder::isNumberColumn('SET'));
    }
    // public function testValueGenerator(){

    // }
    public function testColumnLengthExtractor(){
        $this->assertEquals(DBSeeder::extractColumnLength('tinyint(3)'),3);
        $this->assertEquals(DBSeeder::extractColumnLength('smallint(6)'),6);
        $this->assertEquals(DBSeeder::extractColumnLength('mediumint(8)'),8);
        $this->assertEquals(DBSeeder::extractColumnLength('int(9)'),9);
        $this->assertEquals(DBSeeder::extractColumnLength('bigint(11)'),11);
        $this->assertEquals(DBSeeder::extractColumnLength('float(6,2)'),6);
        $this->assertEquals(DBSeeder::extractColumnLength('double(5,3)'),5);
        $this->assertEquals(DBSeeder::extractColumnLength('smallint(6)'),6);
        
    }
}
