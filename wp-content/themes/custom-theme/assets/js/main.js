document.addEventListener("DOMContentLoaded", function () {
  initMobileMenu();
  initMobileSubmenus();
  initHeroSwiper();
  initNewsSwiper();
  initStickyHeader();
  initVideoModals();
});

function initMobileMenu() {
  const toggle = document.querySelector(".mobile-menu-toggle");
  const closeBtn = document.querySelector(".mobile-menu-close");
  const panel = document.querySelector(".mobile-nav-panel");
  const overlay = document.querySelector(".mobile-nav-overlay");

  if (!toggle || !panel || !overlay || !closeBtn) {
    return;
  }

  const openMenu = () => {
    panel.classList.add("is-open");
    overlay.classList.add("is-open");
    panel.setAttribute("aria-hidden", "false");
    toggle.setAttribute("aria-expanded", "true");
    document.body.style.overflow = "hidden";
  };

  const closeMenu = () => {
    panel.classList.remove("is-open");
    overlay.classList.remove("is-open");
    panel.setAttribute("aria-hidden", "true");
    toggle.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
  };

  toggle.addEventListener("click", openMenu);
  closeBtn.addEventListener("click", closeMenu);
  overlay.addEventListener("click", closeMenu);

  panel.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", closeMenu);
  });
}

function initMobileSubmenus() {
  document.querySelectorAll(".psm-mobile-menu .menu-item-has-children").forEach((item) => {
    const toggle = item.querySelector(":scope > .psm-mobile-menu__row > .psm-mobile-submenu-toggle");
    if (!toggle) {
      return;
    }

    toggle.addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();

      const isOpen = item.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
  });
}

function initHeroSwiper() {
  const root = document.querySelector(".psm-hero-swiper");
  const pager = document.querySelector(".psm-hero__pager");

  if (!root || root.swiper || typeof Swiper === "undefined") {
    return;
  }

  const slideCount = root.querySelectorAll(".swiper-slide").length;
  if (slideCount < 1) {
    return;
  }

  const swiper = new Swiper(root, {
    slidesPerView: 1,
    loop: slideCount > 1,
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    speed: 900,
    autoplay:
      slideCount > 1
        ? {
            delay: 6000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          }
        : false,
    allowTouchMove: slideCount > 1,
    watchOverflow: true,
    observer: true,
    observeParents: true,
    on: {
      init(swiperInstance) {
        bindHeroPager(swiperInstance, pager);
        updateHeroPager(swiperInstance, pager);
        updateHeroSlideA11y(swiperInstance);
        if (swiperInstance.autoplay) {
          swiperInstance.autoplay.start();
        }
      },
      slideChange(swiperInstance) {
        updateHeroPager(swiperInstance, pager);
        updateHeroSlideA11y(swiperInstance);
      },
    },
  });

}

function bindHeroPager(swiper, pager) {
  if (!pager || pager.dataset.bound === "true") {
    return;
  }

  pager.dataset.bound = "true";

  pager.querySelectorAll(".psm-hero__pager-btn").forEach((button) => {
    button.addEventListener("click", () => {
      const index = parseInt(button.getAttribute("data-slide"), 10);
      if (Number.isNaN(index)) {
        return;
      }

      if (swiper.params.loop) {
        swiper.slideToLoop(index);
      } else {
        swiper.slideTo(index);
      }
    });
  });
}

function updateHeroPager(swiper, pager) {
  if (!pager) {
    return;
  }

  pager.querySelectorAll("li").forEach((item, index) => {
    item.classList.toggle("is-active", index === swiper.realIndex);
  });
}

function updateHeroSlideA11y(swiper) {
  swiper.slides.forEach((slide) => {
    const content = slide.querySelector(".psm-hero__content");
    if (!content) {
      return;
    }

    const isActive = slide.classList.contains("swiper-slide-active");
    content.toggleAttribute("aria-hidden", !isActive);
    content.querySelectorAll("a, button").forEach((el) => {
      el.tabIndex = isActive ? 0 : -1;
    });
  });
}

function initNewsSwiper() {
  const root = document.querySelector(".psm-news-swiper");
  if (!root || root.swiper || typeof Swiper === "undefined") {
    return;
  }

  const carousel = root.closest(".psm-news__carousel");
  const prev = carousel
    ? carousel.querySelector(".psm-news-nav--prev")
    : document.querySelector(".psm-news-nav--prev");
  const next = carousel
    ? carousel.querySelector(".psm-news-nav--next")
    : document.querySelector(".psm-news-nav--next");
  const slideCount = root.querySelectorAll(".swiper-slide").length;

  if (slideCount < 1) {
    return;
  }

  const maxSlidesPerView = 3;
  const useLoop = slideCount > maxSlidesPerView * 2;

  new Swiper(root, {
    slidesPerView: 1,
    spaceBetween: 32,
    loop: useLoop,
    rewind: slideCount > 1 && !useLoop,
    speed: 600,
    grabCursor: true,
    watchOverflow: true,
    observer: true,
    observeParents: true,
    navigation:
      prev && next
        ? {
            nextEl: next,
            prevEl: prev,
          }
        : undefined,
    breakpoints: {
      576: {
        slidesPerView: 1,
        spaceBetween: 24,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 32,
      },
      1200: {
        slidesPerView: 3,
        spaceBetween: 32,
      },
    },
  });
}

function initStickyHeader() {
  const header = document.querySelector(".psm-header");
  if (!header) {
    return;
  }

  const onScroll = () => {
    header.classList.toggle("is-scrolled", window.scrollY > 20);
  };

  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });
}

function initVideoModals() {
  const triggers = document.querySelectorAll("[data-video-modal]");
  if (!triggers.length) {
    return;
  }

  const openModal = (modal) => {
    const iframe = modal.querySelector(".psm-video-modal__iframe");
    if (!iframe) {
      return;
    }

    const baseSrc = iframe.getAttribute("data-src");
    if (!baseSrc) {
      return;
    }

    const separator = baseSrc.includes("?") ? "&" : "?";
    iframe.src = baseSrc + separator + "autoplay=1";
    modal.hidden = false;
    modal.setAttribute("aria-hidden", "false");
    modal.classList.add("is-open");
    document.body.style.overflow = "hidden";

    const closeButton = modal.querySelector(".psm-video-modal__close");
    if (closeButton) {
      closeButton.focus();
    }
  };

  const closeModal = (modal) => {
    const iframe = modal.querySelector(".psm-video-modal__iframe");
    if (iframe) {
      iframe.src = "";
    }

    modal.classList.remove("is-open");
    modal.hidden = true;
    modal.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";
  };

  triggers.forEach((trigger) => {
    trigger.addEventListener("click", () => {
      const modalId = trigger.getAttribute("data-video-modal");
      if (!modalId) {
        return;
      }

      const modal = document.getElementById(modalId);
      if (modal) {
        openModal(modal);
      }
    });
  });

  document.querySelectorAll(".psm-video-modal").forEach((modal) => {
    modal.querySelectorAll("[data-video-modal-close]").forEach((control) => {
      control.addEventListener("click", () => closeModal(modal));
    });

    modal.addEventListener("click", (event) => {
      if (event.target === modal.querySelector(".psm-video-modal__backdrop")) {
        closeModal(modal);
      }
    });
  });

  document.addEventListener("keydown", (event) => {
    if ("Escape" !== event.key) {
      return;
    }

    document.querySelectorAll(".psm-video-modal.is-open").forEach((modal) => {
      closeModal(modal);
    });
  });
}
