<?php

namespace Seeds\composer;

/**
 * Seeds Composer Script Handler.
 */
class ScriptHandler {

  /**
   * Get Drupal root directory.
   *
   * @param string $root
   *    Project root directory.
   *
   * @return string
   *    Drupal root path.
   */
  protected static function getDrupalRoot($root) {
    return $root . '/public_html';
  }

  /**
   * Remove .git folder from modules, themes, profiles of development branches.
   */
  public static function removeGitDirectories() {
    $drupal_root = static::getDrupalRoot(getcwd());
    exec('find ' . $drupal_root . ' -name \'.git\' | xargs rm -rf');
  }

  /**
   * Moves the 'translations.yml' file from the root to Drupal Root.
   */
  public static function moveTranslationsYmlFile() {
    $root = getcwd();
    if (file_exists("$root/translations.yml")) {
      exec("mv $root/translations.yml $root/public_html/translations.yml");
    }
  }

}
