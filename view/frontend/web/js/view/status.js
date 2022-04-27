define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (Component, customerData) {
    'use strict';

    return Component.extend({
        defaults: {
            status: '',
            captionText: false
        },

        initObservable: function () {
            this._super().observe('status captionText');

            return this;
        },

        initialize: function () {
            this._super();
            var statusData = customerData.get('customerstatus');

            if (statusData().status) {
                this.status(statusData().status);
            }

            statusData.subscribe(function (statusData) {
                this.status(statusData.status);
            }.bind(this));
        },
    });
});
