<?php

use ch\aeberhardo\html\SearchHighlight;

class SearchHighlightTest extends PHPUnit_Framework_TestCase {

    public function test_toJason_null() {
        $result = SearchHighlight::toJson(null);
        $this->assertEquals('[""]', $result);
    }

    public function test_toJson_empty() {
        $result = SearchHighlight::toJson('');
        $this->assertEquals('[""]', $result);
    }

    public function test_toJson_one_term() {
        $result = SearchHighlight::toJson('one');
        $this->assertEquals('["one"]', $result);
    }

    public function test_toJson_one_term_with_spaces() {
        $result = SearchHighlight::toJson('   one   ');
        $this->assertEquals('["one"]', $result);
    }

    public function test_toJson_two_terms() {
        $result = SearchHighlight::toJson('one two');
        $this->assertEquals('["one","two"]', $result);
    }

    public function test_toJson_two_terms_with_spaces() {
        $result = SearchHighlight::toJson('  one  two ');
        $this->assertEquals('["one","two"]', $result);
    }

    public function test_toJson_plus() {
        $result = SearchHighlight::toJson('+');
        $this->assertEquals('["+"]', $result);
    }

    public function test_toJson_ampersand() {
        $result = SearchHighlight::toJson('&');
        $this->assertEquals('["&"]', $result);
    }

    /**
     * Expected:
     *  in  -> '
     *  out -> ["'"]
     */
    public function test_toJson_single_quote() {
        $result = SearchHighlight::toJson("'");
        $this->assertEquals('["' . "'" . '"]', $result);
    }

    /**
     * Expected:
     *  in  -> "
     *  out -> ["\""]
     */
    public function test_toJson_double_quote() {
        $result = SearchHighlight::toJson('"');
        $this->assertEquals('["' . '\"' . '"]', $result);
    }

    /**
     * Expected:
     *  in  -> ""
     *  out -> ["\"\""]
     */
    public function test_toJson_two_double_quote() {
        $result = SearchHighlight::toJson('""');
        $this->assertEquals('["' . '\"' . '\"' . '"]', $result);
    }

    /**
     * Expected:
     *  in  -> \
     *  out -> ["\\"]
     */
    public function test_toJson_backslash() {
        $result = SearchHighlight::toJson('\\');
        $this->assertEquals('["' . '\\' . '\\' . '"]', $result);
    }

    /**
     * Expected:
     *  in  -> /
     *  out -> ["\/"]
     */
    public function test_toJson_slash() {
        $result = SearchHighlight::toJson('/');
        $this->assertEquals('["' . '\/' . '"]', $result);
    }

}