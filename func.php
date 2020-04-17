<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/8/3
 * Time: 10:41
 */

function sumOfInts(int ...$ints) : int
{
    return array_sum($ints);
}
//var_dump(sumOfInts(2,3,4));

function sumOfIntsArray(int ...$ints) : array
{
    return $ints;
}
//var_dump(sumOfIntsArray(2,3,4));

var_dump(token_get_all("<?php echo 'hello world'"));