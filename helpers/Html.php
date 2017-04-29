<?php

namespace bulma\helpers;

/**
 * BaseHtml provides concrete implementation for [[Html]].
 */
class Html extends \yii\helpers\BaseHtml
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

  /**
   * Generates a submit button tag.
   *
   * Be careful when naming form elements such as submit buttons. According to the [jQuery documentation](https://api.jquery.com/submit/) there
   * are some reserved names that can cause conflicts, e.g. `submit`, `length`, or `method`.
   *
   * @param string $content the content enclosed within the button tag. It will NOT be HTML-encoded.
   * Therefore you can pass in HTML code such as an image tag. If this is is coming from end users,
   * you should consider [[encode()]] it to prevent XSS attacks.
   * @param array $options the tag options in terms of name-value pairs. These will be rendered as
   * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
   * If a value is null, the corresponding attribute will not be rendered.
   * See [[renderTagAttributes()]] for details on how attributes are being rendered.
   * @return string the generated submit button tag
   */
  public static function submitButton($content = 'Submit', $options = [])
  {
      $options['type'] = 'submit';
      $options['class'] = 'button' . (isset($options['class']) ?
        ' ' . $options['class'] : '');
      return static::button($content, $options);
  }
}
