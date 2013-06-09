<?php
namespace de\detert\sebastian\wortschatz\soap;

use de\detert\sebastian\wortschatz\word;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class Baseform extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'Baseform?wsdl';

        return $config;
    }

    /**
     * returns the lemmatized (base) form of the input word
     *
     * @param string $word
     *
     * @return de\detert\sebastian\wortschatz\word\Baseform
     */
    public function getBaseform($word)
    {
        $result = $this->execute(array('Wort', $word));

        return isset($result->executeReturn->result->dataVectors)
            ? new word\Baseform(
                    $result->executeReturn->result->dataVectors->dataRow[0],
                    $result->executeReturn->result->dataVectors->dataRow[1]
                )
            : null;
    }
}