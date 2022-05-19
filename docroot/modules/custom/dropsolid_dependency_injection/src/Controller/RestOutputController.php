<?php

namespace Drupal\dropsolid_dependency_injection\Controller;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dropsolid_dependency_injection\RestConnectionInterface;

/**
 * Dropsolid Dependency Injection Example: Photos.
 *
 * @package Drupal\dropsolid_dependency_injection\Controller
 */
class RestOutputController implements ContainerInjectionInterface {

  /**
   * Rest output service.
   *
   * @var \Drupal\dropsolid_dependency_injection\RestConnectionInterface
   */
  private RestConnectionInterface $restOutput;

  /**
   * Constructs a new instance.
   *
   * @param \Drupal\dropsolid_dependency_injection\RestConnectionInterface $restOutput
   *   Rest output service.
   */
  public function __construct(RestConnectionInterface $restOutput) {
    $this->restOutput = $restOutput;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): RestOutputController {
    return new static(
      $container->get('dropsolid.restoutput'),
    );
  }

  /**
   * Render photos from the rest.
   *
   * @return array
   *   Build data.
   */
  public function showPhotos(): array {
    return $this->restOutput->buildPhotos();
  }

}
