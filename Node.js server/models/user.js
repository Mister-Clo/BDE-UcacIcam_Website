'use strict';
module.exports = (sequelize, DataTypes) => {
  const User = sequelize.define('User', {
    confirmation: DataTypes.STRING,
    name: DataTypes.STRING,
    surname: DataTypes.STRING,
    email: DataTypes.STRING,
    password: DataTypes.STRING,
    localisation: DataTypes.STRING,
    status: DataTypes.INTEGER
  }, {});
  User.associate = function(models) {
    // associations can be defined here
  };
  return User;
};