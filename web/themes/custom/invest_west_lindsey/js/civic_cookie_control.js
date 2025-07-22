(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.CivicCookieControlBehavior = {
    attach: function (context, settings) {
      if (drupalSettings.bbd_cookies_text.civic_api_key != '' && drupalSettings.bbd_cookies_text.civic_api_key != 'Please supply key in settings.php'
      && drupalSettings.bbd_cookies_text.civic_product_type != '' && drupalSettings.bbd_cookies_text.civic_product_type != 'Please supply product type in settings.php') {
        const necessary_cookies = (drupalSettings.bbd_cookies_text.necessary_cookies !== '') ? "'" + drupalSettings.bbd_cookies_text.necessary_cookies.replace(/(?:\r\n|\r|\n)/g, "', '") + "'" : '';
        const analytics_cookies = (drupalSettings.bbd_cookies_text.analytics_cookies !== '') ? "'" + drupalSettings.bbd_cookies_text.analytics_cookies.replace(/(?:\r\n|\r|\n)/g, "', '") + "'" : '';
        const functional_cookies = (drupalSettings.bbd_cookies_text.functional_cookies !== '') ? "'" + drupalSettings.bbd_cookies_text.functional_cookies.replace(/(?:\r\n|\r|\n)/g, "', '") + "'" : '';
        const third_party_cookies = (drupalSettings.bbd_cookies_text.third_party_cookies !== '') ? "'" + drupalSettings.bbd_cookies_text.third_party_cookies.replace(/(?:\r\n|\r|\n)/g, "', '") + "'" : '';
        var loggedIn = $('#toolbar-administration', context).length;
        var config = {
          acceptBehaviour:  drupalSettings.bbd_cookies_text.accept_behaviour,
          apiKey: drupalSettings.bbd_cookies_text.civic_api_key,
          product: drupalSettings.bbd_cookies_text.civic_product_type,
          logConsent: true,
          notifyOnce: false,
          initialState: 'notify',
          position: 'left',
          theme: 'light',
          layout: 'popup',
          toggleType: 'slider',
          iabCMP: false,
          closeStyle: 'button',
          consentCookieExpiry: 180,
          subDomains :  false,
          sameSiteCookie : true,
          sameSiteValue : 'strict',
          rejectButton: true,
          settingsStyle : 'button',
          encodeCookie : true,
          notifyDismissButton : false,
          accessibility: {
            accessKey: 'C',
            highlightFocus: true,
            outline: true
          },
          setInnerHTML: true,
          text: {
            title: drupalSettings.bbd_cookies_text.title,
            intro: drupalSettings.bbd_cookies_text.description.replace(/(?:\r\n|\r|\n)/g, '<br>'),
            acceptRecommended: drupalSettings.bbd_cookies_text.recommended_settings,
            accept: drupalSettings.bbd_cookies_text.accept_text,
            reject: drupalSettings.bbd_cookies_text.reject_text,
            acceptSettings: drupalSettings.bbd_cookies_text.accept_settings,
            rejectSettings: drupalSettings.bbd_cookies_text.reject_settings,
            necessaryTitle: drupalSettings.bbd_cookies_text.necessary_title,
            necessaryDescription: drupalSettings.bbd_cookies_text.necessary_description.replace(/(?:\r\n|\r|\n)/g, '<br>'),
            thirdPartyTitle: drupalSettings.bbd_cookies_text.third_Party_cookie_title,
            thirdPartyDescription: drupalSettings.bbd_cookies_text.third_Party_cookie_summary,
            on: Drupal.t('On'),
            off: Drupal.t('Off'),
            settings: drupalSettings.bbd_cookies_text.settings_text,
            notifyTitle: drupalSettings.bbd_cookies_text.notify_title,
            notifyDescription: drupalSettings.bbd_cookies_text.notify_description.replace(/(?:\r\n|\r|\n)/g, '<br>'),
            closeLabel: Drupal.t('Save and close'),
            accessibilityAlert: drupalSettings.bbd_cookies_text.accessibility_alert,
          },
          // branding: {
          //   fontColor: '#fff',
          //   fontFamily: 'Arial,sans-serif',
          //   fontSizeTitle: '1.4em',
          //   fontSizeHeaders: '1.2em',
          //   fontSize: '1em',
          //   backgroundColor: '#313147',
          //   toggleText: '#fff',
          //   toggleColor: '#2f2f5f',
          //   toggleBackground: '#111125',
          //   alertText: '#fff',
          //   alertBackground: '#111125',
          //   buttonIcon: null,
          //   buttonIconWidth: '64px',
          //   buttonIconHeight: '64px',
          //   removeIcon: false,
          //   removeAbout: true
          // },
          necessaryCookies: [ necessary_cookies ],
          optionalCookies: [
            {
              name: 'analytics',
              label: drupalSettings.bbd_cookies_text.analytics_label,
              description: drupalSettings.bbd_cookies_text.analytics_description.replace(/(?:\r\n|\r|\n)/g, '<br>'),
              cookies: [ analytics_cookies ],
              onAccept: function () {
                if (!loggedIn) {
                  $('.cookies-anayltics-allowed').show();
                  $('.no-cookies-anayltics-allowed').hide();
                  // Enable Analytics Cookies in GTM
                  // dataLayer.push({
                  //   'event' : 'analytics_consented',
                  //   'cookies_analytics' : true
                  // });
                  // gtag('consent', 'update', {'analytics_storage': 'granted'});
                };
              },
              onRevoke: function () {
                $('.cookies-anayltics-allowed').hide();
                $('.no-cookies-anayltics-allowed').css('display', 'flex');
                // Disabled Analytics Cookies in GTM
                // dataLayer.push({
                //   'event' : 'analytics_revoked',
                //   'cookies_analytics' : false
                // });
                // gtag('consent', 'update', {'analytics_storage': 'denied'});
              },
              recommendedState: 'on',
              lawfulBasis: 'consent',
            },
            {
              name: 'functional',
              label: drupalSettings.bbd_cookies_text.functional_label,
              description: drupalSettings.bbd_cookies_text.functional_description.replace(/(?:\r\n|\r|\n)/g, '<br>'),
              cookies: [ functional_cookies ],
              onAccept: function () {
                // Show Google Translate
                $('.gtranslate_wrapper').show();
                $('.cookies-functional-allowed').show();
                $('.no-cookies-functional-allowed').hide();
                // Enable Functional Cookies in GTM
                // dataLayer.push({
                //   'event' : 'functional_consented',
                //   'cookies_functional' : true
                // });
                // gtag('consent', 'update', {'functionality_storage': 'granted'});
              },
              onRevoke: function () {
                // hide Google Translate
                $('.gtranslate_wrapper').hide();
                $('.cookies-functional-allowed').hide();
                $('.no-cookies-functional-allowed').css('display', 'flex');
                // Disable Functional Cookies in GTM.
                // dataLayer.push({
                //   'event' : 'functional_revoked',
                //   'cookies_functional' : false
                // });
                // gtag('consent', 'update', {'functionality_storage': 'denied'});
                // remove Google Translate cookie.
                CookieControl.delete("googtrans");
                // If Genesys chat bot is loaded clear all message history and reload page.
                if (typeof Genesys === "function") {
                  Genesys("command", "Messenger.clear");
                  location.reload(true);
                }
              },
              recommendedState: 'on',
              lawfulBasis: 'consent',
            },
            {
              name: 'third_party',
              label: drupalSettings.bbd_cookies_text.third_party_label,
              description: drupalSettings.bbd_cookies_text.third_party_description.replace(/(?:\r\n|\r|\n)/g, '<br>'),
              cookies: [ third_party_cookies ],
              onAccept: function () {
                $('.cookies-thirdparty-allowed').show();
                $('.no-cookies-thirdparty-allowed').hide();
                // Enable Third Party Cookies in GTM
                // dataLayer.push({
                //   'event' : 'thirdparty_consented',
                //   'cookies_thirdparty' : true
                // });
              },
              onRevoke: function () {
                $('.cookies-thirdparty-allowed').hide();
                $('.no-cookies-thirdparty-allowed').css('display', 'flex');
                // Enable Third Party Cookies in GTM
                dataLayer.push({
                  'event' : 'thirdparty_revoked',
                  'cookies_thirdparty' : false
                });
              },
              thirdPartyCookies: [
                {"name": "Youtube", "optOutLink": "https://policies.google.com/technologies/cookies"},
                {"name": "Local Rewards", "optOutLink": "https://www.localrewards.chat/terms"}
              ],
              recommendedState: 'on',
              lawfulBasis: 'consent',
            },
          ],
          statement: {
            description: drupalSettings.bbd_cookies_text.cookie_policy,
            name: drupalSettings.bbd_cookies_text.cookie_policy_name,
            url: drupalSettings.bbd_cookies_text.cookie_url,
            updated: drupalSettings.bbd_cookies_text.cookie_policy_date
          },
        };

        $(document).ready(function(){
          var loops = 0;
          var threshold = 30;
          function CookieControlInit() {
            // function to put Cookie Control before content so that tabbing away from it takes you to the
            // Skip Links content before anything else, it loops for a max of 30 times to give time for Cookie Control to load
            if (typeof CookieControl !== "undefined" && window.jQuery && $('#ccc').length > 0) {
              if ($('.skip-link').length > 0) {
                $('#ccc').insertBefore($('.skip-link'));
                $('#ccc').css('z-index', 10);
                $('#ccc-notify .ccc-notify-text h3').replaceWith(function() {
                  return $('p', this);
                });
              }
            }
            else {
              if (loops++ < threshold) {
                setTimeout(CookieControlInit, 300);
              }
            }
          }

          CookieControl.load(config);
          CookieControlInit();
          $('.cookie-control-icon, .cookie-control-link').on('click', function(e){
            e.preventDefault();
            CookieControl.open();
          });
        });
      }
    }
  };
})(jQuery, Drupal, drupalSettings);
