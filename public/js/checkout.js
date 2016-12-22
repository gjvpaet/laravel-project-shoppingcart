Stripe.setPublishableKey('pk_test_kNCtYmcjQDC8l3DmPZ58VOF6');

var form = $('#checkout-form');

form.submit(function (e) { 
    e.preventDefault();
    
    $('#charge-error').addClass('hidden');
    form.find('button').prop('disabled', true);

    Stripe.card.createToken({
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val(),
        name: $('#card-name').val()
    }, StripeResponseHandler);

    return false;
});

function StripeResponseHandler(status, response) {
    if (response.error) {
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text(response.error.message);

        form.find('button').prop('disabled', true);   
    } else {
        var token = response.id;

        form.append($('<input type="hidden" name="stripeToken">').val(token));
        form.get(0).submit();        
    }
}