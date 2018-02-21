import express from 'express'

const app = express()

app.use(express.static('./'));

app.set('view engine', 'pug')
app.set('views', './pug')

app.get('/', function (req, res) {
    res.render('index', {
    	title: 'Hey Hey Hey!',
    	message: 'Yo Yodd'
    })
})

app.listen(process.env.PORT || 3000, () => {
    console.log('server running http://localhost:3000');
})