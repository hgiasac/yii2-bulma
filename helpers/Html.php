<?php

namespace bulma\helpers;

/**
 * BaseHtml provides concrete implementation for [[Html]].
 */
class Html extends yii\helpers\BaseHtml
{
    /**
   * Render image HTML
   *
   * @method image
   * @param  string $url     Image URL
   * @param  array  $options Image options
   *
   * @return string          Image HTML
   */
  public static function image($url, $options = [])
  {
      $class = 'image' . (isset($options['class']) ? ' ' . $options['class'] : '');
      unset($options['class']);
      return '<figure class="' . $class . '">' . self::img($url, $options) . '</figure>';
  }

  /**
   * Render HTML icon
   * @method icon
   * @param  string $iconClass  Icon class
   * @param  array  $options    Options data
   * @return string             HTML string
   */
  public static function icon(string $iconClass, $options = [])
  {
      $class = isset($options['class']) ?  ' ' . $options['class'] : '';
      return '<span class="icon ' . $class . '">
      <i class="' . $iconClass .  '"></i></span>';
  }
}
