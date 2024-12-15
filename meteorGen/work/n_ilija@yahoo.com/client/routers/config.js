/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      client/router/config.js
 * generated:     2024/12/12 9:37
 */

Router.configure({
    notFoundTemplate: 'home',
    loadingTemplate: 'loading'
});

Router.onBeforeAction(function() {
    //console.log(Router.current().route.getName());
    if (! Meteor.userId()) {
        this.layout('preDashboardLayout');
        this.render('home');
    } else {
        this.layout('dashboardLayout');
        this.next();
    }
});
// End of generated file