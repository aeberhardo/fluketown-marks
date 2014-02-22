<?php

namespace ch\aeberhardo\html;

class SearchHighlight {

    /**
     * @param string $searchTerms Suchbegriffe, welche durch Whitespaces getrennt sind.
     * @return string Json-String, bei welchem jeder Suchbegriff ein Element eines Arrays ist.
     */
    public static function toJson($searchTerms) {
        return json_encode(preg_split('/\s+/',trim($searchTerms)));
    }

}

