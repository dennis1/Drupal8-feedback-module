<?php

namespace Drupal\den_feedback\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class FeedbackController.
 */
class FeedbackController extends ControllerBase {

  /**
   * View results.
   *
   * @return string
   *   Return feedback results.
   */
  public function viewResults() {

    // Prepare header.
    $header = [
      ['data' => t('ID'), 'field' => 'id'],
      ['data' => t('First Name'), 'field' => 'first_name'],
      ['data' => t('Last Name'), 'field' => 'last_name'],
      ['data' => t('Email'), 'field' => 'email'],
      ['data' => t('Category'), 'field' => 'category'],
      ['data' => t('Message'), 'field' => 'message'],
    ];

    $connection = \Drupal::database();
    $query = $connection->select('custom_feedback', 'cb');
    $query->fields('cb',
                            [
                              'id',
                              'first_name',
                              'last_name',
                              'email',
                              'category',
                              'message',
                            ]
            );
    $table_sort = $query->extend('Drupal\Core\Database\Query\TableSortExtender')->orderByHeader($header);
    $pager = $table_sort->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit(10);
    $result = $pager->execute();

    $rows = [];
    // List the custom_feedback entity.
    if (!empty($result)) {
      foreach ($result as $row) {
        $rows[] = ['data' => (array) $row];
      }
    }

    $build = [
      '#markup' => t('List Of All Feedbacks'),
    ];

    $build['custom_feedback_table'] = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
    $build['pager'] = [
      '#type' => 'pager',
    ];

    return $build;

  }

}
