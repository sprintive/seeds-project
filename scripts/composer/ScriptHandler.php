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
   *   Project root directory.
   *
   * @return string
   *   Drupal root path.
   */
  protected static function getDrupalRoot($root) {
    return $root . '/public_html';
  }

  /**
   * Remove .git folder from modules, themes, profiles of development branches.
   */
  public static function removeGitDirectories() {
    $root = static::getDrupalRoot(getcwd());
    exec('find ' . $root . ' -name \'.git\' | xargs rm -rf');
  }

}
