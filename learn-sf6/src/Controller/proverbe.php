<?php 
namespace App\Service;
class Proverbe
{
    public function getProverbe()
    {
        $messages = [
            'Mélissa la plus belle',
            'Mélissa la plus intéligente',
            'Mélissa le meilleur coup du monde'
        ];

        $index = array_rand($messages);
        return $messages[$index];
    }
}