$(document).ready(function(){
    $('.razorpay_btn').click(function(e) {
        e.preventDefault();

        var firstname = $('.firstname').val();
        var lastname = $('.lastname').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var address = $('.address').val();
        var city = $('.city').val();
        var country = $('.country').val();
        var pincode  = $('.pincode').val();

        if(!firstname){
            fname_error = "名稱必須輸入!";
            $('#fname_error').html('');
            $('#fname_error').html('fname_error');
        }else{
            fname_error ="";
            $('#fname_error').html('');
        }

        if(!lastname){
            lname_error = "姓氏必須輸入!";
            $('#lname_error').html('');
            $('#lname_error').html('lname_error');
        }else{
            fname_error ="";
            $('#lname_error').html('');
        }
        
        if(!email){
            email_error = "信箱必須輸入!";
            $('#email_error').html('');
            $('#email_error').html('email_error');
        }else{
            email_error ="";
            $('#email_error').html('');
        }

        if(!phone){
            phone_error = "電話必須輸入!";
            $('#phone_error').html('');
            $('#phone_error').html('phone_error');
        }else{
            phone_error ="";
            $('#phone_error').html('');
        }

        if(!address){
            address_error = "地址必須輸入!";
            $('#address_error').html('');
            $('#address_error').html('address_error');
        }else{
            address_error ="";
            $('#address_error').html('');
        }

        if(!city){
            city_error = "城市必須輸入!";
            $('#city_error').html('');
            $('#city_error').html('city_error');
        }else{
            city_error ="";
            $('#city_error').html('');
        }

        if(!country){
            country_error = "國家必須輸入!";
            $('#country_error').html('');
            $('#country_error').html('country_error');
        }else{
            country_error ="";
            $('#country_error').html('');
        }

        if(!pincode){
            pincode_error = "邀請碼必須輸入!";
            $('#pincode_error').html('');
            $('#pincode_error').html('pincode_error');
        }else{
            pincode_error ="";
            $('#pincode_error').html('');
        }

        if(fname_error != '' || lname_error != '' || email_error != '' || phone_error != '' || address_error != '' || city_error != '' || country_error != '' || pincode_error != ''){
            return false;
            
        }else{
            var data = {
               'firstname' :firstname,
               'lastname' :lastname,
               'email' :email,
               'phone' :phone,
               'address' :address,
               'city' :city,
               'country' :country,
               'pincode' :pincode
            }
            
            $.ajax({
                method: "POST",
                url: "/proceed-to-pay",
                data: data,
                success: function(response){
                    alert("response.total_price")
                }
            })
        }

    })

    $('.paypal_btn').click(function(e) {
        e.preventDefault();

        var firstname = $('.firstname').val();
        var lastname = $('.lastname').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var address = $('.address').val();
        var city = $('.city').val();
        var country = $('.country').val();
        var pincode  = $('.pincode').val();

        if(!firstname){
            fname_error = "名稱必須輸入!";
            $('#fname_error').html('');
            $('#fname_error').html('fname_error');
        }else{
            fname_error ="";
            $('#fname_error').html('');
        }

        if(!lastname){
            lname_error = "姓氏必須輸入!";
            $('#lname_error').html('');
            $('#lname_error').html('lname_error');
        }else{
            fname_error ="";
            $('#lname_error').html('');
        }
        
        if(!email){
            email_error = "信箱必須輸入!";
            $('#email_error').html('');
            $('#email_error').html('email_error');
        }else{
            email_error ="";
            $('#email_error').html('');
        }

        if(!phone){
            phone_error = "電話必須輸入!";
            $('#phone_error').html('');
            $('#phone_error').html('phone_error');
        }else{
            phone_error ="";
            $('#phone_error').html('');
        }

        if(!address){
            address_error = "地址必須輸入!";
            $('#address_error').html('');
            $('#address_error').html('address_error');
        }else{
            address_error ="";
            $('#address_error').html('');
        }

        if(!city){
            city_error = "城市必須輸入!";
            $('#city_error').html('');
            $('#city_error').html('city_error');
        }else{
            city_error ="";
            $('#city_error').html('');
        }

        if(!country){
            country_error = "國家必須輸入!";
            $('#country_error').html('');
            $('#country_error').html('country_error');
        }else{
            country_error ="";
            $('#country_error').html('');
        }

        if(!pincode){
            pincode_error = "邀請碼必須輸入!";
            $('#pincode_error').html('');
            $('#pincode_error').html('pincode_error');
        }else{
            pincode_error ="";
            $('#pincode_error').html('');
        }
    })

})

mobiscroll.setOptions({
    theme: 'ios',
    themeVariant: 'light'
});

$(function () {
    var inst = $('#demo-country-picker').mobiscroll().select({
        display: 'anchored',
        filter: true,
        itemHeight: 40,
        renderItem: function (item) {
            return '<div class="md-country-picker-item">' +
                '<img class="md-country-picker-flag" src="https://img.mobiscroll.com/demos/flags/' + item.data.value + '.png" />' +
                item.display + '</div>';
        }
    }).mobiscroll('getInst');

    $.getJSON('https://trial.mobiscroll.com/content/countries.json', function (resp) {
        var countries = [];
        for (var i = 0; i < resp.length; ++i) {
            var country = resp[i];
            countries.push({ text: country.text, value: country.value });
        }
        inst.setOptions({ data: countries });
    });
});