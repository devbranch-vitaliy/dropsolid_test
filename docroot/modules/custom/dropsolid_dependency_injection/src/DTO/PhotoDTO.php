<?php

namespace Drupal\dropsolid_dependency_injection\DTO;

/**
 * Simple DTO for the Rest photo.
 *
 * Use DTO to be sure that we have a valid photo data.
 */
class PhotoDTO {

  /**
   * The title of the photo.
   *
   * @var string
   */
  public string $title;

  /**
   * The main URL of the photo.
   *
   * @var string
   */
  public string $url;

  /**
   * The photo thumbnail URL.
   *
   * @var string
   */
  public string $thumbnailUrl;

  /**
   * Transform input data into the DTO object.
   *
   * @param mixed $data
   *   Incoming data.
   *
   * @return PhotoDTO|null
   *   DTO object or null if there is some errors.
   */
  public static function transform($data): ?PhotoDTO {
    if (is_array($data)) {
      $data = (object) $data;
    }
    if (!is_object($data)) {
      return NULL;
    }
    if (!isset($data->title, $data->url, $data->thumbnailUrl)) {
      return NULL;
    }

    $dto = new self();
    foreach (get_class_vars(__CLASS__) as $var => $value) {
      $dto->{$var} = $data->{$var};
    }
    return $dto;
  }

  /**
   * Map the array items and transform them.
   *
   * @param array $data
   *   Incoming data.
   *
   * @return PhotoDTO[]|null
   *   DTO object or null if there is some errors.
   */
  public static function transformMap(array $data): ?array {
    return array_filter(array_map('self::transform', $data));
  }

}
