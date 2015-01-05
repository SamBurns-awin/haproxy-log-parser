<?php

require('HaproxyLogParser.php');
require('FieldDocumentation.php');

$lines = array();
$lines[] = 'haproxy[14389]: 10.0.1.2:33317 [06/Feb/2009:12:14:14.655] http-in static/srv1 10/0/30/69/109 200 2750 - - ---- 1/1/1/1/0 0/0 {1wt.eu} {} "GET /index.html HTTP/1.1"';
$lines[] = 'haproxy[14387]: 10.0.1.2:33313 [06/Feb/2009:12:12:51.443] fnt bck/srv1 0/0/5007 212 -- 0/0/0/0/3 0/0';

$doc = new FieldDocumentation();
$doc->load();

$parser = new HaproxyLogParser();
foreach ($lines as $line) {
    $logEntry = $parser->parse($line);
    foreach ($logEntry as $field => $value) {
        echo $field . PHP_EOL;
        echo $value . PHP_EOL;
        if (!empty($doc->{$logEntry::$docLabel}->$field)) {
            echo $doc->{$logEntry::$docLabel}->$field . PHP_EOL;
        }
        echo PHP_EOL;
    }
}

