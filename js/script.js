function ajaxForm(ruta, data, func) {
    $.ajax({
        url: ruta, //Url a donde la enviaremos
        type: 'POST', //Metodo que usaremos
        contentType: false, //Debe estar en false para que pase el objeto sin procesar
        data: data, //Le pasamos el objeto que creamos con los archivos
        processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache: false //Para que el formulario no guarde cache
    }).done(function(msg) {
        func(msg);
    }).fail(function(msg) {
        alert(msg);
    });
}

function loginCard() {
    var user = document.getElementById("usercard").value;
    var pass = document.getElementById("passcard").value;
    var data = new FormData();
    data.append('user', user);
    data.append('pass', pass);
    ajaxForm('server/login.php', data, function(msg) {
        $('#modal-info-wrapper').html(msg);
    });
}

function reloadFrames(time) {
    $(setTimeout(function() {
        reloadFrontal();
        // $('#header').load('components/nav.php');
        // $('#wrapper').load('components/wrapper.php');
    }, time));
}

function reloadFrontal() {
    $('#header, #wrapper').hide(function() {
        $('#header').load('components/nav.php', function() {
            $('#header').fadeIn(500);
        });
        $('#wrapper').load('components/wrapper.php', function() {
            $('#wrapper').fadeIn(500);
        });
    });
}

function logoutNav() {
    var data = new FormData();
    ajaxForm('server/logout.php', data, function(msg) {
        $('#header').load('components/nav.php');
        $('#wrapper').load('components/login-card.php');
    });
}

function togglePanel(idPanel, idButton, textShow, textHide) {
    $('#' + idPanel).toggle(300);
    $('#' + idButton).html($('#' + idButton).html() == textShow ? textHide : textShow);
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

    ajaxForm('server/add-calendar-event.php', data, function(msg) {
        $('#result-panel-modal-add-event').html(msg);
    });
}

function deleteCalendarDatatItem(row, idItem) {
    var data = new FormData();
    data.append('idItem', idItem);
    ajaxForm('server/delete-calendar-event.php', data, function(msg) {
        $('#result-panel-modal-delete-event').html(msg);
        $('#wrapper').load('components/wrapper.php');
        $(row).parent().parent().hide(300);
        $('#datatable-delete-events').DataTable().draw('full-hold');
    });
}

function hideAdminModal() {
    $(setTimeout(function() {
        $("#wrapper").load("components/wrapper.php");
        $("#adminModal").modal('hide');
    }, 1000));
}

function updateAdminModal(modal, type, func) {
    $(setTimeout(function() {
        $('#admin-modal-body').load('components/modal-' + modal + '-event.php');
        $(setTimeout(function() {
            $('#collapse-' + type).collapse('show');
            func();
        }, 250));
    }, 1000));
}

function getToday() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
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
    ajaxForm('server/edit-password.php', data, function(msg) {
        $('#result-panel-modal-conf-event-pass').html(msg);
    });
}

function editEmail() {
    var email = document.getElementById("email").value;
    var emailVerify = document.getElementById("email-2").value;
    var data = new FormData();
    data.append('email', email);
    data.append('emailVerify', emailVerify);
    ajaxForm('server/edit-email.php', data, function(msg) {
        $('#result-panel-modal-conf-event-email').html(msg);
    });
}

function editPhone() {
    var phone = document.getElementById("phone").value;
    var data = new FormData();
    data.append('phone', phone);
    ajaxForm('server/edit-phone.php', data, function(msg) {
        $('#result-panel-modal-conf-event-phone').html(msg);
    });
}

function editColor() {
    var color = document.getElementById("color").value;
    var data = new FormData();
    data.append('color', color);
    data.append('modalId', 'conf');
    ajaxForm('server/edit-color.php', data, function(msg) {
        $('#result-panel-modal-conf-event-color').html(msg);
    });
}

function editColorUsers(event) {
    var idUser = event.getAttribute('data-bs-iduser');
    var color = document.getElementById('color-user' + idUser).value;
    var userId = document.getElementById('user-id' + idUser).value;
    var data = new FormData();
    data.append('color', color);
    data.append('userId', userId);
    data.append('panelId', 'colors');
    data.append('modalId', 'gestion');

    ajaxForm('server/edit-color.php', data, function(msg) {
        $('#result-panel-modal-gestion-event-color').html(msg);
    });
}

function newUser() {
    var realname = document.getElementById('realname').value;
    var realsurname = document.getElementById('realsurname').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var data = new FormData();
    data.append('realname', realname);
    data.append('realsurname', realsurname);
    data.append('phone', phone);
    data.append('email', email);

    ajaxForm('server/new-user.php', data, function(msg) {
        $('#result-panel-modal-gestion-event-newuser').html(msg);
    });
}

function delUser() {
    var users = document.getElementById('users').value;
    var password = document.getElementById('password').value;
    var data = new FormData();
    data.append('iduser', users);
    data.append('password', password);

    ajaxForm('server/del-user.php', data, function(msg) {
        $('#result-panel-modal-gestion-event-deluser').html(msg);
    });
}

////////////////////////////////
// Auto ejecutable
$(document).ready(function() {
    var adminModal = document.getElementById('adminModal')
    adminModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var recipient = button.getAttribute('data-bs-whatever');
        var panelId = button.getAttribute('id');
        var blurredPanels = button.getAttribute('data-bs-blur-panels');
        var defaultContent = button.getAttribute('data-bs-default-collapse-panel');
        $('#admin-modal-body').load('components/modal-' + recipient + '-event.php', function() {
            if (defaultContent != null) {
                $(setTimeout(function() {
                    $(defaultContent).collapse('show');
                }, 150));
            }
            if (blurredPanels != null) {
                $('#recovery').attr('data-bs-restore-blur', panelId);
                var panelsArr = blurredPanels.split(",");
                for (var index in panelsArr) {
                    $(panelsArr[index]).addClass('filter-blur-10');
                }
            }
        });
    });
    adminModal.addEventListener('hidden.bs.modal', function(event) {
        var panelId = $('#recovery').attr('data-bs-restore-blur');
        var blurredPanels = $('#' + panelId).attr('data-bs-blur-panels');
        if (blurredPanels != null) {
            var panelsArr = blurredPanels.split(",");
            for (var index in panelsArr) {
                $(panelsArr[index]).removeClass('filter-blur-10');
            }
        }
    });
});