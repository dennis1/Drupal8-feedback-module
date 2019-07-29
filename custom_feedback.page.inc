<?php

/**
 * @file
 * Contains custom_feedback.page.inc.
 *
 * Page callback for Custom feedback entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Custom feedback templates.
 *
 * Default template: custom_feedback.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_custom_feedback(array &$variables) {
  // Fetch CustomFeedback Entity Object.
  $custom_feedback = $variables['elements']['#custom_feedback'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
