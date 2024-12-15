/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      collections/treca.js
 * generated:     2024/12/12 9:37
 */

treca = new Meteor.Collection('treca');
treca.allow({
    'insert': function() {
        return true;
    },
    'remove': function() {
        return true;
    },
    'update': function() {
        return true;
    }
});
// End of generated file