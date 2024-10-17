define([
    'jquery',
    'uiComponent'
], function ($, Component) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            // Add the beforeunload event listener
            window.onbeforeunload = function () {
                return 'Are you sure you want to leave?';
            };
        }
    });
});
