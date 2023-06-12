<?php

use Core\Container;

test('it can resolve something out of the container', function () {
//    arrand
    $container = new Container();

    $container->bind('foo', fn() => 'bar');
// act
    $result = $container->resolve('foo');
// expect/assert
    expect($result)->toEqual('bar');
});