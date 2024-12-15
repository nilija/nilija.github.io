/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      server/startup/start.js
 * generated:     2024/12/12 9:37
 */

Meteor.startup(function () {
    // code to run on server at startup
    var pass = 'admin';
    Meteor.users.remove({});
    Accounts.createUser({
        username : 'admin',
        password : pass
    });
    console.log(Meteor.users.find().count());
});
// End of generated file