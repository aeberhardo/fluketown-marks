<?php

namespace testlib;

use \PHPUnit_Framework_TestCase;

use \testlib\util\DBUtil;
use \testlib\util\EnvUtil;
use \testlib\util\SessionUtil;
use \testlib\util\RequestUtil;

abstract class IntegrationTest extends PHPUnit_Framework_TestCase {

    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);

        EnvUtil::isTestEnvOrDie();
    }

    protected function setUp() {
        
        DBUtil::deleteAllTables();
        
        RequestUtil::resetRequest();
        
        SessionUtil::start();
        SessionUtil::logout();
        SessionUtil::flush();
    }

    protected function tearDown() {
        // Nothing
    }

}
