<?php

namespace Drupal\dropsolid_dependency_injection;

use Drupal\dropsolid_dependency_injection\DTO\PhotoDTO;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * The service to retrieve and build the photos from the rest.
 */
class RestOutputService implements RestConnectionInterface {

  /**
   * The HTTP client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected ClientInterface $client;

  /**
   * Construct service object.
   */
  public function __construct(ClientInterface $client) {
    $this->client = $client;
  }

  /**
   * {@inheritDoc}
   */
  public function getPhotos(): array {
    $response = $this->client->request('GET', "https://jsonplaceholder.typicode.com/albums/5/photos");
    $data = $response->getBody()->getContents();
    $decoded_photos = json_decode($data);
    if (!$decoded_photos) {
      throw new \Exception('Invalid data returned from API');
    }

    return PhotoDTO::transformMap($decoded_photos);
  }

  /**
   * {@inheritDoc}
   */
  public function buildPhotos(): ?array {
    try {
      /** @var \Drupal\dropsolid_dependency_injection\DTO\PhotoDTO $photos */
      $photos = $this->getPhotos();
    }
    catch (\Exception | GuzzleException $e) {
      return NULL;
    }

    $photo_elements = [];
    foreach ($photos as $item) {
      $photo_elements[] = [
        '#theme' => 'image',
        '#uri' => $item->thumbnailUrl,
        '#alt' => $item->title,
        '#title' => $item->title,
      ];
    }

    return [
      '#cache' => [
        'max-age' => 60,
        'contexts' => ['url'],
      ],
      'rest_output_block' => ['photos' => $photo_elements],
    ];
  }

}
