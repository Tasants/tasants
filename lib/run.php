<?php
define('DATA', dirname(dirname(__FILE__)) . '/data/');
define('LIB', dirname(dirname(__FILE__)) . '/lib/');
define('TESTLIB', dirname(dirname(__FILE__)) . '/lib/');

date_default_timezone_set('Europe/Helsinki');

require_once LIB . 'parsers/EventData.php';
require_once LIB . 'parsers/EventImportService.php';
require_once LIB . 'parsers/EventImportMnet.php';
require_once LIB . 'parsers/EventImportMobilekustannus.php';
require_once LIB . 'parsers/EventImportTurkuFi.php';
