(function ($) {
    "use strict";
function hitung(){
	$('tr').each(function () {
         var sum = 0;
         var sum2 = 0;
         $(this).find('.unitsum').each(function () {
             var unitsum = $(this).text();
             if (!isNaN(unitsum) && unitsum.length !== 0) {
                 sum += parseFloat(unitsum);
             }
         });
         $(this).find('.footer-sum').each(function () {
             var footersum = $(this).text();
             if (!isNaN(footersum) && footersum.length !== 0) {
                 sum2 += parseFloat(footersum);
             }
         });
         $(this).find('.total-unitsum').html(
            Math.round(sum + "e+2")  + "e-2"
            //Math.round(sum + "e+2")  + "e-2"
            );
         $(this).find('.total-footer-sum').html(
            Math.round(sum2 + "e+2")  + "e-2"
            );
     });
}
function formatCurrency(){
    $('.auto').autoNumeric('init',{
        aSign:'Rp. ',
        aDec:',',
        //mDec:'2',
        aSep:'.',
        maximumValue:'10000000000000',
        minimumValue:'-10000000000000',
        vMax:'10000000000000',
        vMin:'-10000000000000',
        });
    $('.auto').css('text-align','right');
}
function sumColumn(){
    var i=0;
    for (i=0;i<$('tbody tr:eq(0) td').length;i++) {
        var total = 0;
        $('td.unitsum:eq(' + i + ')', 'tr').each(function(i) {
            total = total + parseInt($(this).text());
        });            
        $('.footer-sum').eq(i).text(total);
    }
}
sumColumn();
    hitung();
        formatCurrency();
        
}(jQuery));