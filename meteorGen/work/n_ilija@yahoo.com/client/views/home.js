/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      client/views/home.js
 * generated:     2024/12/12 9:37
 */

Template.home.events({
    'submit #login-form' : function(e, t){
        e.preventDefault();
        // retrieve the input field values
        var username = t.find('#inputUsername').value;
        var password = t.find('#inputPassword').value;
        // Trim and validate your fields here....
        username = trimInput(username);
        if (isValidPassword(password)) {
            Meteor.loginWithPassword(username, password, function(err){
                if (err) {
                    // The user might not have been found, or their passwword
                    // could be incorrect. Inform the user that their
                    // login attempt has failed.
                    t.find('#errorText').innerHTML = '<strong>Greška u prijavi!</strong>';
                } else {
                    // The user has been logged in.
                    Router.go('/dashboard');
                }
            });
        }
        return false;
    }
});

// trim helper
var trimInput = function(val) {
    return val.replace(/^\s*|\s*$/g, "");
}
// provera passworda na duzinu
var isValidPassword = function(val) {
    return val.length >= 3 ? true : false;
}
//
Template.home.rendered = function() {
    if (Meteor.userId()){
        Router.go('/dashboard');
    }
}
// End of generated file