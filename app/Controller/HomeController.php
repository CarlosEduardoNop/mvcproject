<?php
namespace App\Controller;

use App\Http\Response;
use App\Utils\View;

class HomeController
{
    public function index()
    {
        try {
            $userId = 50;
            $userName = 'Welinton Ferreira';
            $usersRegistered = 4356;

            return new Response(
                200,
                View::render('home', [
                    'userId' => $userId,
                    'userName' => $userName,
                    'usersRegistered' => $usersRegistered
                ], 'Início')
            );
        } catch (\Exception $e) {
            return new Response(
                500,
                [
                    'message' => 'Ocorreu um erro'
                ],
                'application/json'
            );
        }
    }
}