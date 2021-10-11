define([
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/single-checkbox',
    'ko'
 ], function (_, uiRegistry, select, ko) { 
    'use strict'; 
    return select.extend({ 
        initialize: function () {
            this._super(); 
            this.fieldDepend(this.value()); 
            return this; 
        },
 
        onUpdate: function (value)
        {
            console.log(value);
            var parking_spot = uiRegistry.get('index = parking_dynamic_rows'); // get field
            var custom_parking = uiRegistry.get('index = custom_parking_spot_enabled'); // get field
            if (value == 0) {
                parking_spot.visible(false);
                custom_parking.visible(false);
            } else { 
                parking_spot.visible(true); 
                custom_parking.visible(true);
            }
            return this._super(); 
        },

        fieldDepend: function (value) 
        {
            setTimeout( function(){
                var parking_spot = uiRegistry.get('index = parking_dynamic_rows'); // get field
                var custom_parking = uiRegistry.get('index = custom_parking_spot_enabled'); // get field
                if (value == 0) {
                    parking_spot.visible(false);
                    custom_parking.visible(false);
                } else { 
                    parking_spot.visible(true); 
                    custom_parking.visible(true); 
                }
            }); 
        }
    });
 
 });