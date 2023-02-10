<?php

namespace Drupal\livefilter\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Search form' block.
 *
 * @Block(
 *   id = "livefilter",
 *   admin_label = @Translation("Live Filter"),
 * )
 */
class LiveFilterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'livefilter',
      '#elements_selector' => $this->configuration['elements_selector'],
      '#text_selector' => $this->configuration['text_selector'],
      '#placeholder' => $this->configuration['placeholder'],
      '#size' => $this->configuration['size'],
      '#min_input' => $this->configuration['min_input'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'elements_selector' => '',
      'text_selector' => '',
      'placeholder' => '',
      'size' => '',
      'min_input' => 1,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['elements_selector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Elements selector'),
      '#description' => $this->t('The css selector to find the elements to filter.'),
      '#default_value' => $this->configuration['elements_selector'],
      '#required' => TRUE,
    ];

    $form['text_selector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text selector'),
      '#description' => $this->t('The optional css selector to find the text to filter.'),
      '#default_value' => $this->configuration['text_selector'],
    ];

    $form['placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Placeholder'),
      '#description' => $this->t('The placeholder text displayed in the input element.'),
      '#default_value' => $this->configuration['placeholder'],
    ];

    $form['size'] = [
      '#type' => 'number',
      '#title' => $this->t('Size'),
      '#description' => $this->t('The input element size in characters.'),
      '#default_value' => $this->configuration['size'],
    ];

    $form['min_input'] = [
      '#type' => 'number',
      '#title' => $this->t('Minimum input length'),
      '#description' => $this->t('The input length needed to start filtering.'),
      '#default_value' => $this->configuration['min_input'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['elements_selector'] = $form_state->getValue('elements_selector');
    $this->configuration['text_selector'] = $form_state->getValue('text_selector');
    $this->configuration['placeholder'] = $form_state->getValue('placeholder');
    $this->configuration['size'] = $form_state->getValue('size');
    $this->configuration['min_input'] = $form_state->getValue('min_input');
  }

}
