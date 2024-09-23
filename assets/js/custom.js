$(document).ready(function(){
    var current_url = window.location;
    $('.treeview li a').filter(function () {
        return this.href == current_url;
    }).last().parents('li').addClass('active');
});
