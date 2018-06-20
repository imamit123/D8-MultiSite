<?php

namespace Drupal\custom_migrate\Plugin\migrate\process;

use Drupal\file\Plugin\migrate\process\d6\CckFile;
use Drupal\migrate\Plugin\MigrationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @MigrateProcessPlugin(
 *   id = "new_cck_file"
 * )
 */
class NewCckFile extends CckFile {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration = NULL) {
    $migration_plugin_configuration = [
      'source' => ['fid'],
      'migration' => 'drupal6_images',
    ];

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $migration,
      $container->get('plugin.manager.migrate.process')->createInstance('migration', $migration_plugin_configuration, $migration)
    );
  }
}
