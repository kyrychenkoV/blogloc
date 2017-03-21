<?php
class foa2 {
    // С версии PHP 5.6.0
    const ONE = 1;

    const TWO = ONE * 2;
    const THREE = ONE + self::TWO;
    const SENTENCE = 'The value of THREE is '.self::THREE;
}
?>