(function($) {
    'use strict';

    if ($(".js-example-basic-single").length) {
        $(".js-example-basic-single").select2({
            placeholder: "Nothing Selected",
            allowClear: true,
        });
    }
    if ($(".js-example-basic-multiple").length) {
        $(".js-example-basic-multiple").select2();
    }
})(jQuery);