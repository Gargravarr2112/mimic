<?php
require("inc/config-call.inc.php");
require("inc/functions.inc.php");
require("inc/main-nagios.inc.php"); // Nagios library
require("inc/db-open.inc.php"); // MySQL Data sources
header('Content-Type: application/json');

function bool2str($value) {
    // PHP is pretty bad at representing booleans in a human readable way so we'll do it ourselves
    if ($value === true) {
        $value = "true";
    } elseif ($value === false) {
        $value = "false";
    }
    return($value);
}

function nagios($node_name) {
    $short = explode(".", $node_name);
    $short = $short[0];
    $nodeStatus = '';
    $ntup = nagios_state($short, $node_name, $nodeStatus);
    if (!empty($ntup[1])) {
        $nodeStatus = $ntup[0];
        $test['nagios'] = $ntup[1];
        return ' '.$nodeStatus; // Must have whitespace prepended
    }
    unset($ntup);
}
