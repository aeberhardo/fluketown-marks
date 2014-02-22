<?php

use \Tag;
use ch\aeberhardo\actions\bookmarks\impl\TagLinearizer;


class TagLinearizerTest extends PHPUnit_Framework_TestCase {

    private $tagLinearizer;

    public function setUp() {
        $this->tagLinearizer = new TagLinearizer();
    }

    public function test_toArray_empty() {
        $result = $this->tagLinearizer->toArray('');
        $this->assertCount(0, $result);
    }
    
    public function test_toArray_null() {
        $result = $this->tagLinearizer->toArray(null);
        $this->assertCount(0, $result);
    }

    public function test_toArray_space() {
        $result = $this->tagLinearizer->toArray(' ');
        $this->assertCount(0, $result);
    }

    public function test_toArray_multiple_spaces() {
        $result = $this->tagLinearizer->toArray('   ');
        $this->assertCount(0, $result);
    }

    public function test_toArray_comma() {
        $result = $this->tagLinearizer->toArray(',');
        $this->assertCount(0, $result);
    }

    public function test_toArray_one() {
        $result = $this->tagLinearizer->toArray('one');

        $this->assertEquals(array('one'), $result);
    }

    public function test_toArray_two() {
        $result = $this->tagLinearizer->toArray('one, two');

        $this->assertEquals(array('one', 'two'), $result);
    }

    public function test_toArray_three() {
        $result = $this->tagLinearizer->toArray('one, two, three');

        $this->assertEquals(array('one', 'two', 'three'), $result);
    }

    public function test_toArray_three_superfluous_spaces() {
        $result = $this->tagLinearizer->toArray('   one   ,    two  ,   three   ');

        $this->assertEquals(array('one', 'two', 'three'), $result);
    }

    public function test_toArray_three_superfluous_commas() {
        $result = $this->tagLinearizer->toArray(', ,,one, ,, two,, three,,, ,,,');

        $this->assertEquals(array_values(array('one', 'two', 'three')), array_values($result));
    }

    public function test_toArray_three_superfluous_commas_and_spaces() {
        $result = $this->tagLinearizer->toArray(',   ,  ,    one   ,   , , two,, three,,   , ,,,');

        $this->assertEquals(array_values(array('one', 'two', 'three')), array_values($result));
    }
    
    public function test_toArray_multiword() {
        $result = $this->tagLinearizer->toArray('one1 one2');

        $this->assertEquals(array('one1 one2'), $result);
    }
    
    public function test_toArray_multiwords_and_singlewords() {
        $result = $this->tagLinearizer->toArray('one, two1 two2 two3, three1 three2, four');

        $this->assertEquals(array('one', 'two1 two2 two3', 'three1 three2', 'four'), $result);
    }
    
    
    public function test_toArray_one_dupe() {
        $result = $this->tagLinearizer->toArray('one, two, one, three');

        $this->assertEquals(array_values(array('one', 'two', 'three')), array_values($result));
    }
    
    public function test_toArray_multiple_dupes() {
        $result = $this->tagLinearizer->toArray('one, two, one, one, three, four, three, one, two');

        $this->assertEquals(array_values(array('one', 'two', 'three', 'four')), array_values($result));
    }
    
    
    
    public function test_toString_empty() {
        $tags = array();
        $result = $this->tagLinearizer->toString($tags);
        $this->assertEquals('', $result);
    }
    
    public function test_toString_null() {
        $result = $this->tagLinearizer->toString(null);
        $this->assertEquals('', $result);
    }
    
    public function test_toString_one() {
        $tags = array();
        
        $tag = new Tag();
        $tag->name = 'one';
        $tags[] = $tag;
        
        $result = $this->tagLinearizer->toString($tags);
        $this->assertEquals('one', $result);
    }
    
    public function test_toString_two() {
        $tags = array();
        
        $tag = new Tag();
        $tag->name = 'one';
        $tags[] = $tag;
        
        $tag = new Tag();
        $tag->name = 'two';
        $tags[] = $tag;
        
        $result = $this->tagLinearizer->toString($tags);
        $this->assertEquals('one, two', $result);
    }
}