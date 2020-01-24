const App = (function() {

    let self = {};

    let state = {
        openMenu: false,
        review_slider_status: 0
    }

    self.init = function() {
        console.log('App is loaded');

        // ELEMENTS
        const hamburger_icon = document.querySelector('#hamburger_icon');
        const close_icon = document.querySelector('#close_icon');
        const arrow_down_icon = document.querySelector('#arrow_down_icon');
        const review_slider_prev = document.querySelector('.review_slider--prev');
        const review_slider_next = document.querySelector('.review_slider--next');
        const list_of_quotes = [...document.querySelectorAll('.home_quote_paragraph')];

        // EVENTS
        hamburger_icon.onclick = event => self.handleMenu(event, state);
        close_icon.onclick = event => self.handleMenu(event, state);
        arrow_down_icon.onclick = event => self.scrollToMain(event);

        if (review_slider_prev && review_slider_next) {
            review_slider_prev.onclick = event => self.handleReviewSliderPrev(event, state, list_of_quotes);
            review_slider_next.onclick = event => self.handleReviewSliderNext(event, state, list_of_quotes);    
        }
    }

    self.handleReviewSliderNext = function(event, state, list) {

        if(state.review_slider_status < list.length - 1) {
            state.review_slider_status = state.review_slider_status + 1;

            list[state.review_slider_status - 1].style.display = 'none';
            list[state.review_slider_status].style.display = 'inherit';
        }
    }

    self.handleReviewSliderPrev = function(event, state, list) {

        if(state.review_slider_status > 0) {
            state.review_slider_status = state.review_slider_status - 1;

            list[state.review_slider_status + 1].style.display = 'none';
            list[state.review_slider_status].style.display = 'inherit';
        }

    }

    self.handleMenu = function(event, state) {
        const menu_modal = document.querySelector('.menu_modal--container');

        state.openMenu = !state.openMenu;

        if (state.openMenu) {
            menu_modal.style.visibility = 'visible';
        } else {
            menu_modal.style.visibility = 'hidden';
        }
    }

    self.scrollToMain = function(event) {
        const main = document.querySelector('main');
        const header = document.querySelector('header');
        const heightOfPseudo = window.getComputedStyle(main, ':before').height;
        const top = header.scrollHeight - (
            Number(heightOfPseudo.replace('px', '')) + 
            (Number(heightOfPseudo.replace('px', '')) / 2));

        window.scrollTo({
            top: top,
            behavior: 'smooth'
        })
    }

    return self;

})();

window.onload = App.init();