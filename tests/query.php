<?php

namespace TESTS;

require __DIR__ . '/../vendor/autoload.php';

use function Carno\Coroutine\go;
use Carno\DNS\DNS;
use Carno\DNS\Result;

go(function () {
    /**
     * @var Result $result
     */

    $result = yield DNS::resolve($domain = 'www.gstatic.com');

    foreach ($result->iterator() as $ip) {
        echo $domain, ' -> ', $ip, PHP_EOL;
    }
});
