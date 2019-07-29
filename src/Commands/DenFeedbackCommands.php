<?php

namespace Drupal\den_feedback\Commands;

use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class DenFeedbackCommands extends DrushCommands {

  /**
   * Delete feedback messages that is over one week old.
   *
   * @usage drush archive-messages
   *   Delete feedback messages that is over one week old from now
   *
   * @command archive-messages
   * @aliases am
   */
  public function archiveMessages() {
    // SQL query select the message older than 30 days.
    $result = \Drupal::entityQuery("custom_feedback")
      ->condition('created', strtotime('-7 days'), '<=')
      ->execute();

    $storage_handler = \Drupal::entityTypeManager()->getStorage("custom_feedback");
    // Get the entity from the SQL query.
    $entities = $storage_handler->loadMultiple($result);
    $count_delete_feedback = (count($entities));
    if ($count_delete_feedback !== 0) {
      $storage_handler->delete($entities);
      $this->logger()->success(dt('Successfully deleted ' . $count_delete_feedback . ' old feedback records!'));
    }
    else {
      $this->logger()->success(dt('There is NO old feedback message to archive.'));
    }

  }

}
