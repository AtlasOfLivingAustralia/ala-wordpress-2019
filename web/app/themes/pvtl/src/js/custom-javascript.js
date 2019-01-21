($ => {
  $(document).ready(($) => {
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

      new Swiper(`.swiper-${index}`, {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 0,
        speed: 1000,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
        preventClicks: false,
        effect: 'fade',
        preloadImages: false,
        lazy: {
          loadPrevNext: true,
        },
        navigation: false,
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
        },
      });
    });


    /**
     * Tooltips
     */
    $('[data-toggle="tooltip"]').tooltip();


    /**
     * Get/Set user experience group cookie
     */
    () => {
      let settingExperienceCookie = false;
      const experience = getCookie('experience');
      const experienceModal = $('#experience-modal');

      // If the experience cookie has not been set, show the popup after a delay.
      if (experience === false) {
        setTimeout(() => experienceModal.modal('show'), 5000);
      }

      // Change the experience group
      experienceModal.on('click', '.group-btn', (e) => {
        e.preventDefault();

        // Don't proceed if 'in progress'
        if (settingExperienceCookie) return false;

        const button = $(e.currentTarget);
        const group = button.data('name');

        $.ajax({
          url: wp_ajax_object.ajax_url,
          method: 'POST',
          data: { action: 'set_experience_cookie', group },
          beforeSend: () => {
            settingExperienceCookie = true;
          },
          complete: () => {
            if (group !== 'null') window.location.reload();
          },
        });

        return false;
      });
    });
  }
})(jQuery);

/**
 * Return cookie if there's a match
 * @param str name
 * @return cookie|false
 */
const getCookie = (name) => {
  const match = document.cookie.match(new RegExp(`(^| )${name}=([^;]+)`));
  return (match) ? match[2] : false;
};
