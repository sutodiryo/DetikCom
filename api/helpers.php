<?php

function generateRefID()
{
    $data = time() . rand(10 * 45, 100 * 98);
    return $data;
}

function generateVA($length = 20)
{
    $random = "";
    srand((double) microtime() * 1000000);

    $data = "123456123456789071234567890890";

    for ($i = 0; $i < $length; $i++) {
        $random .= substr($data, (rand() % (strlen($data))), 1);
    }

    return $random;

}
