<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 20.03.2017
 * Time: 13:44
 */

namespace test;


class test
{
    // С версии PHP 5.6.0
    const ONE = 1;

    const TWO = ONE * 2;
    const THREE = ONE + self::TWO;
    const SENTENCE = 'The value of THREE is '.self::THREE;
}
