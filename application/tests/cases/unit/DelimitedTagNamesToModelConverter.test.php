<?php

use ch\aeberhardo\actions\bookmarks\impl\DelimitedTagNamesToModelConverter;

class DelimitedTagNamesToModelConverterTest extends PHPUnit_Framework_TestCase {

    /**
     * @var DelimitedTagNamesToModelConverter
     */
    private $converter;

    public function setUp() {
        $this->converter = new DelimitedTagNamesToModelConverter();
    }
    
    
    public function test_convert_empty() {
        $result = $this->converter->convert('');
        $this->assertCount(0, $result);
    }
    
    public function test_convert_one() {
        $result = $this->converter->convert('one');
        
        $this->assertCount(1, $result);
        
        $tag = $result[0];
        
        $this->assertEquals('one', $tag->name);
    }
    
    public function test_convert_two() {
        $result = $this->converter->convert('one, two');
        
        $this->assertCount(2, $result);
        
        $tag1 = $result[0];
        $this->assertEquals('one', $tag1->name);
        
        $tag2 = $result[1];
        $this->assertEquals('two', $tag2->name);
    }

}