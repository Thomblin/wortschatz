<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class Overview extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->corpus = 'webservice';
        $config->endpoint = 'ServiceOverview?wsdl';

        return $config;
    }

    /**
     * This service gives an automatically generated overview of all currently available other services,
     * along with links to their download locations and a webstart link.
     *
     * @param string $word
     *
     * @return array
     */
    public function getOverview($name)
    {
        $result = $this->execute(array('Name', $name));

        return isset($result->executeReturn->result->dataVectors)
            ? $this->getDataRows($result->executeReturn->result->dataVectors)
            : array();
    }
}