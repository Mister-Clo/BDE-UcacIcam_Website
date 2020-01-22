var express = require('express');
var apiRouter = require('./routers/apiRouter').router;
var bodyParser = require('body-parser'); // Charge le middleware de gestion des paramètres

var app = express();


app.use(function(request, response, next) {
    response.header("Access-Control-Allow-Origin", "*");
    response.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
})
.use(bodyParser.urlencoded({ extended: true }))
.use(bodyParser.json())

.use('/api',apiRouter)

.use(function(req, res) {
    res.setHeader('Content-Type', 'application/json');
    res.redirect('/');
})

.listen(8080);