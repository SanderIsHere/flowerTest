<?php

namespace App\Services;

use GuzzleHttp\Client;


class OmdbServices
{
  // usable property for another public function
  protected $client;
  protected $apikey;
  protected $url;

  // buat inject guzzle client dan ambil api key nya
  public function __construct()
  {
    $this->client = new Client();
    $this->apikey = env('OMDB_API_KEY');
    $this->url = env('OMDB_API_URL');
  }

  public function searchAll($searchingKey)
  {
    $response = $this->client->get($this->url, [
      'query' => [
        'apikey' => $this->apikey, //buat ngirim api key buat narik data
        's' => $searchingKey,  //searching parameter
      ]
    ]);

    return json_decode($response->getBody(), true);  //output json convert to array
  }


  public function movieDetail($ombdID)
  {

    $response = $this->client->get($this->url, [
      'query' => [
        'apikey' => $this->apikey,   //pulling api key
        'i' => $ombdID,   //ombd id parameter 
      ]
    ]);

    return json_decode($response->getBody(), true);  //output di decode
  }
}
