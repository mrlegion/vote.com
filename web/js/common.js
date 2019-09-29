$(document).ready(function () {
    // Замените на свой API-ключ
    var token = "caa2647d6814f83283fc1a761a9d59cd79e4fb3d";

    function join(arr /*, separator */) {
        var separator = arguments.length > 1 ? arguments[1] : ", ";
        return arr.filter(function (n) {
            return n
        }).join(separator);
    }

    function formatCity(suggestion) {
        var address = suggestion.data;
        if (address.city_with_type === address.region_with_type) {
            return address.settlement_with_type || "";
        } else {
            return join([
                address.city_with_type,
                address.settlement_with_type]);
        }
    }

    var type = "ADDRESS";
    var $region = $("#region");
    var $city = $("#city");
    var $street = $("#street");
    var $house = $("#home");

    // регион и район
    $region.suggestions({
        token: token,
        type: type,
        hint: false,
        bounds: "region-area"
    });

    // город и населенный пункт
    $city.suggestions({
        token: token,
        type: type,
        hint: false,
        bounds: "city-settlement",
        constraints: $region,
        formatSelected: formatCity,
    });

    // улица
    $street.suggestions({
        token: token,
        type: type,
        hint: false,
        bounds: "street",
        constraints: $city,
        count: 15,
    });

    // дом
    $house.suggestions({
        token: token,
        type: type,
        hint: false,
        noSuggestionsHint: false,
        bounds: "house",
        constraints: $street
    });

    $('.help-block').each(function () {
        if ($(this).html() != '') {
            $(this).css('display', 'inline-block');
        } else {
            $(this).css('display', 'none');
        }
    });

    $('.help-block').bind('DOMSubtreeModified', function() {
        if ($(this).html() != '') {
            $(this).css('display', 'inline-block');
        } else {
            $(this).css('display', 'none');
        }
    })
});