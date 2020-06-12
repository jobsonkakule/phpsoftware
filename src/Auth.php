<?php
namespace App;

use App\Security\ForbiddenException;
use Exception;

class Auth {

    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['auth']) || ($_SESSION['role'] === 'Utilisateur') || ($_SESSION['role'] === null)) {
            throw new ForbiddenException();
        }
        // if ($_SESSION['role'] !== 'admin') {
        //     throw new ForbiddenException();
        // }
    }

    public static function checkUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['auth'])) {
            throw new ForbiddenException();
        }
        // if ($_SESSION['role'] !== 'admin') {
        //     throw new ForbiddenException();
        // }
    }

    public static function restrict()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['auth']) || ($_SESSION['role'] !== 'Administrateur')) {
            throw new ForbiddenException();
        }
    }

    public static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}