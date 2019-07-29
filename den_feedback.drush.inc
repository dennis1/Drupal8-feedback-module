<?php

/**
 * @file
 * Define the drush command related to feedback.
 *
 * This file is NOT useful for drush9+.
 *
 * Please use Drush9 and look at the Drush9 code(/src/Commands) instead.
 */

/**
 * Implements hook_drush_command().
 */
function den_feedback_drush_command() {
  $commands = [];
  // The 'archive-messages' command.
  $commands['archive-messages'] = [
    'description' => 'Delete feedback messages that is over one week old',
    'aliases' => ['am'],
    'arguments' => [],
    'drupal dependencies' => ['den_feedback'],
    'examples' => [
      'drush archive-messages' => 'Delete feedback messages that is over one week old from now',
    ],

    'bootstrap' => DRUSH_BOOTSTRAP_DRUPAL_FULL,
  ];

  return $commands;
}

/**
 * Call back function defines the logic for archiving feedback messages command.
 */
function drush_den_feedback_archive_messages() {
  $result = \Drupal::entityQuery("custom_feedback")
    ->condition('created', strtotime('-30 days'), '<=')
    ->execute();

  $storage_handler = \Drupal::entityTypeManager()->getStorage("custom_feedback");
  $entities = $storage_handler->loadMultiple($result);
  $count_delete_feedback = (count($entities));
  if ($count_delete_feedback !== 0) {
    $storage_handler->delete($entities);
    print_r('Successfully deleted ' . $count_delete_feedback . ' old feedback records!');
  }
  else {
    print_r('There is NO old feedback message to archive.');
  }
}
