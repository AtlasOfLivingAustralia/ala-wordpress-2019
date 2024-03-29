($ => {
  $(document).ready(($) => {

    function readCookie(name) {
        var nameEQ = encodeURIComponent(name) + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ')
                c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0)
                return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    /**
     * Display login/logout buttons (ES6)
     */
    var alaJSAuthCookieName='ALA-js-auth';
    var alaJSAuthCookieValue = readCookie(alaJSAuthCookieName);
    // console.log('Cookie '+alaJSAuthCookieName+' cookie has value '+alaJSAuthCookieValue);
    if (alaJSAuthCookieValue == 'loggedin'){
      $('.ala-auth-buttons-logged-in').removeClass("d-none");
      $('.ala-auth-buttons-logged-out').addClass("d-none");
    } else {
      $('.ala-auth-buttons-logged-in').addClass("d-none");
      $('.ala-auth-buttons-logged-out').removeClass("d-none");
    }

    /**
     * Mobile (off-canvas) menu
     */
    $('[data-toggle="offcanvas"]').on('click', function () {
      $('.site').toggleClass('offcanvas-open');
    });


    /**
     * Hero Banner
     */
    $('.swiper-container').each((index, el) => {
      $(el).addClass(`swiper-${index}`);

      const thisSwiper = new Swiper(`.swiper-${index}`, {
        slidesPerView: 1,
        spaceBetween: 0,
        effect: "fade",
        centeredSlides: true,
        fadeEffect: { 
          crossFade: true
        },
        preventClicks: false,
        lazyPreloadPrevNext: 1,
        navigation: false,
        loop: true,
        speed: 2000,
        autoplay: {
          delay: 7500,
          disableOnInteraction: false,
        }
      });
    });

    /**
    * Search / autocomplete
    */

    // autocomplete for search inputs
    var autocompleteBIEoptions = {
      url: function(phrase) {
        return "https://bie-ws.ala.org.au/ws/search/auto.json?q=" + phrase;
      },
      getValue: "matchedNames",
      requestDelay: 300,
      adjustWidth: false,
      minCharNumber: 3,
      listLocation: "autoCompleteList",
      list: {
        maxNumberOfElements: 10
      }
    };
    $('.autocompleteBIE').easyAutocomplete(autocompleteBIEoptions);

    var autocompleteHomeoptions = {
      url: function(phrase) {
        return "https://bie-ws.ala.org.au/ws/search/auto.json?q=" + phrase;
      },
      getValue: "matchedNames",
      requestDelay: 300,
      adjustWidth: false,
      minCharNumber: 3,
      listLocation: "autoCompleteList",
      list: {
        maxNumberOfElements: 4
      }
    };
    $('.autocompleteHome').easyAutocomplete(autocompleteHomeoptions);


    $('#autocompleteSearchALA').on('shown.bs.collapse', function () {
      // focus on search input
      $('#autocompleteSearchALA input').focus();
    })

    /**
     * Support (knowledge base) links to open new tab/window
     */
    // $('a').each(function(index, el) {
    //   var supportURL = 'https://support.ala.org.au/support/home';
    //   if($(el).is("[href*=" + supportURL + "]")){
    //       $(el).attr('target','_blank');
    //   }
    // });

    /**
     * Featured Box
     */
    $('.featured-swiper').each(function (index, el) {
      $(el).addClass(`featured-${index}`);

      let featuredSwiper = undefined;

      function initFeaturedSwiper() {
        var screenWidth = $(window).width();
        //if(screenWidth < 992 && featuredSwiper == undefined) {
          featuredSwiper = new Swiper(`.featured-${index}`, {
            loop: false,
            slidesPerView: auto,
            spaceBetween: 10,
            speed: 1000,
            autoplay: false,
            preventClicks: false,
            effect: 'slide',
            preloadImages: false,
            lazy: {
              loadPrevNext: true,
            },
            navigation: false,
            // Responsive breakpoints
            breakpoints: {
              // when window width is <= 
              992: {
                slidesPerView: 1
              }
            }
          });
       // } else if (screenWidth > 991 && featuredSwiper != undefined) {
          //featuredSwiper.destroy();
          //featuredSwiper = undefined;
          //jQuery(el).find('.swiper-wrapper').removeAttr('style');
          //jQuery(el).find('.swiper-slide').removeAttr('style');
        //}
      }

      //Swiper plugin initialization
      initFeaturedSwiper();

      //Swiper plugin initialization on window resize
      $(window).on('resize', function(){
        initFeaturedSwiper();
      });
    });


    /**
     * Tooltips
     */
    $('[data-toggle="tooltip"]').tooltip();


    /**
     * Tabs / URLs
     */

    $('a[data-toggle="tab"]').click(function(e) {
      // on click: mouse/kb selection of tab
      var id = $(this).attr('id');
      var tabLabel = $(this).text();
      //console.log("tab click: "+id+" label: "+tabLabel);
      // set cookie to remember tab
      //console.log("setting alaTab cookie with: "+id);
      var cookieMaxAge = 60*60*24*365;
      document.cookie = "alaTab="+id+";max-age="+cookieMaxAge;
      if (typeof ga != "undefined") {
        console.log("sending GA event: Home tab click "+tabLabel);
        ga('send', {
          hitType: 'event',
          eventCategory: 'Home tabs',
          eventAction: 'tab click',
          eventLabel: tabLabel
        });
      }
    });

    // home page: tab display
    if ($("body.home .nav-tabs").length) {
      // catch hash URIs and trigger tabs
      const cookieTab = readCookie('alaTab');
      // if a cookie is set, display that tab
      if (cookieTab) {
        //console.log("showing tab based on alaTab cookie: "+cookieTab);
        $('.nav-tabs a[id="' + cookieTab + '"]').tab('show');
      }
      else if (location.hash !== '') {
        // no cookie set - if there is a tab_ value in the hash, display that tab
        $('.nav-tabs a[href="' + location.hash.replace('tab_','') + '"]').tab('show');
        //$('.nav-tabs li a[href="' + location.hash.replace('tab_','') + '"]').click();
      } else {
        $('.nav-tabs a:first').tab('show');
      }
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
      // on shown: after non-default tab is displayed, either from click/kb or URL# load
      var id = $(this).attr('id');
      var tabLabel = $(this).text();
      //console.log("tab shown: "+id+" label: "+tabLabel);
      location.hash = 'tab_'+ $(e.target).attr('href').substr(1);
      if (typeof ga != "undefined") {
        console.log("sending GA event: Home tab shown "+tabLabel);
        ga('send', {
          hitType: 'event',
          eventCategory: 'Home tabs',
          eventAction: 'tab shown',
          eventLabel: tabLabel
        });
      }
    });


    $('[data-sticky]').stickybits({
      useStickyClasses: true,
      stickyBitStickyOffset: 20
    });

    if($('#anchorList').length) {
      $('body').scrollspy({ target: '#anchorList' });
    }

    // filter handling for a /dir/ OR /indexordefault.page
    function filterPath(string) {
      return string
        .replace(/^\//, '')
        .replace(/(index|default).[a-zA-Z]{3,4}$/, '')
        .replace(/\/$/, '');
    }

    const locationPath = filterPath(location.pathname);
    $('a[href*="#"]').not('[data-toggle]').each(function () {
      const thisPath = filterPath(this.pathname) || locationPath;
      const hash = this.hash;
      if ($("#" + hash.replace(/#/, '')).length) {
        if (locationPath == thisPath && (location.hostname == this.hostname || !this.hostname) && this.hash.replace(/#/, '')) {
          const $target = $(hash), target = this.hash;
          if (target) {
            $(this).click(function (event) {
              event.preventDefault();
              $('html, body').animate({scrollTop: $target.offset().top}, 1000, function () {
                location.hash = target;
                $target.focus();
                if ($target.is(":focus")){ //checking if the target was focused
                  return false;
                }else{
                  $target.attr('tabindex','-1'); //Adding tabindex for elements not focusable
                  $target.focus(); //Setting focus
                }
              });
            });
          }
        }
      }
    });

  });

  //Collapse tabs if opened on mobile
  const collapseTabs = () => {
    if($(window).outerWidth() < 768) {
      $('.tab-box').find('[aria-expanded=true]').click();
    }
  };

  collapseTabs();


  // update ALA stats
  const getLatestStats = () => {
    if ($(".ala-home-stats").length) {
      var statsUrl = "https://dashboard.ala.org.au/dashboard/homePageStats";
      $.getJSON(statsUrl, function(data) {
        //console.log("retrieved occurrences total: " + data.recordCounts.count);
        //console.log("retrieved datasets total: " + data.datasetCounts.count);
        $("#alaOccurrencesTotal").attr('data-count',data.recordCounts.count);
        $("#alaDatasetsTotal").attr('data-count',data.datasetCounts.count);
        updateStats($("#alaOccurrencesTotal"));
        updateStats($("#alaDatasetsTotal"));
      });
    }
  };

  getLatestStats();

  //Count up to data-count num
  function updateStats(countElement) {
    const $this = countElement,
      countTo = $this.attr('data-count');

    $this.html('0');

    $({countNum: $this.text()}).animate({
        countNum: countTo
      },

      {

        duration: 1000,
        easing: 'linear',
        step: function () {
          const countNumFloor = Math.floor(this.countNum);
          $this.text(countNumFloor.toLocaleString());
        },
        complete: function () {
          $this.text(this.countNum.toLocaleString());
        }

      }
    );
  }

  // end document.ready
})(jQuery);
