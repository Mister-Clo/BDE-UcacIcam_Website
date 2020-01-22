var express = require('express');
var UserController = require('../controllers/UserController');

exports.router = (function(){
    var router = express.Router();

  router.route('/users/login').post(UserController.login);
  router.route('/users/register').post(UserController.register);

  return router;
})();