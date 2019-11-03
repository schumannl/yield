<?php

main();

/**
 * Main functionality
 */
function main()
{
    $numberOfItems = 2000000;

    displayResults(
        checkMemoryUsageOfArray($numberOfItems),
        checkMemoryUsageOfYield($numberOfItems),
        $numberOfItems
    );
}

/**
 * Checks how much memory is used if items are collected returned in an array.
 *
 * @param int $numberOfItems
 *
 * @return array
 */
function checkMemoryUsageOfArray(int $numberOfItems) : array
{
    $beginning = getMemoryUsage();

    $array = [];
    for ($i = 1; $i <= $numberOfItems; $i++) {
        $array[] = $i;
    }
    $end = getMemoryUsage();

    return [
        'beginning' => $beginning,
        'end' => $end,
    ];
}

/**
 * Checks how much memory is used if items are yielded.
 *
 * @param int $numberOfItems
 *
 * @return array
 */
function checkMemoryUsageOfYield(int $numberOfItems) : array
{
    $beginning = getMemoryUsage();
    foreach (doYield($numberOfItems) as $key => $value) {}
    $end = getMemoryUsage();

    return [
        'beginning' => $beginning,
        'end' => $end,
    ];
}

/**
 * Does yield.
 *
 * @param int $numberOfItems
 *
 * @return Generator
 */
function doYield(int $numberOfItems) : Generator
{
    for ($i = 1; $i <= $numberOfItems; $i++) {
        yield $i;
    }
}

/**
 * Returns the used memory in MB.
 */
function getMemoryUsage() : string
{
    return number_format(memory_get_usage() / 1024 / 1024, 2);
}

/**
 * Displays the memory consumption.
 *
 * @param array $arrayResults
 * @param array $yieldResults
 * @param int $numberOfItems
 */
function displayResults(array $arrayResults, array $yieldResults, int $numberOfItems) {
    $resultsText = <<<RESULTS
Number of items used for testing: %s.

Array statistics:
    beginning: %s MB
    end: %s MB

Yield statistics:
    beginning: %s MB
    end: %s MB
RESULTS;

    echo sprintf(
        $resultsText,
        $numberOfItems,
        $arrayResults['beginning'],
        $arrayResults['end'],
        $yieldResults['beginning'],
        $yieldResults['end']
    );
}