<?php

use Illuminate\Support\Arr;

Arr::macro('radixSort', function ($elements) {
        // Array for 10 queues.
    $queues = array(
        array(), array(), array(), array(), array(), array(), array(), array(),
        array(), array(),
    );
        // Queues are allocated dynamically. In first iteration longest digits
        // element also determined.
    $longest = 0;
    foreach ($elements as $el) {
        if ($el > $longest) {
            $longest = $el;
        }
        array_push($queues[$el % 10], $el);
    }
        // Queues are dequeued back into original elements.
    $i = 0;
    foreach ($queues as $key => $q) {
        while (!empty($queues[$key])) {
            $elements[$i++] = array_shift($queues[$key]);
        }
    }
        // Remaining iterations are determined based on longest digits element.
    $it = strlen($longest) - 1;
    $d = 10;
    while ($it--) {
        foreach ($elements as $el) {
            array_push($queues[floor($el / $d) % 10], $el);
        }
        $i = 0;
        foreach ($queues as $key => $q) {
            while (!empty($queues[$key])) {
                $elements[$i++] = array_shift($queues[$key]);
            }
        }
        $d *= 10;
    }
});