<?php

namespace ch\aeberhardo\url;

use \Laravel\URL;

class URLHelper {

    public static function to_action_with_parameters_and_query_string($action, $parameters = array(), $query_data = null) {

        $url = URL::to_action($action, $parameters);

        if ($query_data) {
            $queryString = http_build_query($query_data);
            $url = $url . '?' . $queryString;
        }

        return $url;
    }

    public static function to_action_with_query_string($action, $query_data = null) {
        return static::to_action_with_parameters_and_query_string($action, array(), $query_data);
    }

}

