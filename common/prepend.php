<?php

define("APPPATH", realpath(dirname(__FILE__) . '/..') . DIRECTORY_SEPARATOR);

// Include our files
include_once (APPPATH . 'common/config.php');
include_once (APPPATH . 'common/common.php');

// Load and connect database
include_once (APPPATH . 'lib/Db.php');
Db::setConnectionInfo($config['dbFile'], null, null, 'sqlite');

