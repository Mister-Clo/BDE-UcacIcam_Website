var axios = require("axios");
var FormData = require("formdata-node");
var models = require('../models');
var bodyParser = require('../node_modules/body-parser'); // Charge le middleware de gestion des paramètres
var crypto = require("crypto");


module.exports = {
    login: function (req, res) {

        var email = req.body.email_connexion == undefined ? "" : req.body.email_connexion ;
        var password = req.body.password_connexion == undefined ? "" : req.body.password_connexion;

        if(email != "" && password!= ""){
            var algorithm = 'sha256';
            var encryptedPassword = crypto.createHash(algorithm).update(password).digest('hex');

        models.User.findOne({
           attributes: ["id","name","surname","email","password","localisation","status"],
           where: {email : email, password : encryptedPassword}
        }).then(function (userFound) {
           if(userFound){  
             userFound.confirmation="£node_SERV";
               console.log(userFound);      
                res.send(userFound);
               // On contacte le serveur php
              /* donnees = new FormData();
               donnees.append("name",userFound.name); donnees.append("surname",userFound.surname); donnees.append("password",userFound.password);
               donnees.append("email",userFound.email); donnees.append("localisation",userFound.localisation); donnees.append("status",userFound.status);
               donnees.append("confirmation","£node_SERV");
               axios({
                method: 'POST',
                url: 'http://localhost/BDE_Website/PHP_server/treat_connexion.php',
                data: userFound
              })
               .then(function (reponse) {
                   console.log(reponse.data);
                  res.send(reponse.data);
               })
               .catch(function (erreur) {
                  console.log(erreur);
               });*/

           }   
           else{
               res.send("utilisateur introuvable");
           }
        });
       }
        else{
            res.send("Veuillez remplir tous les champs");
        }
    },

    register: function(req, res) {

        var $errors = Object();
        var nom = req.body.nom_inscription == undefined ? "" : req.body.nom_inscription;
        var prenom = req.body.prenom_inscription == undefined ? "" : req.body.prenom_inscription;
        var localisation = req.body.localisation_inscription == undefined ? "" : req.body.localisation_inscription;
        var email = req.body.email_inscription == undefined ? "" : req.body.email_inscription;
        var password = req.body.password_inscription == undefined ? "" : req.body.password_inscription;

        if (nom != "" && prenom != "" && localisation != "" && email != "" && password != "") {


            //Vérification de la localisation
            var tab = ["Douala","Pointe-Noire"];

            if(tab.indexOf(localisation) == -1){
                $errors.localisation_inscription = "centre inconnu";
            }

            //Vérification de l'email
                models.User.findOne({
                    attributes: ["email"],
                    where: {email: email}
                }).then(function (userFound) {

                 if (email.match("^[a-zA-Z0-9\._%+-]+@[a-zA-Z_-]+\.(com|fr|net)$")) {
                       if (userFound) {
                            $errors.email_inscription = "email déjà utilisée";
                         //  res.send(userFound);
                       }
                 } else {
                    $errors.email_inscription = "email invalide";
                }

                //Taille du tableau $errors
                var $errors_length=0;
                for(elt in $errors){
                    $errors_length++;
                }

                    //Envoi des informations
                    if($errors_length==0){
                        var algorithm = 'sha256';
                        var encryptedPassword = crypto.createHash(algorithm).update(password).digest('hex');

                        var user = models.User.create({
                            name: nom,
                            surname: prenom,
                            localisation: localisation,
                            email: email,
                            password: encryptedPassword,
                            createdAt: Date.now()
                        });
                        res.send("done");
                    }else{
                        res.json($errors);
                    }
              });


         }else{
              res.send("Veuillez remplir tous les champs");
         }

    }
};