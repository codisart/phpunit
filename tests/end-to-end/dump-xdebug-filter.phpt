--TEST--
phpunit -c ../_files/configuration_whitelist.xml --dump-xdebug-filter 'php://stdout'
--SKIPIF--
<?php
if (!extension_loaded('xdebug')) {
    print 'skip: xdebug not loaded';
}
--FILE--
<?php
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = __DIR__ . '/../_files/configuration_whitelist.xml';
$_SERVER['argv'][3] = '--dump-xdebug-filter';
$_SERVER['argv'][4] = 'php://stdout';

require __DIR__ . '/../bootstrap.php';
PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.
<?php
if (!\function_exists('xdebug_set_filter')) {
    return;
}

xdebug_set_filter(
    XDEBUG_FILTER_CODE_COVERAGE,
    XDEBUG_PATH_WHITELIST,
    [
        %s
    ]
);
