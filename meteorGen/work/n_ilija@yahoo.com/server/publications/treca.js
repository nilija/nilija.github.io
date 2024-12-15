/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      server/publications/treca.js
 * generated:     2024/12/12 9:37
 */

Meteor.publish('treca', function () {
    return treca.find();
});
// End of generated file