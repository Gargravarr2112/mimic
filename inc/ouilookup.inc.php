<?php
$path = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
function ouilookup($mac)
{
    // 2010-05-18 - ax0n@h-i-r.net
    //
    // OUI Lookup function. Cleans up MAC address, gets the OUI (first 3 octets)
    // then looks them up in the gigantic array below. Returns a string containing
    // the vendor information. The array is based on nmap-mac-prefixes.

    require("config/oui-list.php");

    $oui=strtoupper(substr(preg_replace('`[^a-z0-9]`i','',$mac),0,6));
	if (array_key_exists($oui, $ouilist)) {
      return($ouilist[$oui]);
	}
	else {
	  return("Unknown OUI Prefix");
	}
}
