<?php

namespace App\Controller;

use App\Helpers\ArrayHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

class GithubReposController extends AbstractController
{

    /**
     * @Route("/", name="github_repos")
     */
    public function index(ArrayHelper $arrayHelper)
    {
        $date = new \DateTime();
        $date->modify('-1 month');
        //get github api url
        $API_KEY = $_ENV['APP_GITHUB_API'];

        //consume the web service to get last 100 trending repositories created in the last 30 days
        $client = HttpClient::create();
        $response = $client->request('GET', str_replace("{date}", $date->format('Y-m-d'), $API_KEY));
        $repos = $response->toArray();

        // group repositories by language
        $reposByLanguage = $arrayHelper->groupByProperty($repos["items"], 'language', 'None');


        return $this->render('github_repos/index.html.twig', [
            'controller_name' => 'GithubReposController',
            'reposByLanguage' => $reposByLanguage
        ]);
    }

}

