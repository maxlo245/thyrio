<?php

class AuthController
{
    public function login(): void
    {
        // Ici tu ajouteras la logique de connexion
        include __DIR__ . '/../../templates/login.php';
    }

    public function register(): void
    {
        // Ici tu ajouteras la logique d'inscription
        include __DIR__ . '/../../templates/register.php';
    }
}
