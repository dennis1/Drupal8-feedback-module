<?php

namespace Drupal\den_feedback\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the den_feedback module.
 */
class FeedbackControllerTest extends WebTestBase {

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "den_feedback FeedbackController's controller functionality",
      'description' => 'Test Unit for module den_feedback and controller FeedbackController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests den_feedback functionality.
   */
  public function testFeedbackController() {
    // Check that the basic functions of module den_feedback.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
