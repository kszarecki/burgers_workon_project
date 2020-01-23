const App = (function() {

    let self = {};

    let state = {
        openMenu: false
    }

    self.init = function() {
        console.log('App is loaded');

        // ELEMENTS
        const hamburger_icon = document.querySelector('#hamburger_icon');
        const close_icon = document.querySelector('#close_icon');
        const arrow_down_icon = document.querySelector('#arrow_down_icon');

        // EVENTS
        hamburger_icon.onclick = event => self.handleMenu(event, state);
        close_icon.onclick = event => self.handleMenu(event, state);
        arrow_down_icon.onclick = event => self.scrollToMain(event);
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