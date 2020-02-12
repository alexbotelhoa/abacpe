<?php

function formatPrice($vlprice)
{

    if (!$vlprice > 0) $vlprice = 0;

    return number_format((float)$vlprice, 2, ",", ".");

}

function formatDate($date)
{
    return date('d/m/Y', strtotime($date));
}


?>