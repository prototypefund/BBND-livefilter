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
      '#container_selector' => $this->configuration['container_selector'],
      '#text_selector' => $this->configuration['text_selector'],
      '#placeholder' => $this->configuration['placeholder'],
      '#size' => $this->configuration['size'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'container_selector' => '',
      'text_selector' => '',
      'placeholder' => '',
      'size' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['container_selector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Container selector'),
      '#description' => $this->t('The css selector to find the container, the children of which are the elements to filter.'),
      '#default_value' => $this->configuration['container_selector'],
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

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['container_selector'] = $form_state->getValue('container_selector');
    $this->configuration['text_selector'] = $form_state->getValue('text_selector');
    $this->configuration['placeholder'] = $form_state->getValue('placeholder');
    $this->configuration['size'] = $form_state->getValue('size');
  }

}
