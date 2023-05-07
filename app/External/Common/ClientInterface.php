<?php

namespace App\External\Common;

use GuzzleHttp\Client;

interface ClientInterface
{
    public function getHttpClient(): Client;
    public function setHttpClient(Client $client): ClientInterface;
}
