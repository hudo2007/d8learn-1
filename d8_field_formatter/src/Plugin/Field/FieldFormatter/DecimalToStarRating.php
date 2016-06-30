<?php

namespace Drupal\d8_field_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\DecimalFormatter;

/**
 * Plugin implementation of the 'd8_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "decimal_to_rating",
 *   label = @Translation("Decimal to Star Rating"),
 *   field_types = {
 *     "decimal"
 *   }
 * )
 */
class DecimalToStarRating extends DecimalFormatter {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $key => $value) {
      $elements[$key] = [
        '#theme' => 'star_rating',
        '#rating' => $value->value * 20,
        '#attached' => ['library'=> ['d8_field_formatter/star_rating'],],
      ];
    }
    return $elements;
  }

}