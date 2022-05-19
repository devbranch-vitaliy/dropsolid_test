<?php

namespace Drupal\dropsolid_dependency_injection\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dropsolid_dependency_injection\RestConnectionInterface;

/**
 * Provides a 'RestOutputBlock' block.
 *
 * @Block(
 *  id = "rest_output_block",
 *  admin_label = @Translation("Rest output block"),
 * )
 */
class RestOutputBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Rest output service.
   *
   * @var \Drupal\dropsolid_dependency_injection\RestConnectionInterface
   */
  private RestConnectionInterface $restOutput;

  /**
   * Constructs a new instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\dropsolid_dependency_injection\RestConnectionInterface $restOutput
   *   Rest output service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RestConnectionInterface $restOutput) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->restOutput = $restOutput;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): RestOutputBlock {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('dropsolid_dependency_injection.restoutput'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return $this->restOutput->buildPhotos();
  }

}
