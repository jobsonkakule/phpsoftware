<?php
namespace App\Helpers;

class Text {

    public static function excerpt (string $content, $limit = 60) {
        if (mb_strlen($content) <= $limit) {
            return $content;
        }
        $lastSpace = mb_strpos($content, ' ', $limit);
        return mb_substr($content, 0, $lastSpace) . '...';
    }

}