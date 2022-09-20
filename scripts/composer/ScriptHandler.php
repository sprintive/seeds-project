<?php

namespace Seeds\composer;

use Composer\Script\Event;

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
  public static function removeGitDirectories(Event $event) {
    $exclude = $event->getComposer()->getConfig()->get('seeds-exclude');
    $root = static::getDrupalRoot(getcwd());
    if (is_array($exclude)) {
      // Map exclude array, make all strings into '*/STRING/*';.
      $exclude = array_map(function ($item) {
        return '*/' . $item . '/*';
      }, $exclude);
      $suffix = '-not -path ' . implode(' -not -path ', $exclude);
      exec("find $root -type d -name .git $suffix -exec rm -rf {} +");
    }
    else {
      exec('find ' . $root . ' -name \'.git\' | xargs rm -rf');
    }
  }

}
