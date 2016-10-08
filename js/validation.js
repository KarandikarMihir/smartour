window.onload = function(){
    $('form').submit(function(){
        var isFormValid = true;
        $("form input").each(function(){ // Note the :text
            if($(this).attr('disabled')=='disabled')
                return;
            //trim every value
            $(this).val($.trim($(this).val()));

            if($(this).hasClass('ignore')){
                return;
            }
            if($(this).hasClass('amt skippable') && ($(this).val()==="0" || $(this).val()==="0.00")){
                return;
            }
            if($(this).hasClass('skippable') && $(this).val()===""){
                return;
            }

            if($(this).val()===""){
                $(this).css("border","1px solid #ff0000");
                isFormValid = false;
                return;
            }
            else{
                $(this).css("border","");
            }

            if($(this).hasClass('validate-name')){
                re=/^[A-Za-z .,']+$/;
                if(!re.test($(this).val())){
                    $(this).css("border","1px solid #ff0000");
                    isFormValid = false;
                }
                else{
                    $(this).css("border","");
                }                
            }
            if($(this).attr("type")=="date"){
                var timestamp = Date.parse($(this).val())
                if (isNaN(timestamp) == true) { 
                    $(this).css("border","1px solid #ff0000");
                    isFormValid = false;
                }
                else{
                    $(this).css("border","");
                }
            }
            if($(this).attr("type")=="phone"){
                $(this).val($(this).val().replace(/\s/g, ""));
                re = /^[0-9+/\(\)]+$/;
                if(!re.test($(this).val()) || $(this).val().length < 8){
                    $(this).css("border","1px solid #ff0000");
                    isFormValid = false;
                }
                else{
                    $(this).css("border","");
                }
            }
            if($(this).attr("type")=="email"){
                re = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
                if(!re.test($(this).val())){
                    $(this).css("border","1px solid #ff0000");
                    isFormValid = false;
                }
                else{
                    $(this).css("border","");
                }
            }
            if($(this).attr("type")=="url"){
                var re = new RegExp('(http|ftp|https)://[a-z0-9\-_]+(\.[a-z0-9\-_]+)+([a-z0-9\-\.,@\?^=%&;:/~\+#]*[a-z0-9\-@\?^=%&;/~\+#])?', 'i');
                if(!re.test($(this).val())){
                    $(this).css("border","1px solid #ff0000");
                    isFormValid = false;
                }
                else{
                    $(this).css("border","");
                }
            }
            if($(this).hasClass("amt")){
                if(!isNumber($(this).val())){
                    $(this).css("border","1px solid #ff0000");
                    isFormValid = false;
                }
                else{
                    $(this).css("border","");
                }
            }
            if($(this).hasClass("time")){
                re = /^(?:[01]\d|2[0-3]):?[0-5]\d$/;
                if(!re.test($(this).val())){
                    $(this).css("border","1px solid #ff0000");
                    isFormValid = false;
                }
                else{
                    $(this).css("border","");
                }
            }
        });
        if($(this).hasClass('roomform')){
            if (isFormValid) {
                var data = $(this).serialize();
                var url = 'request.php?KEY=addapproom&' + data;

                /* stop form from submitting normally */
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: url,
                    cache: false,
                    success: function(result) {
                        location.reload(true);
                    }
                });
            }
        }
        return isFormValid;        
    });
    
    $('.add').on('keyup', function() {
        var total = 0;
        $('.add').each(function () {
            total += parseFloat($(this).val());
        });
        $('#sum').val(total.toFixed(2));
    });
    $('#ccharge').on('keyup', function(){
        var paidamt = (parseFloat($('#totalamt').val()) - parseFloat($('#balance').val()));
        var refund = paidamt - parseFloat($(this).val());
        refund = refund - parseFloat($('#scharge').val());
        $('#refund').val(refund);
    });
    $('.amt').on('input',function() {
        if(!isNaN(parseFloat(this.value)) && isFinite(this.value)){
            this.value = this.value.replace(/[^0-9\.]/g, '');
            $(this).css("border","");
        }
        else{
            $(this).css("border","1px solid #ff0000");
            this.value = "0";
            $(this).select();
        }
    });
//    $('.amt').on('input', function(){
//        var temp = $(this).val();
//        if(temp.match(/^\d+(\.\d+)?$/))
//            $(this).val(temp);
//        else
//            $(this).val("0");
//    });

    $('#cpwd').on('keyup', function(){
        if(!($(this).val() === $('#npwd').val())){
            $(this).css("border","1px solid #ff0000");
        }
        else{
            $(this).css("border","");
        }
    });
    
    $('.onchangeupdate_basic').on("input", function(){
        var nights = $('#nightnos').val();
        var rooms = $('#roomnos').val();
        var rate = $('#roomrate').val();
        $('#basicamount').val(nights*rooms*rate).trigger('input');
    });
    
    $('.onchangeupdate_extra').on("input", function(){
        var nights = $('#nightnos').val();
        var pax = $('#extrapax').val();
        var rate = $('#extrarate').val();
        $('#extraamount').val(pax*rate*nights).trigger('input');
    });    
    
    $('.onchangeupdate_child').on("input", function(){
        var nights = $('#nightnos').val();
        var pax = $('#children').val();
        var rate = $('#childrate').val();
        $('#childamount').val(pax*rate*nights).trigger('input');
    });
    
    $('.onchangeupdate_grand').on("input", function(){
        var basic = parseInt($('#basicamount').val());
        var extra = parseInt($('#extraamount').val());
        var child = parseInt($('#childamount').val());
        $('#grandtotal').val(basic+extra+child);
    });    
    
    $('#todate').on('input', function() {
        var date1 = new Date($('#fromdate').val());
        var date2 = new Date($('#todate').val());
        var difference = date2 - date1;
        var days = difference / (24 * 3600 * 1000);
        //$('#nightnos').val(daydiff(parseDate($('#fromdate').val()), parseDate($('#todate').val())))
        $('#nightnos').val(days).trigger('input');
    });

//    $(".roomform").submit(function(event) {
//        
//        alert($(this).serialize());
//        
//        var data = $(this).serialize();
//        var url = 'request.php?KEY=addapproom&'+data;
//
//        /* stop form from submitting normally */
//        event.preventDefault();
//
//        /* Send the data using post */
//        $.post(url, function(data) {
//            //location.reload(true);
//        });
//    });
};

function goBack() {
    window.history.back()
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function setToDate(input,output){
    $('input[name='+output+']').val('');
    $('#nightnos').val('');
    var myDate = new Date(input);
    myDate.setDate(myDate.getDate() + 1);
    var y = myDate.getFullYear(),
    m = myDate.getMonth() + 1, // january is month 0 in javascript
    d = myDate.getDate();
    var pad = function(val) { var str = val.toString(); return (str.length < 2) ? "0" + str : str};
    dateString = [y, pad(m), pad(d)].join("-");
    $('input[name='+output+']').attr('min', dateString);
}
function enableOptions(input){
    switch(input){
        case '4':
        case '1':    $('input[name=chqbank]').prop('disabled', true);
                        $('input[name=chqnum]').prop('disabled', true);
                        $('input[name=chqdate]').prop('disabled', true);
                        $('select[name=cardtype]').prop('disabled', true);
                        break;
        case '2':  $('input[name=chqbank]').prop('disabled', false);
                        $('input[name=chqnum]').prop('disabled', false);
                        $('input[name=chqdate]').prop('disabled', false);
                        $('select[name=cardtype]').prop('disabled', true);
                        break;

        case '3':   $('input[name=chqbank]').prop('disabled', true);
                                    $('input[name=chqnum]').prop('disabled', true);
                                    $('input[name=chqdate]').prop('disabled', true);
                                    $('select[name=cardtype]').prop('disabled', false);
                                    break;
    }   
}
function changeTotalForAddRooms(){
    var roomnos = $('#roomnos').val();
    var tariff = $('#tariff').val();
    var extraTariff = $('#extraTariff').val();
    var extrapax = $('#extrapax').val();
    var total = (roomnos * tariff) + (extrapax * extraTariff);
    $('#roomTotal').val(total);
    
} 
function calculateGrandTotal(){
    var basic = parseFloat($('#basic_amount').val());
    var scharge = parseFloat($('#scharge').val());
    var stax = parseFloat($('#stax').val());
    var ltax = parseFloat($('#ltax').val());
    
    var gtotal = basic + scharge + stax + ltax;
    $('#gtotal').val(gtotal);
}
function updatePrice(){
    value = ($('#tourname').find(':selected').data('rate')).split('**');
    $('#price').val(value[0]);
    $('#stax').val(value[1]);
    $('#seatsnote').html('<b>('+value[2]+')</b>');
}
function updateAmount(){
    var seats = $('#seats').val();
    var price = $('#price').val();
    var stax = $('#stax').val();
    $('#amount').val((seats*price)+(seats*stax));
}
function clearSeats(){
    $('#seats').val("");
    $('#amount').val("");
}
