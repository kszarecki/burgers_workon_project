const App = (function() {

    let self = {};

    let state = {
        openMenu: false,
        review_slider_status: 0,
        checkbox_clicked: {
            ser: true,
            wieprzowina: true,
            sałata: false,
            cebula: false,
            pomidor: false,
            ogórek: false
        },
        current_ingredients: [
            'ser',
            'wieprzowina'
        ]
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
        const checkbox_cheese = document.querySelector('#ser');
        const checkbox_meat = document.querySelector('#wieprzowina');
        const checkbox_green = document.querySelector('#sałata');
        const checkbox_cucumbers = document.querySelector('#ogórek');
        const checkbox_tomatoes = document.querySelector('#pomidor');
        const checkbox_onion_rings = document.querySelector('#cebula');
        const burger_maker_submit_btn = document.querySelector('.simple_add_to_cart_button');
        const burger_maker_remove_btn = document.querySelector('a.remove[data-product_id="194"]');
        const burger_maker_quantity_box = Array.from(document.querySelectorAll('label'))
        .find(el => el.textContent === 'ilość Własny burger');
        const order_comments = document.querySelector('textarea[name="order_comments"]');

        // EVENTS
        hamburger_icon.onclick = event => self.handleMenu(event, state);
        close_icon.onclick = event => self.handleMenu(event, state);
        arrow_down_icon.onclick = event => self.scrollToMain(event);

        if (review_slider_prev && review_slider_next) {
            review_slider_prev.onclick = event => self.handleReviewSliderPrev(event, state, list_of_quotes);
            review_slider_next.onclick = event => self.handleReviewSliderNext(event, state, list_of_quotes);    
        }

        if (checkbox_cheese) {
            checkbox_cheese.onclick = event => self.handleCheckboxFields(event, state);
            checkbox_meat.onclick = event => self.handleCheckboxFields(event, state);
            checkbox_green.onclick = event => self.handleCheckboxFields(event, state);
            checkbox_cucumbers.onclick = event => self.handleCheckboxFields(event, state);
            checkbox_tomatoes.onclick = event => self.handleCheckboxFields(event, state);
            checkbox_onion_rings.onclick = event => self.handleCheckboxFields(event, state);
        }

        if (burger_maker_submit_btn) {
            burger_maker_submit_btn.onclick = event => self.handleAddOrderedVariants(event, state);
        }

        if (burger_maker_remove_btn) {

            burger_maker_remove_btn.addEventListener('removed_from_cart', function(e) {
                return self.handleRemoveOrderedVariants(event);
            });
        }

        if (burger_maker_quantity_box) {
            burger_maker_quantity_box.nextElementSibling.disabled = true;
        }

        if (order_comments) {
            const order_content = localStorage.getItem('ordered_variants') ?
            JSON.parse(localStorage.getItem('ordered_variants')) : [];

            if (order_content) {
                order_comments.value = order_content.map((item, index) =>
                    `${item['title']}: ${item['ingredients']}`
                ).join(' || ');
            }
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

    self.handleCheckboxFields = function(event, state) {
        const current_ingredients_display = document.querySelector('#current_ingredients');
        const ser_graphic = document.querySelector('#cheese_graphic');
        const wieprzowina_graphic = document.querySelector('#meat_graphic');
        const sałata_graphic = document.querySelector('#green_graphic');
        const ogórek_graphic = document.querySelector('#cucumbers_graphic');
        const pomidor_graphic = document.querySelector('#tomatoes_graphic');
        const cebula_graphic = document.querySelector('#onion_rings_graphic');

        const graphics = { ser_graphic, wieprzowina_graphic, 
            sałata_graphic, ogórek_graphic, pomidor_graphic, cebula_graphic };

        state.checkbox_clicked[`${event.target.name}`] = !state.checkbox_clicked[`${event.target.name}`];

        if (state.checkbox_clicked[`${event.target.name}`]) {
            if (!state.current_ingredients.includes(event.target.name)) {
                state.current_ingredients.push(event.target.name);
                graphics[`${event.target.name}_graphic`].style.display = 'inherit';
            }
        } else {
            state.current_ingredients = state.current_ingredients.filter(item => item !== event.target.name);
            graphics[`${event.target.name}_graphic`].style.display = 'none';
        }

        const markup = `Wybrane składniki: ${state.current_ingredients.length === 0 ? '<span>-- brak składników --</span>' : state.current_ingredients.map((item, index) => {
            return `<span>${index < (state.current_ingredients.length - 1) ? `-- ${item} ` : `-- ${item} --`}</span>`
        }).join('')}`;

        current_ingredients_display.innerHTML = markup;
    }

    self.handleAddOrderedVariants = function(event, state) {
        console.log('ordered');
        let ordered_variants = localStorage.getItem('ordered_variants') ?
                               JSON.parse(localStorage.getItem('ordered_variants')) : [];

        const variant = {
            title: `Własny Burger - wersja ${ordered_variants.length + 1}`,
            ingredients: state.current_ingredients.join(', ')
        }

        ordered_variants.push(variant);

        localStorage.setItem('ordered_variants', JSON.stringify(ordered_variants));
    }

    self.handleRemoveOrderedVariants = function(event) {
        console.log('remove variants');
        localStorage.removeItem('ordered_variants');
    }

    return self;

})();

window.onload = App.init();