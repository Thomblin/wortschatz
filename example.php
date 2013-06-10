<?php

use de\detert\sebastian\wortschatz\Autoload;
use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Synonyms;

require 'autoload.php';

new Autoload();

$synonyms = new Synonyms(new Config());

try {
    $words = $synonyms->getSynonyms('Beispiel', 5);
} catch ( \SoapFault $e ) {
    print_r($e->getMessage());
    $words = array();
}

print_r($words);