<?php
/**
 * DNS Result
 * User: moyo
 * Date: 12/09/2017
 * Time: 3:26 PM
 */

namespace Carno\DNS;

use ArrayIterator;

class Result
{
    /**
     * @var array
     */
    private $ips = [];

    /**
     * Result constructor.
     * @param array $ips
     */
    public function __construct(array $ips)
    {
        $this->ips = $ips;
    }

    /**
     * @return string
     */
    public function random() : string
    {
        return $this->ips[array_rand($this->ips)];
    }

    /**
     * @return ArrayIterator
     */
    public function iterator() : ArrayIterator
    {
        return new ArrayIterator($this->ips);
    }
}
