import Glide from "@glidejs/glide";

/**
 * Initializes the homepage hero slider and its navigation bullets.
 */
class HeroSlider {
    static SELECTORS = {
        slider: ".hero-slider",
        slide: ".hero-slider__slide",
        bullets: ".glide__bullets",
    };

    static CLASSES = {
        bullet: "slider__bullet",
        glideBullet: "glide__bullet",
    };

    constructor() {
        this.cacheDom();
        if (!this.$slider) return;

        this.renderBullets();
        this.initGlide();
    }

    cacheDom() {
        const S = HeroSlider.SELECTORS;
        this.$slider = document.querySelector(S.slider);
        this.$slides = this.$slider?.querySelectorAll(S.slide) ?? [];
        this.$bullets = this.$slider?.querySelector(S.bullets);
    }

    renderBullets() {
        if (!this.$bullets || !this.$slides.length) return;

        const C = HeroSlider.CLASSES;
        const bulletHTML = Array.from({length: this.$slides.length}, (_, i) =>
            `<button class="${C.bullet} ${C.glideBullet}" data-glide-dir="=${i}"></button>`
        ).join("");

        this.$bullets.insertAdjacentHTML("beforeend", bulletHTML);
    }

    initGlide() {
        const glide = new Glide(HeroSlider.SELECTORS.slider, {
            type: "carousel",
            perView: 1,
            autoplay: 3000,
        });

        glide.mount();
        this.glide = glide;
    }
}

export default HeroSlider;
