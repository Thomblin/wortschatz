<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 08.06.13
 * @time 13:03
 * @license property of Sebastian Detert
 */
class Config
{
    /**
     * @var string
     * @see \SoapClient wsdl
     */
    public $wsdl = 'http://wortschatz.uni-leipzig.de/axis/services/';

    /**
     * @var string
     * @see \SoapClient wsdl
     */
    public $endpoint;

    /**
     * @var string
     */
    public $corpus = 'de';

    /**
     * @var array
     * @see \SoapClient options
     */
    public $options = array(
        'login' => 'anonymous',
        'password' => 'anonymous',
    );

    public function getWsdl()
    {
        return $this->wsdl . $this->endpoint;
    }
}