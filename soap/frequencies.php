<?php
namespace de\detert\sebastian\wortschatz\soap;

use de\detert\sebastian\wortschatz\word;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class Frequencies extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'Frequencies?wsdl';

        return $config;
    }

    /**
     * returns the frequency and frequency class of the input word. Frequency class is computed in relation to the most
     * frequent word in the corpus. The higher the class, the rarer the word
     *
     * @param string $word
     *
     * @return de\detert\sebastian\wortschatz\word\Frequency
     */
    public function getFrequency($word)
    {
        $result = $this->execute(array('Wort', $word));

        return (isset($result->executeReturn->result->dataVectors)
            && isset($result->executeReturn->result->dataVectors->dataRow[0])
            && isset($result->executeReturn->result->dataVectors->dataRow[1]))
            ? new word\Frequency(
                    $result->executeReturn->result->dataVectors->dataRow[0],
                    $result->executeReturn->result->dataVectors->dataRow[1]
                )
            : null;
    }
}