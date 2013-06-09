<?php
namespace de\detert\sebastian\wortschatz\word;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 07.06.13
 * @time 01:10
 * @license property of Sebastian Detert
 */
class Frequency
{
    /**
     * @var int
     */
    public $count;
    /**
     * @var int
     */
    public $frequencyClass;

    /**
     * @param int $count
     * @param int $frequencyClass
     */
    public function __construct($count, $frequencyClass)
    {
        $this->count          = $count;
        $this->frequencyClass = $frequencyClass;
    }
}