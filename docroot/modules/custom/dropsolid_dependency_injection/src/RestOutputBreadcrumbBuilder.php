<?php

namespace Drupal\dropsolid_dependency_injection;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Update breadcrumb of the Photos page.
 */
class RestOutputBreadcrumbBuilder implements BreadcrumbBuilderInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) {
    return $route_match->getRouteName() == 'dropsolid_dependency_injection.rest_output_controller_showPhotos';
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $breadcrumb = new Breadcrumb();
    $breadcrumb->addCacheContexts(['route']);

    // Home page link.
    $links[] = Link::createFromRoute($this->t('Home'), '<front>');
    // Added fake Breadcrumb items.
    // @todo need to create new pages Dropsolid and Example to set the correct links.
    $links[] = Link::createFromRoute($this->t('Dropsolid'), 'dropsolid_dependency_injection.rest_output_controller_showPhotos');
    $links[] = Link::createFromRoute($this->t('Example'), 'dropsolid_dependency_injection.rest_output_controller_showPhotos');
    // An item to the current page.
    $links[] = Link::createFromRoute($this->t('Photos'), '<none>');

    $breadcrumb->setLinks($links);

    return $breadcrumb;
  }

}
