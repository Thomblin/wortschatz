<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
abstract class Service
{
    /**
     * @var de\detert\sebastian\wortschatz\soap\Config
     */
    private $config;

    /**
     * @var \SoapClient
     */
    private $client;

    /**
     * @param array $options options of \SoapClient::__construct()
     */
    public function __construct(Config $config)
    {
        $this->config = $this->setEndpoint($config);
    }

    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected abstract function setEndpoint(Config $config);

    /**
     * @return \SoapClient
     */
    private function getClient()
    {
        if ( is_null($this->client) ) {
            $this->client = new \SoapClient($this->config->getWsdl(), $this->config->options);
        }

        return $this->client;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return $this->getClient()->__getFunctions();
    }

    /**
     * @return array
     */
    public function ping()
    {
        return $this->getClient()->__soapCall('ping', array());
    }

    /**
     * @param array $arg1 dataRow for soapCall
     *
     * @return stdClass
     */
    protected function execute($arg1, $_ = null)
    {
        $params = array();
        $params['objRequestParameters'] = array();
        $params['objRequestParameters']['corpus'] = $this->config->corpus;
        $params['objRequestParameters']['parameters'] = array();
        $params['objRequestParameters']['parameters']['dataVectors'] = array();

        $i = 0;
        foreach ( func_get_args() as $dataRow ) {
            $params['objRequestParameters']['parameters']['dataVectors'][$i] = array();
            $params['objRequestParameters']['parameters']['dataVectors'][$i]['dataRow'] = $dataRow;

            ++$i;
        }

        return $this->getClient()->__soapCall('execute', array((object) $params));
    }

    /**
     * @param array|string $dataVectors $result->executeReturn->result->dataVectors
     * @param array        $select      keys to be returned
     *
     * @return array
     */
    protected function getDataRows($dataVectors, array $select = array())
    {
        $result = array();

        if ( !is_array($dataVectors) ) {
            return $result;
        }

        foreach ( $dataVectors as $dataVector ) {
            $result[] = $this->getIntersection((array) $dataVector->dataRow, $select);
        }

        return $result;
    }

    /**
     * @param array $array  array to be split
     * @param array $select keys to be returned
     *
     * @return array|string
     */
    private function getIntersection(array $array, array $keys)
    {
        if ( ! empty($keys) ) {
            $result = array();

            foreach ( $array as $key => $value ) {
                if ( in_array($key, $keys) ) {
                    $result[$key] = $value;
                }
            }
        } else {
            $result = $array;
        }

        return 1 === count($result)
            ? current($result)
            : $result;
    }
}