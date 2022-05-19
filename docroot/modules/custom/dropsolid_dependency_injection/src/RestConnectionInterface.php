<?php

namespace Drupal\dropsolid_dependency_injection;

/**
 * PulsesCityProvider Interface for decoding json & getting data.
 */
interface RestConnectionInterface {

  /**
   * Retrieve photos from the Rest.
   *
   * @return object[]
   *   The decoded request result.
   *
   * @throws \Exception
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function getPhotos(): ?array;

  /**
   * Build photos from the Rest.
   *
   * @return array|null
   *   Image elements or NULL if data doesn't exist.
   */
  public function buildPhotos(): ?array;

}
