import express from 'express'

const app = express()

app.use(express.static('./'));

app.set('view engine', 'pug')
app.set('views', './pug')

app.get('/', function (req, res) {
    res.render('index', {
    	title: 'Hey Hey Hey!',
    	message: 'Yo Yo'
    })
})

app.use(function(req, res, next) {
    res.status(404);
    res.send('Oops Oh No!');
});

app.listen(process.env.PORT || 3000)