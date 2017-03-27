<?php

namespace Drupal\domain_site_settings\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Class DomainSiteSettingsController.
 *
 * @package Drupal\domain_site_settings\Controller
 */
class DomainSiteSettingsController extends ControllerBase {

  /**
   * 
   * @return string
   */
  public function domains_list() {
    $domains = \Drupal::service('domain.loader')->loadMultipleSorted();
    $rows = [];
    /** @var \Drupal\domain\DomainInterface $domain */
    foreach ($domains as $domain) {
      $row = [
        $domain->label(),
        $domain->id(),
        Link::fromTextAndUrl(t('Edit'), Url::fromRoute('domain_site_settings.config_form', array('domain_id' => $domain->id()))),
      ];
      $rows[] = $row;
    }
    // Build a render array which will be themed as a table.
    $build['pager_example'] = array(
      '#rows' => $rows,
      '#header' => array(t('Name'), t('Hostname'), t('Edit Settings')),
      '#type' => 'table',
      '#empty' => t('No domain record found.'),
    );
    return $build;
  }

}
