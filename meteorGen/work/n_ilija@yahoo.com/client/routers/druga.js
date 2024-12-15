/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      client/routers/druga.js
 * generated:     2024/12/12 9:37
 */

Router.route('/druga',
    function() {
        this.wait(Meteor.subscribe('druga'));
        if (this.ready()) {
            this.render();
        } else {
            this.render('loading');
        }
    }
);
// End of generated file