<?php

namespace Drupal\den_feedback\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Class FeedbackForm.
 */
class FeedbackForm extends FormBase {

  /**
   * Drupal\Core\Messenger\MessengerInterface definition.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructs a new FeedbackForm object.
   */
  public function __construct(
    MessengerInterface $messenger
  ) {
    $this->messenger = $messenger;
  }

  /**
   * Create a new FeedbackForm object and get the form result message.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger')
    );
  }

  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'den_feedback_feedback_form';
  }

  /**
   * Form constructor for the FeedbackForm.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('Please share us the feedback. Note that all the fields are mandatory.'),
    ];

    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#description' => $this->t('Enter your first name'),
      '#required' => TRUE,
    ];

    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#description' => $this->t('Please enter your last name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your Email'),
      '#description' => $this->t('Please enter your email'),
      '#required' => TRUE,
    ];

    // The options array of category dropdown.
    $category_values = [
      'Personal' => t('Personal'),
      'Business' => t('Business'),
    ];

    $form['category'] = [
      '#type' => 'select',
      '#title' => $this->t('Category'),
      '#description' => $this->t('Select Category'),
      '#options' => $category_values,
      '#required' => TRUE,
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Your feedback'),
      '#description' => $this->t('Please enter your feedback'),
    ];

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;

  }

  /**
   * Validate the form, the feedback must be at least 10 characters long.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state interface.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $feedback = $form_state->getValue('message');

    if (strlen($feedback) < 10) {
      // Set an error for the form element with a key of "title".
      $form_state->setErrorByName('message', $this->t('The feedback must be at least 10 characters long.'));
    }

  }

  /**
   * Form submission handler, save the entity on form submit.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $custom_feedback = entity_create('custom_feedback');
    $custom_feedback->first_name = $form_state->getValue('first_name');
    $custom_feedback->last_name = $form_state->getValue('last_name');
    $custom_feedback->email = $form_state->getValue('email');
    $custom_feedback->category = $form_state->getValue('category');
    $custom_feedback->message = $form_state->getValue('message');
    $custom_feedback->save();

    // Display the results.
    // Call the Static Service Container wrapper
    // $messenger = \Drupal::messenger();
    $this->messenger->addMessage('Dear: ' . $form_state->getValue('first_name') . ' ' . $form_state->getValue('last_name'));
    $this->messenger->addMessage('Your feedback has been submitted');

    // Redirect to home.
    $form_state->setRedirect('<front>');

  }

}
