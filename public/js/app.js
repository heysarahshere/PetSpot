require('./bootstrap');
require('../../node_modules/bootstrap-select/dist/js/bootstrap-select.min');

$('.carousel').carousel();

$(function () {
    $('select').selectpicker('render');
});

// $(function(){
//     $(document).on('click', '.thumb', swapImage); //wire up click event
// });
