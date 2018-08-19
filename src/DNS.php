<?php
/**
 * DNS Client
 * User: moyo
 * Date: 12/09/2017
 * Time: 3:25 PM
 */

namespace Carno\DNS;

use Carno\DNS\Chips\IPHelper;
use Carno\DNS\Powered\Swoole;
use Carno\Promise\Promised;

class DNS
{
    use IPHelper;

    /**
     * @var Swoole
     */
    private static $impl = null;

    /**
     * @return Swoole
     */
    private static function default() : Swoole
    {
        return self::$impl ?? self::$impl = new Swoole;
    }

    /**
     * @param string $domain
     * @param int $timeout
     * @return Promised|Result
     */
    public static function resolve(string $domain, int $timeout = 1000) : Promised
    {
        return
            self::validIP($domain)
                ? self::resolvedResult([$domain])
                : self::default()->resolve($domain, $timeout)
        ;
    }
}
