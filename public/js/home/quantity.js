$(document).ready(function(){
    $('body').on('click', '.inc', function (){
        var spinner = $( this ).parents( '.quantity' );
        var input = $( spinner ).find( '.qty' );
        var min = input.attr("min"),
        max = input.attr("max");
        var oldValue = parseFloat(input.val());
        if ( max === ''  || max === 'undefine' ) {
            var newVal = oldValue + 1;
        }
        else{
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    $('body').on('click', '.dec', function (){
        var spinner = $( this ).parents( '.quantity' );
        var input = $( spinner ).find( '.qty' );
        var min = input.attr("min"),
        max = input.attr("max");
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });
})
