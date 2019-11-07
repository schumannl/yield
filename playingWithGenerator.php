<?php

declare(strict_types=1);

main();

function main() : void
{
//    playingWithSimpleYield();
//    playWithKeyValueYield();
    playWithThrowExceptionYield();
}

function playingWithSimpleYield()
{
    $generator = simpleYield();
    $generator->rewind();
    var_dump($generator->key());
    var_dump($generator->current());
    $generator->next();
    var_dump($generator->key());
    var_dump($generator->current());
    $generator->next();
    var_dump($generator->key());
    var_dump($generator->getReturn());
}

function playWithKeyValueYield()
{
    $generator = keyValueYield();

    var_dump($generator->key());
    var_dump($generator->current());
    $generator->next();
    var_dump($generator->key());
    var_dump($generator->current());
    $generator->next();
}

function playWithThrowExceptionYield()
{
    try
    {
        $generator = throwExceptionYield();
        echo  $generator->current() . PHP_EOL;
        $generator->throw(new Exception('Test'));
    } catch (Exception $exception) {
        echo 'External: ' . $exception->getMessage();
    }
echo PHP_EOL . '------------------' . PHP_EOL;
    try
    {
        $generator = throwExceptionYield();
        echo  $generator->current() . PHP_EOL;
        $generator->next();
        $generator->throw(new Exception('Test'));
    } catch (Exception $exception) {
        echo 'External: ' . $exception->getMessage();
    }
}

/**
 * @return Generator
 */
function simpleYield() : Generator
{
    yield 1;
    yield 2;

    return 3;
}

function keyValueYield() : Generator
{
    yield 'key1' => 'value1';
    yield 'key2' => 'value2';
}

function throwExceptionYield() : Generator
{
    echo "a" . PHP_EOL;;
    try {
        yield 1;
    } catch (Exception $e) {
        echo "Internal: {$e->getMessage()}\n";
    }
    echo "b" . PHP_EOL;;
}