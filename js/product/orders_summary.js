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
