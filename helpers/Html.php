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

  /**
   * Generates a drop-down list.
   * @param string $name the input name
   * @param string|array|null $selection the selected value(s). String for single or array for multiple selection(s).
   * @param array $items the option data items. The array keys are option values, and the array values
   * are the corresponding option labels. The array can also be nested (i.e. some array values are arrays too).
   * For each sub-array, an option group will be generated whose label is the key associated with the sub-array.
   * If you have a list of data models, you may convert them into the format described above using
   * [[\yii\helpers\ArrayHelper::map()]].
   *
   * Note, the values and labels will be automatically HTML-encoded by this method, and the blank spaces in
   * the labels will also be HTML-encoded.
   * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
   *
   * - prompt: string, a prompt text to be displayed as the first option. Since version 2.0.11 you can use an array
   *   to override the value and to set other tag attributes:
   *
   *   ```php
   *   ['text' => 'Please select', 'options' => ['value' => 'none', 'class' => 'prompt', 'label' => 'Select']],
   *   ```
   *
   * - options: array, the attributes for the select option tags. The array keys must be valid option values,
   *   and the array values are the extra attributes for the corresponding option tags. For example,
   *
   *   ```php
   *   [
   *       'value1' => ['disabled' => true],
   *       'value2' => ['label' => 'value 2'],
   *   ];
   *   ```
   *
   * - groups: array, the attributes for the optgroup tags. The structure of this is similar to that of 'options',
   *   except that the array keys represent the optgroup labels specified in $items.
   * - encodeSpaces: bool, whether to encode spaces in option prompt and option value with `&nbsp;` character.
   *   Defaults to false.
   * - encode: bool, whether to encode option prompt and option value characters.
   *   Defaults to `true`. This option is available since 2.0.3.
   *
   * The rest of the options will be rendered as the attributes of the resulting tag. The values will
   * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
   * See [[renderTagAttributes()]] for details on how attributes are being rendered.
   *
   * @return string the generated drop-down list tag
   */
  public static function dropDownList($name, $selection = null, $items = [], $options = [])
  {
      if (!empty($options['multiple'])) {
          return static::listBox($name, $selection, $items, $options);
      }
      $options['name'] = $name;
      unset($options['unselect']);
      $selectOptions = static::renderSelectOptions($selection, $items, $options);
      return '<span class="select">' . static::tag('select', "\n" . $selectOptions . "\n", $options) . '</span>';
  }

  /**
   * Generates a text input field.
   * @param string $name the name attribute.
   * @param string $value the value attribute. If it is null, the value attribute will not be generated.
   * @param array $options the tag options in terms of name-value pairs. These will be rendered as
   * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
   * If a value is null, the corresponding attribute will not be rendered.
   * See [[renderTagAttributes()]] for details on how attributes are being rendered.
   * @return string the generated text input tag
   */
  public static function textInput($name, $value = null, $options = [])
  {
      $options['class'] = 'input' . (isset($options['class']) ? ' ' . $options['class'] : '');
      return static::input('text', $name, $value, $options);
  }

  /**
   * Generates a number input field.
   * @param string $name the name attribute.
   * @param string $value the value attribute. If it is null, the value attribute will not be generated.
   * @param array $options the tag options in terms of name-value pairs. These will be rendered as
   * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
   * If a value is null, the corresponding attribute will not be rendered.
   * See [[renderTagAttributes()]] for details on how attributes are being rendered.
   * @return string the generated text input tag
   */
  public static function numberInput($name, $value = null, $options = [])
  {
      $options['class'] = 'input' . (isset($options['class']) ? ' ' . $options['class'] : '');
      return static::input('number', $name, $value, $options);
  }

  /**
   * Generates a password input field.
   * @param string $name the name attribute.
   * @param string $value the value attribute. If it is null, the value attribute will not be generated.
   * @param array $options the tag options in terms of name-value pairs. These will be rendered as
   * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
   * If a value is null, the corresponding attribute will not be rendered.
   * See [[renderTagAttributes()]] for details on how attributes are being rendered.
   * @return string the generated password input tag
   */
  public static function passwordInput($name, $value = null, $options = [])
  {
      $options['class'] = 'input' . (isset($options['class']) ? ' ' . $options['class'] : '');
      return static::input('password', $name, $value, $options);
  }


    /**
     * Generates a text input tag for the given model attribute.
     * This method will generate the "name" and "value" tag attributes automatically for the model attribute
     * unless they are explicitly specified in `$options`.
     * @param Model $model the model object
     * @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
     * about attribute expression.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     * The following special options are recognized:
     *
     * - maxlength: integer|boolean, when `maxlength` is set true and the model attribute is validated
     *   by a string validator, the `maxlength` option will take the value of [[\yii\validators\StringValidator::max]].
     *   This is available since version 2.0.3.
     *
     * @return string the generated input tag
     */
    public static function activeTextInput($model, $attribute, $options = [])
    {
        self::normalizeMaxLength($model, $attribute, $options);
        $options['class'] = 'input' . (isset($options['class']) ? ' ' . $options['class'] : '');
        return static::activeInput('text', $model, $attribute, $options);
    }


  /**
   * Generates a number input tag for the given model attribute.
   * This method will generate the "name" and "value" tag attributes automatically for the model attribute
   * unless they are explicitly specified in `$options`.
   * @param Model $model the model object
   * @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
   * about attribute expression.
   * @param array $options the tag options in terms of name-value pairs. These will be rendered as
   * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
   * See [[renderTagAttributes()]] for details on how attributes are being rendered.
   * The following special options are recognized:
   *
   * - maxlength: integer|boolean, when `maxlength` is set true and the model attribute is validated
   *   by a string validator, the `maxlength` option will take the value of [[\yii\validators\StringValidator::max]].
   *   This is available since version 2.0.3.
   *
   * @return string the generated input tag
   */
  public static function activeNumberInput($model, $attribute, $options = [])
  {
      self::normalizeMaxLength($model, $attribute, $options);
      $options['class'] = 'input' . (isset($options['class']) ? ' ' . $options['class'] : '');
      return static::activeInput('number', $model, $attribute, $options);
  }


    /**
     * Generates a password input tag for the given model attribute.
     * This method will generate the "name" and "value" tag attributes automatically for the model attribute
     * unless they are explicitly specified in `$options`.
     * @param Model $model the model object
     * @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
     * about attribute expression.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     * The following special options are recognized:
     *
     * - maxlength: integer|boolean, when `maxlength` is set true and the model attribute is validated
     *   by a string validator, the `maxlength` option will take the value of [[\yii\validators\StringValidator::max]].
     *   This option is available since version 2.0.6.
     *
     * @return string the generated input tag
     */
    public static function activePasswordInput($model, $attribute, $options = [])
    {
        self::normalizeMaxLength($model, $attribute, $options);
        $options['class'] = 'input' . (isset($options['class']) ? ' ' . $options['class'] : '');
        return static::activeInput('password', $model, $attribute, $options);
    }
}
