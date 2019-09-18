$(function(e) {
    "use strict";
    $(".date").inputmask("dd/mm/yyyy"),
        $(".phone-inputmask").inputmask("9999999999"),
        $(".phone_number").inputmask("+233 999 999 999",{greedy: false,clearincomplete: true}),
        $(".voters_id").inputmask("9999999999",{greedy: true}),
        $(".ghana-card").inputmask("GHAA-999999999-9",{ "escapeChar": "A" }),
        $(".passport-id").inputmask("A9999999",{greedy: true}),
        $(".nhis").inputmask("99999999",{greedy: true}),
        $(".ssnit").inputmask("A999999999999"),
        $(".new-drivers-license").inputmask("AABC-99999999-99999",{ "escapeChar": "A" }),
        $(".international-inputmask").inputmask("+9(999)999-9999"),
        $(".xphone-inputmask").inputmask("(999) 999-9999 / x999999"),
        $(".purchase-inputmask").inputmask("aaaa 9999-****"),
        $(".cc-inputmask").inputmask("9999 9999 9999 9999"),
        $(".ssn-inputmask").inputmask("999-99-9999"),
        $(".isbn-inputmask").inputmask("999-99-999-9999-9"),
        $(".currency-inputmask").inputmask("$9999"),
        $(".percentage-inputmask").inputmask("99%"),
        $(".decimal-inputmask").inputmask({
            alias: "decimal"
            , radixPoint: "."
        }),

        $(".email-inputmask").inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]"
            , greedy: !1
            , onBeforePaste: function (n, a) {
                return (e = e.toLowerCase()).replace("mailto:", "")
            }
            , definitions: {
                "*": {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]"
                    , cardinality: 1
                    , casing: "lower"
                }
            }
        })
});