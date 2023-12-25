<?php

function getSubdomain(): string
{
    $hostname = $_SERVER['HTTP_HOST'];

    $parts = explode('.', $hostname);

    if (count($parts) >= 3) {
        return $parts[0];
    } else {
        return '';
    }
}

