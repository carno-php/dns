<?php
/**
 * DNS by swoole
 * User: moyo
 * Date: 12/09/2017
 * Time: 3:26 PM
 */

namespace Carno\DNS\Powered;

use function Carno\Coroutine\await;
use Carno\DNS\Chips\IPHelper;
use Carno\DNS\Exception\ResolveFailedException;
use Carno\DNS\Exception\ResolveTimeoutException;
use Carno\DNS\Result;
use Carno\Promise\Promised;

class Swoole
{
    use IPHelper;

    /**
     * Promised actions:
     *  SUCCESS -> resolve(Carno\DNS\Result)
     *  FAILED  -> throw(Exception)
     * @param string $domain
     * @param int $timeout
     * @return Promised|Result
     */
    public function resolve(string $domain, int $timeout) : Promised
    {
        $query = static function ($fn) use ($domain) {
            if (false === swoole_async_dns_lookup($domain, $fn)) {
                throw new ResolveFailedException($domain);
            }
        };

        $processor = function ($host, $ip) {
            if (self::validIP($ip)) {
                return new Result([$ip]);
            } else {
                throw new ResolveFailedException(sprintf('%s->%s', $host, $ip));
            }
        };

        return await($query, $processor, $timeout, ResolveTimeoutException::class, $domain);
    }
}
