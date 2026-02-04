/**
 * Handles opening and closing of the mobile navigation menu.
 */
class MobileMenu {
    static SELECTORS = {
        menu: ".site-header__menu",
        trigger: ".site-header__menu-trigger",
    };

    static CLASSES = {
        activeMenu: "site-header__menu--active",
        iconOpen: "fa-bars",
        iconClose: "fa-window-close",
    };

    constructor() {
        this.cacheDom();
        if (!this.$menu || !this.$trigger) return;

        this.bindEvents();
    }

    cacheDom() {
        const S = MobileMenu.SELECTORS;
        this.$menu = document.querySelector(S.menu);
        this.$trigger = document.querySelector(S.trigger);
    }

    bindEvents() {
        this.$trigger.addEventListener("click", () => this.toggleMenu());
    }

    toggleMenu() {
        const C = MobileMenu.CLASSES;

        this.$trigger.classList.toggle(C.iconOpen);
        this.$trigger.classList.toggle(C.iconClose);
        this.$menu.classList.toggle(C.activeMenu);
    }
}

export default MobileMenu;
