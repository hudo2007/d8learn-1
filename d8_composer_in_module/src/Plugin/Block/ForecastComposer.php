<?php

namespace Drupal\d8_composer_in_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Forecast\Forecast;


/**
 * @Block(
 *  id = "forecast",
 *  admin_label = @Translation("Forecast"),
 * )
 */
class ForecastComposer extends BlockBase {

  public function build() {
    $forecast = new Forecast('7411b0e6d5e0c99fbd7405fd6de00cd5');
    $forecast = $forecast->get($this->configuration['latitude'], $this->configuration['longitude']);
    return array(
      'forecast' => array(
        '#markup' => $forecast->daily->summary,
      ),
    );
  }


  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $form['latitude'] = array(
      '#title' => t('Latitude'),
      '#type' => 'textfield',
      '#default_value' => $this->configuration['latitude'],
    );
    $form['longitude'] = array(
      '#title' => t('Longitude'),
      '#type' => 'textfield',
      '#default_value' => $this->configuration['longitude'],
    );
    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('latitude', $form_state->getValue('latitude'));
    $this->setConfigurationValue('longitude', $form_state->getValue('longitude'));
  }

}