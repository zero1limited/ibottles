<?php
header('Cache-Control: no-store'); // tell varnish not to cache this
header('Content-Type: text/plain');
http_response_code(200);
echo 'date: '.date('c').PHP_EOL;
echo 'Opcache reset: '.json_encode(opcache_reset()).PHP_EOL;
