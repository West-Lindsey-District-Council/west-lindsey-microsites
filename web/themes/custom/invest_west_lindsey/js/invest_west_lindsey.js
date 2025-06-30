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


  Drupal.behaviors.owl = {
    attach: function attach(context) {
      $(window).on('load', function() {

        const $galleryParagraphs = $('.full__banner', context);

        if (!$galleryParagraphs.length) {
          return false;
        }

        $galleryParagraphs.each(function() {
          const $gallery = $(this);
          const bigimage = $('.owl-big', $gallery);
          // const thumbs = $('.owl-thumb', $gallery);
          const syncedSecondary = true;

          bigimage
            .owlCarousel({
              items: 1,
              stagePadding: 0,
              singleItem: true,
              slideBy: 1,
              animateOut: 'fadeOut',
              smartSpeed: 450,
              slideSpeed: 2000,
              nav: true,
              autoplay: true,
              dots: true,
              loop: true,
              margin: 0,
              responsiveRefreshRate: 200,
              navElement: 'button type="button"',
              navText: [
                '<span class="fa fa-2x fa-chevron-left" aria-hidden="true"></span><span class="visually-hidden">' + Drupal.t('Previous') + '</span>',
                '<span class="visually-hidden">' + Drupal.t('Next') + '</span><span class="fa fa-2x fa-chevron-right" aria-hidden="true"></span>'
              ]
            })
            .on('changed.owl.carousel', syncPosition);          ;
          // if (thumbs) {
          //   thumbs
          //     .on('initialized.owl.carousel', function() {
          //       $('.owl-control button').show();
          //       thumbs
          //         .find('.owl-item')
          //         .eq(0)
          //         .addClass('current');
          //     })
          //     .owlCarousel({
          //       items: 4,
          //       dots: false,
          //       nav: true,
          //       navElement: 'button type="button"',
          //       navText: [
          //         '<span class="fa fa-2x fa-chevron-left" aria-hidden="true"></span><span class="visually-hidden">' + Drupal.t('Previous') + '</span>',
          //         '<span class="visually-hidden">' + Drupal.t('Next') + '</span><span class="fa fa-2x fa-chevron-right" aria-hidden="true"></span>'
          //       ],
          //       smartSpeed: 200,
          //       slideSpeed: 500,
          //       slideBy: 4,
          //       responsiveRefreshRate: 100,
          //       margin: 5
          //     })
          //     .on('changed.owl.carousel', syncPosition2);
          //   };

          function syncPosition(el) {
            //if loop is set to false, then you have to uncomment the next line
            //var current = el.item.index;

            //to disable loop, comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

            if (current < 0) {
              current = count;
            }
            if (current > count) {
              current = 0;
            }
            //to this
            // if (thumbs) {
            //   thumbs
            //     .find('.owl-item')
            //     .removeClass('current')
            //     .eq(current)
            //     .addClass('current');
            //   var onscreen = thumbs.find('.owl-item.active').length - 1;
            //   var start = thumbs
            //     .find('.owl-item.active')
            //     .first()
            //     .index();
            //   var end = thumbs
            //     .find('.owl-item.active')
            //     .last()
            //     .index();

            //   if (current > end) {
            //     thumbs.data('owl.carousel').to(current, 100, true);
            //   }
            //   if (current < start) {
            //     thumbs.data('owl.carousel').to(current - onscreen, 100, true);
            //   }
            // }
          }

          function syncPosition2(el) {
            if (syncedSecondary) {
              var number = el.item.index;
              bigimage.data('owl.carousel').to(number, 100, true);
            }
          }

          // thumbs.on('click', '.owl-item', function(e) {
          //   e.preventDefault();
          //   var number = $(this).index();
          //   bigimage.data('owl.carousel').to(number, 300, true);
          // });

          $('.play', $gallery).on('click', function() {
            bigimage.trigger('play.owl.autoplay');
          });

          $('.pause', $gallery).on('click', function() {
            bigimage.trigger('stop.owl.autoplay');
          });

          bigimage.trigger('refresh.owl.carousel')
          // thumbs.trigger('refresh.owl.carousel')
        })
      })
    }
  }

})(jQuery, Drupal, drupalSettings);
