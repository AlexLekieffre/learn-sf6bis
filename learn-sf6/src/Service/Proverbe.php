<?php 


namespace App\Service;

use Psr\Log\LoggerInterface;

class Proverbe
{

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    
    public function getProverbe()
    {
        $messages = [
            'Mélissa est la plus belle',
            'Mélissa est la plus intélligente',
            'Mélissa est le meilleur coup du monde',
            'Mélissa fait les meilleurs pipe du monde',
            'Mélissa fait très bien l\'amour',
            'Mélissa me fait bander',
            'Melissa est tout a moi'
        ];

        $index = array_rand($messages);
        $this->logger->info('proverbe lu {{$messages}}');
        return $messages[$index];
    }
}