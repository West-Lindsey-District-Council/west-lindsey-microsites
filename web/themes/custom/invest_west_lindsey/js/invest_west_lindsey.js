/**
 * @file
 * Big Blue Door Theme JS functionality.
 */
(function ($, Drupal, drupalSettings) {
  'use strict';

  Drupal.behaviors.investwestlindsey = {
    
    /**
     * Attach method for this behavior.
     *
     * @param context
     *   The context for which the behavior is being executed. This is either
     *   the full page or a piece of HTML that was just added through Ajax.
     * @param settings
     *   An array of settings (added through drupal_add_js()). Instead of
     *   accessing Drupal.settings directly you should use this because of
     *   potential modifications made by the Ajax callback that also produced
     *   'context'.
     */
    attach: function (context, settings) {
      var self = this;
      var body = $('body');

      // This needs to define touch devices
      var isTouch = (('ontouchstart' in window)
      || (navigator.maxTouchPoints > 0)
      || (navigator.msMaxTouchPoints > 0));

      var greatThanMobileWidth = $(window).width() > 767 ? true : false;

      if ($('article.node', context).hasClass('investwl-area--none')) {
        $('body', context).addClass('investwl-area--none');
      }
      if ($('article.node', context).hasClass('investwl-area--our_offer')) {
        $('body', context).addClass('investwl-area--our_offer');
      }
      if ($('article.node', context).hasClass('investwl-area--our_district')) {
        $('body', context).addClass('investwl-area--our_district');
      }
      if ($('article.node', context).hasClass('investwl-area--our_ambition')) {
        $('body', context).addClass('investwl-area--our_ambition');
      }
    },
  };
  
})(jQuery, Drupal, drupalSettings);