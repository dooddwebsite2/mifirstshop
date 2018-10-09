// set logistic 
var logistic_val = 30;
// set tax
var tax = 0;
function cal_all(Obj_all){
    var total = 0;
    if(Object.keys(Obj_all).length > 0){
        for (var key in Obj_all) {
            total += parseFloat(Obj_all[key]);
        }
    }
    $('#footer_sums').val(total + " ฿");
    var tax  = tax > 0 ? tax  : 0; 
    var sums = (total + logistic_val) - ((total + logistic_val) * tax) / 100;
    set_orders_summary(total,logistic_val,tax,sums);
}

function set_orders_summary(total,logistic_val,tax,sums){
    $('#sum_orders').text(total + " ฿"); $('#sum_orders').attr("value",total); 
    $('#logistic_orders').text(logistic_val + " ฿"); $('#logistic_orders').attr("value",logistic_val);
    $('#tax_orders').text(tax + " %");$('#tax_orders').attr("value",tax);
    $('#sum_all').text(sums + " ฿");$('#sum_all').attr("value",sums);
}


function cal_sums(product_id,percents,price,stock){
    
    var product_value = $('#input_amout_' + product_id).val();
    if(product_value <= stock){
        var percents  = percents > 0 ? percents  : 0; 
        var sums = (product_value * price) - (price * percents) / 100;
        $('#sums_'+ product_id).val(sums);
        Object_SUMS[product_id] = sums > 0 ? sums : 0;
        cal_all(Object_SUMS);
        call_amount(".input_amount");
    }
    else{
        alert("จำนวนสินค้าในสต็อคมีไม่เพียงพอ");
    }
}
function call_amount(prod_class){
    if($(prod_class).length > 0){
        $(prod_class).each(function(x,y) {
            var product_id = $(y).attr("hidden_id") > 0 ? $(y).attr("hidden_id") : 0;
            Object_AMOUNT[product_id] = $('#input_amout_' + product_id).val();
        });
    }
}

function on_load_set_default_value(){
    if($('.sum_input').length > 0){
        $('.sum_input').each(function(x,y) {
            var product_id = $(y).attr("hidden_id") > 0 ? $(y).attr("hidden_id") : 0;
            Object_SUMS[product_id] = $(y).val() > 0 ? $(y).val() : 0;
            
        });
        call_amount(".input_amount");
        cal_all(Object_SUMS);
        
    }
}