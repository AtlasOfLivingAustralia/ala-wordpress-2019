
// Take a cookie
const getCookie = (name) => {
  const match = document.cookie.match(new RegExp(`(^| )${name}=([^;]+)`));

  if (match) {
    return match[2];
  }

  return false;
};

($ => {

$(document).ready(($) => {

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('.site').toggleClass('offcanvas-open');
  });


  // Hero Banner
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

    const swiper = new Swiper;

    console.log(swiper);
  });

  /**
  // Get user experience group cookie.
  const experience = getCookie('experience');
  const experienceModal = $('#experience-modal');
  const experienceReveal = new Foundation.Reveal(experienceModal);

  let settingExperienceCookie = false;

  const revealExperiencePopup = () => {
    experienceReveal.open();

    experienceModal.on('click.close', '[data-close]', () => {
      experienceReveal.close();
      experienceModal.on('click.close');
    });
  };

  // If the experience cookie has not been set, show the popup after a delay.
  if (experience === false) {
    setTimeout(() => {
      revealExperiencePopup();
    }, 5000);
  }

  $(document).on('click', '.experience-group-change', revealExperiencePopup);

  // Group description hovers.
  // This needs to be aided with JavaScript for z-index reasons.
  experienceModal.on('mouseover touchstart', '.experience-group .group-btn', (e) => {
    const group = $(e.currentTarget).closest('.experience-group');

    group.addClass('hover');

    setTimeout(() => {
      group.addClass('anim');
    }, 50);
  }).on('mouseout touchend', '.experience-group .group-btn', (e) => {
    const group = $(e.currentTarget).closest('.experience-group');

    group.removeClass('anim');

    setTimeout(() => {
      group.removeClass('hover');
    }, 200);
  });

  experienceModal.on('click', '.group-btn, [data-close]', (e) => {
    e.preventDefault();

    if (settingExperienceCookie) {
      return false;
    }

    const button = $(e.currentTarget);
    const group = button.data('name');

    $.ajax({
      url: window.pvtl.ajax_url,
      method: 'POST',
      data: {
        action: 'set_experience_cookie',
        group,
      },
      beforeSend: () => {
        console.log('Loading...');
        settingExperienceCookie = true;
        button.addClass('loading');
      },
      success: (data) => {
        console.log('Success...', data);
      },
      error: () => {
        console.log('Failed...');
      },
      complete: () => {
        if (group !== 'null') {
          window.location.reload();
        }
      },
  });

    return false;
  });

**/

});

})(jQuery);
