import express from 'express'
import path from 'path'

const app = express()
const _ROOT = './'

app.use(express.static(path.join(_ROOT)));

app.set('view engine', 'pug')
app.set('views', path.join(_ROOT, 'pug'))

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