<?php 
namespace App\Services;

use GuzzleHttp\Client;
class BiteShipService {

    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct() {
        $this->client = new Client();
        $this->apiKey = config('biteship.api_key');
        $this->baseUrl = config('biteship.base_url');
    }

    public function getShippingOptions($origin, $destination, $weight) {
        $response = $this->client->get($this->baseUrl . '/shipping-options', [
            'query' => [
                'api_key' => $this->apiKey,
                'weight' => $weight,
                'destination' => $destination,
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }


}

?>