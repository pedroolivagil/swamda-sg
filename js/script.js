function ajaxForm(ruta, data, func) {
    $.ajax({
        url: ruta, //Url a donde la enviaremos
        type: 'POST', //Metodo que usaremos
        contentType: false, //Debe estar en false para que pase el objeto sin procesar
        data: data, //Le pasamos el objeto que creamos con los archivos
        processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache: false //Para que el formulario no guarde cache
    }).done(function (msg) {
        func(msg);
    }).fail(function (msg) {
        alert(msg);
    });
}
function loginNav() {
    var user = document.getElementById("user").value;
    var pass = document.getElementById("pass").value;
    login(user, pass, function (msg) {
        $('#modal-info-wrapper').html(msg);
    });
}
function loginCard() {
    var user = document.getElementById("usercard").value;
    var pass = document.getElementById("passcard").value;
    login(user, pass, function(msg){
        $('#modal-info-wrapper').html(msg);
    });
}
function login(user, pass, func) {
    var data = new FormData();
    data.append('user', user);
    data.append('pass', pass);
    ajaxForm('server/login.php', data, function(msg){
        $('#wrapper').load('components/wrapper.php');
        $('#header').load('components/nav.php');
        func(msg);
    });
}
function logoutNav() {
    var data = new FormData();
    ajaxForm('server/logout.php', data, function(msg){
        $('#header').load('components/nav.php');
        $('#wrapper').load('components/login-card.php');
    });
}
function togglePanel(idPanel, idButton, textShow, textHide) {
    $('#' + idPanel).toggle(300);
    $('#' + idButton).html($('#' + idButton).html() == textShow ? textHide : textShow );
}
function addCalendarEvent() {
    var title = document.getElementById("title").value;
    var users = $('#users').val();
    var start = document.getElementById("start").value;
    var end = document.getElementById("end").value;
    var startTime = document.getElementById("startTime").value;
    var endTime = document.getElementById("endTime").value;
    var url = document.getElementById("url").value;
    var data = new FormData();
    data.append('title', title);
    data.append('users', users);
    data.append('start', start);
    data.append('end', end);
    data.append('startTime', startTime);
    data.append('endTime', endTime);
    data.append('url', url);

    ajaxForm('server/add-calendar-event.php', data, function (msg) {
        $('#result-panel-modal-add-event').html(msg);
    });
}
function deleteCalendarDatatItem(row, idItem) {
    var data = new FormData();
    data.append('idItem', idItem);
    ajaxForm('server/delete-calendar-event.php', data, function (msg) {
        $('#result-panel-modal-delete-event').html(msg);
        $('#wrapper').load('components/wrapper.php');
        $(row).parent().parent().hide(300);
        $('#datatable-delete-events').DataTable().draw('full-hold');
    });
}
function hideAdminModal(){
    $(setTimeout(function () {
        $("#wrapper").load("components/wrapper.php");
        $("#adminModal").modal('hide');
    }, 1000));
}
function updateMinDate(idPanelDate, minDate) {
    $('#' + idPanelDate).attr('min', minDate);
    $('#' + idPanelDate).val('');
}
function collapsePanels(panels) {
    var panelsArr = panels.split(",");
    for (var index in panelsArr) {
        $(panelsArr[index]).collapse('hide');
    }
}
function editPassword() {
    var oldPass = document.getElementById("old-password").value;
    var newPass = document.getElementById("new-password-1").value;
    var newPassVerif = document.getElementById("new-password-2").value;
    var data = new FormData();
    data.append('oldPass', oldPass);
    data.append('newPass', newPass);
    data.append('newPassVerif', newPassVerif);
    ajaxForm('server/edit-password.php', data, function (msg) {
        $('#result-panel-modal-conf-event-pass').html(msg);
    });
}
function editEmail() {
    var email = document.getElementById("email").value;
    var emailVerify = document.getElementById("email-2").value;
    var data = new FormData();
    data.append('email', email);
    data.append('emailVerify', emailVerify);
    ajaxForm('server/edit-email.php', data, function (msg) {
        $('#result-panel-modal-conf-event-email').html(msg);
    });
}
function editPhone() {
    var phone = document.getElementById("phone").value;
    var data = new FormData();
    data.append('phone', phone);
    ajaxForm('server/edit-phone.php', data, function (msg) {
        $('#result-panel-modal-conf-event-phone').html(msg);
    });
}
function editColor() {
    var color = document.getElementById("color").value;
    var data = new FormData();
    data.append('color', color);
    ajaxForm('server/edit-color.php', data, function (msg) {
        $('#result-panel-modal-conf-event-color').html(msg);
    });
}

////////////////////////////////
// Auto ejecutable
$(document).ready(function () {
    var exampleModal = document.getElementById('adminModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        $('#admin-modal-body').load('components/modal-'+ recipient+'-event.php');
    });
});