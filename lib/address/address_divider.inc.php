<?php

function addressDevider($str)
{
    $address = explode(',', $str);

    $j=1;
    $k=2;
    $l=3;
    $m=4;
    $n=5;
    $o=6;
    $p=7;
    $q=8;

    $realAddress= $str;

    if ($j == count($address)) {
        $realAddress = $address[0];
    } elseif ($k == count($address)) {
        $realAddress = $address[0].',<br/>'.$address[1];
    } elseif ($l == count($address)) {
        $realAddress = $address[0].', '.$address[1].',<br/>'.$address[2];
    } elseif ($m == count($address)) {
        $realAddress = $address[0].', '.$address[1].',<br/>'.$address[2].', '.$address[3];
    } elseif ($n == count($address)) {
        $realAddress = $address[0].', '.$address[1].',<br/>'.$address[2].', '.$address[3].'<br/>'.$address[4];
    } elseif ($o == count($address)) {
        $realAddress = $address[0].', '.$address[1].',<br/>'.$address[2].', '.$address[3].'<br/>'.$address[4].'<br/>'.$address[5];
    } elseif ($p == count($address)) {
        $realAddress = $address[0].', '.$address[1].',<br/>'.$address[2].', '.$address[3].'<br/>'.$address[4].'<br/>'.$address[5].'<br/>'.$address[6];
    } elseif ($q == count($address)) {
        $realAddress = $address[0].', '.$address[1].',<br/>'.$address[2].', '.$address[3].'<br/>'.$address[4].'<br/>'.$address[5].'<br/>'.$address[6].'<br/>'.$address[7];
    }

    return $realAddress;
}
