<?php
function e (string $text) {
    return htmlentities($text);
}

function ago(DateTime $date, string $format = 'd/m/Y H:i')
{
    return '<span class="timeago" datetime="' . $date->format(DateTime::ISO8601) . '">' .
    $date->format($format) .
    '</span>';
}