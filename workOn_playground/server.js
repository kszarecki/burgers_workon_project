// EXPRESS CONFIG
const express = require('express')

const app = express()

// STATIC FILES
app.use(express.static(__dirname + '/public'))

// VIEWS TEMPLATE
app.set('view engine', 'ejs')

// ROUTES
app.get('/', (req, res) => {

  res.render('home', { title: 'Burger for you', picture: 'home_hero_image.jpg' })
})

app.get('/menu', (req, res) => {

  res.render('menu', { title: 'Lista burgerów', picture: 'menu_hero_image.jpg' })
})

app.get('/opinie', (req, res) => {

  res.render('opinie', { title: 'Opinie klientów', picture: 'opinions_hero_image.jpg' })
})

app.get('/burger-maker', (req, res) => {

  res.render('burger-maker', { title: 'Własny burger', picture: 'burger_maker_hero_image.jpg' })
})

app.get('/kontakt', (req, res) => {

  res.render('kontakt', { title: 'Napisz do nas', picture: 'contact_hero_image.jpg' })
})

app.get('/koszyk', (req, res) => {

  res.render('koszyk', { title: 'Twoje zakupy', picture: 'cart_hero_image.jpg' })
})

app.get('/zamówienie', (req, res) => {

  res.render('checkout', { title: 'Twoje zamówienie', picture: 'checkout_hero_image.jpg' })
})

app.get('/404', (req, res) => {

  res.render('404', { title: 'Błąd strony', picture: '404_hero_image.jpg' })
})

// PORT
app.listen(8080)

console.log('listening on port 8080')