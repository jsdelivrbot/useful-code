import express from 'express'
import path from 'path'

const app = express()
const _ROOT = './'

app.use(express.static(path.join(_ROOT)));

app.set('view engine', 'pug')
app.set('views', path.join(_ROOT, 'pug'))

app.get(['/', '/index'], function (req, res) {
    res.render('index', {})
})

app.get('/news/:page?', function (req, res) {
    res.render('news', {
    	page: req.params.page
    })
})

app.get('/news_detail/:id', function (req, res) {
    res.render('news_detail', {
    	id: req.params.id
    })
})

app.use(function(req, res, next) {
    res.status(404);
    res.send('Oops Oh No!');
});

app.listen(process.env.PORT || 3000)