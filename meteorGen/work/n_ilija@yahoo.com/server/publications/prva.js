/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      server/publications/prva.js
 * generated:     2024/12/12 9:37
 */

Meteor.publish('prva', function () {
    return prva.find();
});
// End of generated file