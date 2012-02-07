<?php
require_once dirname(dirname(__DIR__)) . "/lib/run.php";
abstract class TasantsTestCase extends PHPUnit_Framework_TestCase {
    public function __construct() {
        $this->DoSetUp();
    }
    public function DoSetUp() {
    }
}
