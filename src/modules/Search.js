import $ from "jquery";

/**
 * Handles search overlay behavior, keyboard shortcuts, and live search requests
 */
class Search {
    static SELECTORS = {
        openButton: ".js-search-trigger",
        overlay: ".search-overlay",
        closeButton: ".search-overlay__close",
        searchInput: "#search-term",
        results: "#search-overlay__results",
    };

    static CLASSES = {
        overlayActive: "search-overlay--active",
        bodyNoScroll: "body-no-scroll",
    };

    constructor({debounceDelay = 750} = {}) {
        this.$body = $("body");
        this.$document = $(document);

        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.lastSearchValue = "";
        this.typingTimer = null;
        this.DEBOUNCE_DELAY = debounceDelay;

        this.addSearchHTML();
        this.cacheDom();
        this.bindEvents();
    }

    addSearchHTML() {
        // Only add once
        if ($(Search.SELECTORS.overlay).length) return;

        this.$body.append(`
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" id="search-term" class="search-term" placeholder="What are you looking for?">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        <div class="container">
          <div id="search-overlay__results"></div>
        </div>
      </div>
    `);
    }

    cacheDom() {
        const S = Search.SELECTORS;
        this.$openButton = $(S.openButton);
        this.$overlay = $(S.overlay);
        this.$closeButton = $(S.closeButton);
        this.$searchInput = $(S.searchInput);
        this.$results = $(S.results);
    }

    bindEvents() {
        this.$openButton.on("click", () => this.openOverlay());
        this.$closeButton.on("click", () => this.closeOverlay());
        this.$document.on("keydown", (e) => this.handleKeyPress(e));
        this.$searchInput.on("keyup", () => this.handleTyping());
    }

    openOverlay() {
        this.$overlay.addClass(Search.CLASSES.overlayActive);
        this.$body.addClass(Search.CLASSES.bodyNoScroll);

        setTimeout(() => this.$searchInput.trigger("focus"), 300);
        this.isOverlayOpen = true;

        return false;
    }

    closeOverlay() {
        this.$overlay.removeClass(Search.CLASSES.overlayActive);
        this.$body.removeClass(Search.CLASSES.bodyNoScroll);

        this.$searchInput.val("");
        this.setResultsHtml("");

        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.lastSearchValue = "";
        clearTimeout(this.typingTimer);
    }

    handleKeyPress(event) {
        const isTypingInField = $("input, textarea").is(":focus");

        if (event.key === "s" && !this.isOverlayOpen && !isTypingInField) {
            this.openOverlay();
            return;
        }

        if (event.key === "Escape" && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    handleTyping() {
        const currentValue = String(this.$searchInput.val() ?? "");

        if (currentValue === this.lastSearchValue) return;

        clearTimeout(this.typingTimer);

        if (!currentValue.trim()) {
            this.setResultsHtml("");
            this.isSpinnerVisible = false;
            this.lastSearchValue = "";
            return;
        }

        this.showSpinner();

        this.typingTimer = setTimeout(() => {
            this.fetchResults(currentValue);
        }, this.DEBOUNCE_DELAY);

        this.lastSearchValue = currentValue;
    }

    showSpinner() {
        if (this.isSpinnerVisible) return;
        this.setResultsHtml("<div class='spinner-loader'></div>");
        this.isSpinnerVisible = true;
    }

    setResultsHtml(html) {
        this.$results.html(html);
    }

    fetchResults(query) {
        const baseUrl = university_data.root_url;
        const safeQuery = encodeURIComponent(query);

        $.getJSON(`${baseUrl}/wp-json/api/v1/search?term=${safeQuery}`)
            .done((results) => {
                this.setResultsHtml(this.renderResults(results, baseUrl));
            })
            .fail(() => {
                this.setResultsHtml("<p>Unexpected error; please try again.</p>");
            })
            .always(() => {
                this.isSpinnerVisible = false;
            });
    }

    renderResults(results, baseUrl) {
        return `
      <div class="row">
        <div class="one-third">
          ${this.renderGeneralInfo(results.general_info)}
        </div>

        <div class="one-third">
          ${this.renderPrograms(results.programs, baseUrl)}
          ${this.renderProfessors(results.professors)}
        </div>

        <div class="one-third">
          ${this.renderCampuses(results.campuses, baseUrl)}
          ${this.renderEvents(results.events, baseUrl)}
        </div>
      </div>
    `;
    }

    renderSectionTitle(title) {
        return `<h2 class="search-overlay__section-title">${title}</h2>`;
    }

    renderList(items, className, renderItem) {
        const cls = className ? ` class="${className}"` : "";
        return `<ul${cls}>${items.map(renderItem).join("")}</ul>`;
    }

    renderGeneralInfo(items = []) {
        const title = this.renderSectionTitle("General Information");

        if (!items.length) return `${title}<p>No general information matches that search.</p>`;

        return `
      ${title}
      ${this.renderList(items, "link-list min-list", (item) => `
        <li>
          <a href="${item.permalink}">${item.title}</a>
          ${item.post_type === "post" ? ` by ${item.author_name}` : ""}
        </li>
      `)}
    `;
    }

    renderPrograms(items = [], baseUrl) {
        const title = this.renderSectionTitle("Programs");

        if (!items.length) {
            return `${title}<p>No program matches that search. <a href="${baseUrl}/programs">View all programs</a></p>`;
        }

        return `
      ${title}
      ${this.renderList(items, "link-list min-list", (item) => `
        <li><a href="${item.permalink}">${item.title}</a></li>
      `)}
    `;
    }

    renderProfessors(items = []) {
        const title = this.renderSectionTitle("Professors");

        if (!items.length) return `${title}<p>No professor matches that search.</p>`;

        return `
      ${title}
      ${this.renderList(items, "professor-cards", (item) => `
        <li class="professor-card__list-item">
          <a class="professor-card" href="${item.permalink}">
            <img class="professor-card__image" src="${item.image}" alt="${item.title}">
            <span class="professor-card__name">${item.title}</span>
          </a>
        </li>
      `)}
    `;
    }

    renderCampuses(items = [], baseUrl) {
        const title = this.renderSectionTitle("Campuses");

        if (!items.length) {
            return `${title}<p>No campus matches that search. <a href="${baseUrl}/campuses">View all campuses</a></p>`;
        }

        return `
      ${title}
      ${this.renderList(items, "link-list min-list", (item) => `
        <li><a href="${item.permalink}">${item.title}</a></li>
      `)}
    `;
    }

    renderEvents(items = [], baseUrl) {
        const title = this.renderSectionTitle("Events");

        if (!items.length) {
            return `${title}<p>No event matches that search. <a href="${baseUrl}/events">View all events</a></p>`;
        }

        // Note: original code used <ul> but inserted <div>s. Keeping the divs for correctness.
        return `
      ${title}
      ${items
            .map(
                (item) => `
          <div class="event-summary">
            <a class="event-summary__date t-center" href="${item.permalink}">
              <span class="event-summary__month">${item.month}</span>
              <span class="event-summary__day">${item.day}</span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny">
                <a href="${item.permalink}">${item.title}</a>
              </h5>
              <p>
                ${item.description}
                <a href="${item.permalink}" class="nu gray">Learn more</a>
              </p>
            </div>
          </div>
        `
            )
            .join("")}
    `;
    }
}

export default Search;
