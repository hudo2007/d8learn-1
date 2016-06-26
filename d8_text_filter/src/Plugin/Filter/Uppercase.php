<?php

namespace Drupal\d8_text_filter\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;
use Drupal\Core\Form\FormStateInterface;


/**
 * Uppercase filter.
 *
 * @Filter(
 *   id = "filter_uppercase",
 *   title = @Translation("Uppercase Filter"),
 *   description = @Translation("Changes some words to Uppercase!"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE
 * )
 */
class Uppercase extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $uppercase_words = explode(',', $this->settings['uppercase_words']);
    $search = array_map('trim', $uppercase_words);
    $replace = array_map('strtoupper', $search);
    $uppercase_text = str_ireplace($search, $replace, $text);
    return new FilterProcessResult($uppercase_text);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['uppercase_words'] = array(
      '#type' => 'textfield',
      '#default_value' => $this->settings['uppercase_words'],
      '#title' => $this->t('Words to change to uppercase'),
      '#description' => $this->t('Enter list of words which should be capitalized. Separate multiple words with comma.'),
    );
    return $form;
  }
}
