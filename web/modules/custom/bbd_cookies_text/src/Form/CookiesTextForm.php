<?php
/**
 * @file
 * Contains Drupal\bbd_cookies_text\Form\CookiesTextForm.
 */
namespace Drupal\bbd_cookies_text\Form;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class CookiesTextForm extends ConfigFormBase {

  const BBD_COOKIES_TEXT_SETTINGS = 'bbd_cookies_text_settings_form';

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'bbd_cookies_text.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return self::BBD_COOKIES_TEXT_SETTINGS;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('bbd_cookies_text.settings');
    $base_url = $GLOBALS['base_url'];
    $now = new DrupalDateTime('now');
    $date = $now->format("Y-m-d");

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#description' => $this->t('Please add API Key settings.php file. Example: $config[\'bbd_cookies_text.settings\'][\'civic_api_key\'] = \'&lt;SUPPLIED API KEY&gt;\';'),
      '#default_value' => $this->t('Please add in settings.php'),
      '#disabled' => TRUE,
    ];

    $form['product_licence'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product licence type'),
      '#description' => $this->t('Please add licence type to your settings.php file. Example: $config[\'bbd_cookies_text.settings\'][\'civic_product_type\'] = \'&lt;LICENCE TYPE&gt;\';'),
      '#default_value' => $this->t('Please add in settings.php'),
      '#disabled' => TRUE,
    ];

    $default_accept_behaviour = $config->get('accept_behaviour');
    $form['accept_behaviour'] = [
      '#title' => $this->t('Accept behaviour'),
      '#description' => $this->t('Should the "Accept" buttons accept all cookies or just the recommended cookies'),
      '#type' => 'select',
      '#options' => [
        'all' => $this->t('All'),
        'recommended' => $this->t('Recommended'),
      ],
      '#default_value' => !empty($default_accept_behaviour) ? $default_accept_behaviour : 'all',
    ];

    $default_accept_text = $config->get('accept_text');
    $form['accept_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Accept text'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The text used in "Accept cookies" button on the initial banner'),
      '#default_value' => !empty($default_accept_text) ? $default_accept_text : $this->t('Accept cookies'),
      '#required' => TRUE,
    ];

    $default_reject_text = $config->get('reject_text');
    $form['reject_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Reject text'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The text used in "Reject cookies" button on the initial banner'),
      '#default_value' => !empty($default_reject_text) ? $default_reject_text : $this->t('Reject cookies'),
      '#required' => TRUE,
    ];

    $default_settings_text = $config->get('settings_text');
    $form['settings_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Settings text'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The text used in "Settings (Cookie preferences)" button on the initial banner'),
      '#default_value' => !empty($default_settings_text) ? $default_settings_text : $this->t('Cookie preferences'),
      '#required' => TRUE,
    ];

    $default_accept_settings = $config->get('accept_settings');
    $form['accept_settings'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Accept settings text'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The text used in "Accept cookies" button on the Cookie Prerences modal popup'),
      '#default_value' => !empty($default_accept_settings) ? $default_accept_settings : $this->t('Accept all cookies'),
      '#required' => TRUE,
    ];

    $default_recommended_settings = $config->get('recommended_settings');
    $form['recommended_settings'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Accept recommended text'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The text used in "Accept recommended cookies" button on the Cookie Prerences modal popup'),
      '#default_value' => !empty($default_recommended_settings) ? $default_recommended_settings : $this->t('Accept recommended cookies'),
      '#required' => TRUE,
    ];

    $default_reject_settings = $config->get('reject_settings');
    $form['reject_settings'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Reject text'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The text used in "Reject cookies" button on the Cookie Prerences modal popup'),
      '#default_value' => !empty($default_reject_settings) ? $default_reject_settings : $this->t('Reject all cookies'),
      '#required' => TRUE,
    ];

    $default_title_value = $config->get('title');
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The title used in the Cookie "pop up" modal window'),
      '#default_value' => !empty($default_title_value) ? $default_title_value : $this->t('This site uses cookies'),
      '#required' => TRUE,
    ];

    $default_description_value = $config->get('description');
    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Intro'),
      '#description' => $this->t('The introductory text used in the Cookie "pop up" modal window'),
      '#default_value' => !empty($default_description_value) ? $default_description_value : $this->t('We use necessary cookies to make our site work. We\'d also like to set optional analytics cookies to help us improve it. We won\'t set optional cookies unless you enable them. There are no external advertisements on this site so we do not set any Advertising Cookies. Using this tool will set a cookie on your device to remember your preferences.'),
      '#required' => TRUE,
    ];

    $default_cookie_url = $config->get('cookie_url');
    $form['cookie_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cookie policy url'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The "absolute" url to the cookie page'),
      '#default_value' => !empty($default_cookie_url) ? $default_cookie_url :  $base_url . '/cookies',
      '#required' => TRUE,
    ];

    $default_cookie_policy = $config->get('cookie_policy');
    $form['cookie_policy'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cookie policy intro text'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The cookie policy intro text used in the Cookie "pop up" modal window'),
      '#default_value' => !empty($default_cookie_policy) ? $default_cookie_policy : $this->t('For more detailed information about the cookies we use, see our'),
      '#required' => TRUE,
    ];

    $default_cookie_policy_name = $config->get('cookie_policy_name');
    $form['cookie_policy_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cookie policy url name'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The cookie policy url name used for the link text of the cookie policy link in the Cookie "pop up" modal window'),
      '#default_value' => !empty($default_cookie_policy_name) ? $default_cookie_policy_name : $this->t('Cookies page'),
      '#required' => TRUE,
    ];

    $default_cookie_policy_date = $config->get('cookie_policy_date');
    $form['cookie_policy_date'] = [
      '#type' => 'date',
      '#title' => $this->t('The date that your cookie policy was last issued'),
      '#date_date_format' => 'd/m/Y',
      '#description' => $this->t('The date that your privacy policy was last issued, in the format of dd/mm/yyyy'),
      '#default_value' => !empty($default_cookie_policy_date) ? $default_cookie_policy_date : $date,
      '#required' => TRUE,
    ];

    $default_necessary_title = $config->get('necessary_title');
    $form['necessary_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Necessary cookies title'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The necessary cookies title used in the Cookie "pop up" modal window'),
      '#default_value' => !empty($default_necessary_title) ? $default_necessary_title : $this->t('Necessary Cookies'),
      '#required' => TRUE,
    ];

    $default_necessary_description = $config->get('necessary_description');
    $form['necessary_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Necessary cookies description'),
      '#description' => $this->t('The necessary cookies description used in the Cookie "pop up" modal window'),
      '#default_value' => !empty($default_necessary_description) ? $default_necessary_description : $this->t('Necessary cookies enable core functionality such as security, network management, and accessibility. You may disable these by changing your browser settings, but this may affect how the website functions.'),
      '#required' => TRUE,
    ];

    $default_third_Party_cookie_title = $config->get('third_Party_cookie_title');
    $form['third_Party_cookie_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Third party cookies title'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The third party cookies warning title used in the Cookie "pop up" modal window'),
      '#default_value' => !empty($default_third_Party_cookie_title) ? $default_third_Party_cookie_title : $this->t('Warning: Some cookies require your attention'),
      '#required' => TRUE,
    ];

    $default_third_party_cookie_summary = $config->get('third_party_cookie_summary');
    $form['third_party_cookie_summary'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Third party cookies description'),
      '#description' => $this->t('The third party cookies warning description used in the Cookie "pop up" modal window'),
      '#default_value' => !empty($default_third_party_cookie_summary) ? $default_third_party_cookie_summary : $this->t('Consent for the following cookies may not be automatically revoked. Please use the following the link(s) to find out how to opt out manually.'),
      '#required' => TRUE,
    ];

    $default_notify_title = $config->get('notify_title');
    $form['notify_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Notify bar title'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The title used on the notify bar'),
      '#default_value' => !empty($default_notify_title) ? $default_notify_title : $this->t('Your choice regarding cookies on this site'),
      '#required' => TRUE,
    ];

    $default_notify_description = $config->get('notify_description');
    $form['notify_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Notify bar title'),
      '#description' => $this->t('The description used on the notify bar'),
      '#default_value' => !empty($default_notify_description) ? $default_notify_description : $this->t('We use cookies to optimise site functionality and give you the best possible experience.'),
      '#required' => TRUE,
    ];

    $default_accessibility_alert = $config->get('accessibility_alert');
    $form['accessibility_alert'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Accessibility alert text'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The accessibility alert text used to inform those using accessible technologies'),
      '#default_value' => !empty($default_accessibility_alert) ? $default_accessibility_alert : $this->t('This site uses cookies to store information. Press accesskey C to learn more about your options.'),
      '#required' => TRUE,
    ];

    $default_necessary_cookies = $config->get('necessary_cookies');
    $form['necessary_cookies'] = [
      '#type' => 'textarea',
      '#title' => $this->t('List of necessary cookies'),
      '#description' => $this->t('Place each cookie name on a separate line'),
      '#default_value' => !empty($default_necessary_cookies) ? $default_necessary_cookies : 'SESS*',
      '#rows' => 8,
      '#required' => TRUE,
    ];

    $default_analytics_label = $config->get('analytics_label');
    $form['analytics_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Analytical cookies label'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The descriptive title assigned to the category and displayed by the module.'),
      '#default_value' => !empty($default_analytics_label) ? $default_analytics_label : $this->t('Analytical Cookies'),
      '#required' => TRUE,
    ];

    $default_analytics_description = $config->get('analytics_description');
    $form['analytics_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Analytics cookies description'),
      '#description' => $this->t('The full description assigned to the category and displayed by the module.'),
      '#default_value' => !empty($default_analytics_description) ? $default_analytics_description : $this->t('These cookies are used to collect information to analyse the traffic to our website and how visitors are using our website. For example, these cookies may track things such as how long you spend on the website or the pages you visit which helps us to understand how we can improve our website site for you. The information collected through these analytical cookies do not identify any individual visitor.'),
      '#required' => TRUE,
    ];

    $default_analytics_cookies = $config->get('analytics_cookies');
    $form['analytics_cookies'] = [
      '#type' => 'textarea',
      '#title' => $this->t('List of "optional" analytics cookies'),
      '#description' => $this->t('Place each cookie name on a separate line'),
      '#default_value' => !empty($default_analytics_cookies) ? $default_analytics_cookies : "_ga\r\n_gid\r\n_gat\r\n_ga_*\r\n_gat_*",
      '#rows' => 8,
      '#required' => TRUE,
    ];

    $default_functional_label = $config->get('functional_label');
    $form['functional_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Functional cookies label'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The descriptive title assigned to the category and displayed by the module.'),
      '#default_value' => !empty($default_functional_label) ? $default_functional_label : $this->t('Functional Cookies'),
      '#required' => TRUE,
    ];

    $default_functional_description = $config->get('functional_description');
    $form['functional_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Functional cookies description'),
      '#description' => $this->t('The full description assigned to the category and displayed by the module.'),
      '#default_value' => !empty($default_functional_description) ? $default_functional_description : $this->t('These cookies are used to provide you with a more personalized experience on our website and to remember choices you make when you use our website. These services include the ability to use the ability to change your language and whether we remember your choice to hide infomration banners. The information collected through these functional cookies do not identify any individual visitor.'),
      '#required' => TRUE,
    ];

    $default_functional_cookies = $config->get('functional_cookies');
    $form['functional_cookies'] = [
      '#type' => 'textarea',
      '#title' => $this->t('List of "optional" functional cookies'),
      '#description' => $this->t('Place each cookie name on a separate line'),
      '#default_value' => !empty($default_functional_cookies) ? $default_functional_cookies : '',
      '#required' => FALSE,
    ];


    $default_third_party_label = $config->get('third_party_label');
    $form['third_party_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Third Party cookies label'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The descriptive title assigned to the category and displayed by the module.'),
      '#default_value' => !empty($default_third_party_label) ? $default_third_party_label : $this->t('Third Party Cookies'),
      '#required' => TRUE,
    ];

    $default_third_party_description = $config->get('third_party_description');
    $form['third_party_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Third Party cookies description'),
      '#description' => $this->t('The full description assigned to the category and displayed by the module.'),
      '#default_value' => !empty($default_third_party_description) ? $default_third_party_description : $this->t('We use a number of Third Party services to provide an enhanced user experience. These services include third party content, such as videos from Youtube.'),
      '#required' => TRUE,
    ];

    $default_third_party_cookies = $config->get('third_party_cookies');
    $form['third_party_cookies'] = [
      '#type' => 'textarea',
      '#title' => $this->t('List of "optional" third party cookies'),
      '#description' => $this->t('Place each cookie name on a separate line'),
      '#default_value' => !empty($default_third_party_cookies) ? $default_third_party_cookies : '',
      '#required' => FALSE,
    ];

    $default_embed_value = $config->get('embed_cookies_text');
    $form['embed_cookies_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First line of cookie message for Third Party Embed content'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The first line of the message that is displayed when a visitor hasn\'t accepted third party cookies'),
      '#default_value' => !empty($default_embed_value) ? $default_embed_value : $this->t('We\'re sorry, this feature can place cookies in your browser and has been disabled.'),
      '#required' => TRUE,
    ];

    $default_video_value = $config->get('video_cookies_text');
    $form['video_cookies_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First line of cookie message for Third Party Video content'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The first line of the message that is displayed when a visitor hasn\'t accepted third party cookies'),
      '#default_value' => !empty($default_video_value) ? $default_video_value : $this->t('We\'re sorry, this video can place cookies in your browser and has been disabled.'),
      '#required' => TRUE,
    ];

    $default_feature_value = $config->get('feature_cookies_text');
    $form['feature_cookies_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Second line of cookie message for Third Party Video and Embed content'),
      '#size' => 120,
      '#maxlength' => 255,
      '#description' => $this->t('The second line of the message that is displayed when a visitor hasn\'t accepted third party cookies, use [link] to indicate where link text should occur'),
      '#default_value' => !empty($default_feature_value) ? $default_feature_value : $this->t('To continue using this functionality, please [link] and accept \'Third Party Cookies\'.'),
      '#required' => TRUE,
    ];

    $default_link_value = $config->get('link_cookies_text');
    $form['link_cookies_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('The link text for cookie message for Third Party Video and Embed content'),
      '#size' => 120,
      '#maxlength' => 128,
      '#description' => $this->t('The link text for the message that is displayed when a visitor hasn\'t accepted third party cookies, use [link] to indicate where link text should occur'),
      '#default_value' => !empty($default_link_value) ? $default_link_value : $this->t('open cookie preferences'),
      '#required' => TRUE,
    ];

    $default_button_value = $config->get('button_cookies_text');
    $form['button_cookies_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('The button text for cookie message for Third Party Video and Embed content'),
      '#size' => 120,
      '#maxlength' => 128,
      '#description' => $this->t('The button text for the message that is displayed when a visitor hasn\'t accepted third party cookies, use [link] to indicate where link text should occur'),
      '#default_value' => !empty($default_button_value) ? $default_button_value : $this->t('Open cookie preferences'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $text = $form_state->getValue('feature_cookies_text');
    if (substr_count($text, '[link]') > 1 ) {
      $form_state->setErrorByName('feature_cookies_text', $this->t('Please include only one occurance of [link] in this text.'));
    }
    if (substr_count($text, '[link]') == 0 ) {
      $form_state->setErrorByName('feature_cookies_text', $this->t('You must include [link] in this text to indicate where the link to the cookie preferences should be'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('bbd_cookies_text.settings')
      ->set('civic_api_key', $form_state->getValue('civic_api_key'))
      ->set('civic_product_type', $form_state->getValue('civic_product_type'))
      ->set('title', $form_state->getValue('title'))
      ->set('description', $form_state->getValue('description'))
      ->set('cookie_url', $form_state->getValue('cookie_url'))
      ->set('cookie_policy', $form_state->getValue('cookie_policy'))
      ->set('cookie_policy_name', $form_state->getValue('cookie_policy_name'))
      ->set('cookie_policy_date', $form_state->getValue('cookie_policy_date'))
      ->set('accept_behaviour', $form_state->getValue('accept_behaviour'))
      ->set('accept_text', $form_state->getValue('accept_text'))
      ->set('reject_text', $form_state->getValue('reject_text'))
      ->set('settings_text', $form_state->getValue('settings_text'))
      ->set('necessary_title', $form_state->getValue('necessary_title'))
      ->set('accept_settings', $form_state->getValue('accept_settings'))
      ->set('recommended_settings', $form_state->getValue('recommended_settings'))
      ->set('reject_settings', $form_state->getValue('reject_settings'))
      ->set('necessary_description', $form_state->getValue('necessary_description'))
      ->set('third_Party_cookie_title', $form_state->getValue('third_Party_cookie_title'))
      ->set('third_party_cookie_summary', $form_state->getValue('third_party_cookie_summary'))
      ->set('notify_title', $form_state->getValue('notify_title'))
      ->set('notify_description', $form_state->getValue('notify_description'))
      ->set('accessibility_alert', $form_state->getValue('accessibility_alert'))
      ->set('necessary_cookies', $form_state->getValue('necessary_cookies'))
      ->set('analytics_label', $form_state->getValue('analytics_label'))
      ->set('analytics_description', $form_state->getValue('analytics_description'))
      ->set('analytics_cookies', $form_state->getValue('analytics_cookies'))
      ->set('functional_label', $form_state->getValue('functional_label'))
      ->set('functional_description', $form_state->getValue('functional_description'))
      ->set('functional_cookies', $form_state->getValue('functional_cookies'))
      ->set('third_party_label', $form_state->getValue('third_party_label'))
      ->set('third_party_description', $form_state->getValue('third_party_description'))
      ->set('third_party_cookies', $form_state->getValue('third_party_cookies'))
      ->set('embed_cookies_text', $form_state->getValue('embed_cookies_text'))
      ->set('video_cookies_text', $form_state->getValue('video_cookies_text'))
      ->set('feature_cookies_text', $form_state->getValue('feature_cookies_text'))
      ->set('link_cookies_text', $form_state->getValue('link_cookies_text'))
      ->set('button_cookies_text', $form_state->getValue('button_cookies_text'))
      ->save();
  }

}
