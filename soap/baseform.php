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

        if ( !isset($result->executeReturn->result->dataVectors) ) {
            return null;
        }

        $lemmatized = is_array($result->executeReturn->result->dataVectors)
            ?  $result->executeReturn->result->dataVectors[0]->dataRow[0]
            : $result->executeReturn->result->dataVectors->dataRow[0];

        $posTag = is_array($result->executeReturn->result->dataVectors)
            ?  $result->executeReturn->result->dataVectors[0]->dataRow[1]
            : $result->executeReturn->result->dataVectors->dataRow[1];

        return new word\Baseform( $lemmatized, $posTag);
    }

    /**
     * returns the lemmatized (base) forms of the input word
     *
     * @param string $word
     *
     * @return array of de\detert\sebastian\wortschatz\word\Baseform
     */
    public function getBaseforms($word)
    {
        $return = array();
        $result = $this->execute(array('Wort', $word));

        if ( !isset($result->executeReturn->result->dataVectors) ) {

        } else if ( is_array($result->executeReturn->result->dataVectors) ) {

            foreach ( $result->executeReturn->result->dataVectors as $dataVector ) {
                $return[] = new word\Baseform(
                    $dataVector->dataRow[0],
                    $dataVector->dataRow[1]
                );
            }
        } else {
            $return[] = new word\Baseform(
                $result->executeReturn->result->dataVectors->dataRow[0],
                $result->executeReturn->result->dataVectors->dataRow[1]
            );
        }

        return $return;
    }
}