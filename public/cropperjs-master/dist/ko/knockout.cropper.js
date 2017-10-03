(function (factory) {
    // Module systems magic dance.

    if (typeof require === "function" && typeof exports === "object" && typeof module === "object") {
        // CommonJS or Node: hard-coded dependency on "knockout"
        factory(require("knockout"), require("jquery"));
    } else if (typeof define === "function" && define["amd"]) {
        // AMD anonymous module with hard-coded dependency on "knockout"
        define(["knockout"], ["jquery"], factory);
    } else {
        // <script> tag: use the global `ko` object, attaching a `mapping` property
        factory(ko, jQuery);
    }
}

(function (ko, jquery) {
	ko.bindingHandlers.cropper = {
		init: function(element, valueAccessor, allBindingsAccessor) {
            cropper = null;
		},

        update: function(element, valueAccessor, allBindingsAccessor){
            var allBindings = allBindingsAccessor();
            var cropperOptions = ko.unwrap(allBindings.cropper.options);
            var cropperData = ko.unwrap(allBindings.cropper.valueData);
            var btnActions = ko.unwrap(allBindings.cropper.btnActions);
            var ratio = ko.unwrap(allBindings.cropper.ratio);
                cropperOptions.aspectRatio = ratio;
                cropperOptions.ready = function () {
          console.log('ready');
        };

            //element.cropper.replace(cropperData);
            if(cropper) cropper.destroy();
            cropper = new Cropper(element, cropperOptions);

            ko.utils.registerEventHandler(btnActions + ' button.crop', 'click',function() {

                var self = $(this);
                var method = self.data('method');
                var option = self.data('option');
                var secondOption = self.data('secondOption');

                cropper[method](option,secondOption);

            });
        }
	};
}));