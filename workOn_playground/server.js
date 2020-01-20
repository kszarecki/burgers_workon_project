// EXPRESS CONFIG
const express = require('express')

const app = express()

// STATIC FILES
app.use(express.static(__dirname + '/public'))

// VIEWS TEMPLATE
app.set('view engine', 'ejs')

// ROUTES
app.get('/', (req, res) => {

  res.render('front-page', {  })
})

// PORT
app.listen(8080)

console.log('listening on port 8080')