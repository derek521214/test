<?php
function getRandomString($iLength, $iType = 0)
{
    $s_random_string = '';
    switch ($iType) {
        case 1:
            $s_characters = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 2:
            $s_characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 3:
            $s_characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            break;
        case 4:
            $s_characters = '1A2B3C4D5E6F7G8H9J1K2L3M4N5P6R7S8T9U1V2W3X4Y5Z';
            break;
        case 5:
            $s_characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 6:
            $s_characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        default:
            $s_characters = '0123456789';
            break;
    }
    $i_length_max = strlen($s_characters) - 1;
    for ($i = 0; $i < $iLength; $i++) {
        $s_random_string .= $s_characters[getRandomNumber($i_length_max)];
    }
    return $s_random_string;
}
/**
 * 获得随机的指定范围的数
 * @param $iMax
 * @param int $iMin
 * @return mixed
 * @author DongJiahao
 */
function getRandomNumber($iMax, $iMin = 0)
{
    list($s_msecond, $s_second) = explode(' ', microtime());
    $d_seed = (float)$s_second + ((float)$s_msecond * 100000);
    mt_srand($d_seed);
    return mt_rand($iMin, $iMax);
}
$arr =[];
for ($i=0;$i<30000;$i++) {
    $arr[] = getRandomString(8, 4);
}
var_dump(count($arr));
var_dump(count(array_unique($arr)));

var_dump($arr);