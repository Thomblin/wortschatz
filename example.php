<?php

use de\detert\sebastian\wortschatz\soap;

require 'autoload.php';

new Autoload();

$config = new soap\Config();
$config->corpus = 'de';

$synonyms = new soap\Synonyms($config);

try {
    $words = $synonyms->getSynonyms('Beispiel', 5);
} catch ( \SoapFault $e ) {
    print_r($e->getMessage());
    $words = array();
}

print_r($words);