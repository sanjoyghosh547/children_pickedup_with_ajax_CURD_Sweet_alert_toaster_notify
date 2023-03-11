$(document).ready(function () {

    //input fields validation start
$(".only_integer").keypress(function (event) {

    var inputValue = event.charCode;
    if (!(inputValue >= 48 && inputValue <= 57)) {
        event.preventDefault();
    }
});

$(".only_character").keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});

$(".number_character").keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z  0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});
//input fields validation end

});
