<?php

namespace Drupal\domain_site_settings\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DomainConfigSettingsForm.
 *
 * @package Drupal\domain_site_settings\Form
 */
class DomainConfigSettingsForm extends ConfigFormBase {
  public function __construct(
    ConfigFactoryInterface $config_factory
    ) {
    parent::__construct($config_factory);
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'domain_site_settings.domainconfigsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'domain_config_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('domain_site_settings.domainconfigsettings');
    $form['domain_id'] = [
      '#type' => 'hidden',
      '#title' => $this->t('Domain ID'),
      '#default_value' => $config->get('domain_id'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('domain_site_settings.domainconfigsettings')
      ->set('domain_id', $form_state->getValue('domain_id'))
      ->save();
  }

}
