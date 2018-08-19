<?php
/**
 * IP Helper
 * User: moyo
 * Date: 12/09/2017
 * Time: 4:11 PM
 */

namespace Carno\DNS\Chips;

use Carno\DNS\Result;
use Carno\Promise\Promise;
use Carno\Promise\Promised;

trait IPHelper
{
    /**
     * @param string $ip
     * @return bool
     */
    protected static function validIP(string $ip) : bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP) ? true : false;
    }

    /**
     * @param array $ips
     * @return Promised|Result
     */
    protected static function resolvedResult(array $ips) : Promised
    {
        return new Promise(static function (Promised $p) use ($ips) {
            $p->resolve(new Result($ips));
        });
    }
}
