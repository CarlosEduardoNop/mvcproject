<?php
namespace App\Controller;

use App\Http\Response;
use App\Utils\View;

class HomeController
{
    public function index()
    {
        try {
            return new Response(
                200,
                View::render('home', [
                    'teste' => "Isso é um teste"
                ], 'Titulo teste')
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