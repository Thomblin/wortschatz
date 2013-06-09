<?php
namespace de\detert\sebastian\wortschatz\word;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 07.06.13
 * @time 01:10
 * @license property of Sebastian Detert
 */
class Baseform
{
    /**
     * @var string
     */
    public $lemmatized;
    /**
     * @var string
     */
    public $posTag;

    /**
     * @param string $lemmatized
     * @param string $posTag
     */
    public function __construct($lemmatized, $posTag)
    {
        $this->lemmatized = $lemmatized;
        $this->posTag     = $posTag;
    }
}