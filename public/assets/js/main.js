// ==========================
// TEMA — dark/light
// Roda em todas as páginas
// ==========================
$(function () {

    // ----------------------
    // Aplicando tema salvo ao carregar usando cookies
    // Carregar tema salvo
    let temaSalvo = getCookie("theme") || "dark";

    document.documentElement.setAttribute('data-theme', temaSalvo);
    atualizarIconeTema(temaSalvo);

    // Trocar tema
    $('#theme-toggle').on('click', function () {

        const atual = document.documentElement.getAttribute('data-theme');
        const novo = atual === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-theme', novo);

        setCookie("theme", novo, 30);

        atualizarIconeTema(novo);
    });

    function atualizarIconeTema(tema) {
        const icon = $('#theme-icon');
        if (tema === 'dark') {
            icon.removeClass('fa-sun').addClass('fa-moon');

        } else {
            icon.removeClass('fa-moon').addClass('fa-sun');
        }
    }

    // ==========================
    // TOGGLE MOSTRAR/OCULTAR SENHA
    // ==========================
    $('#toggleSenha').on('click', function () {
        const input = $('#cadastroSenha, #loginSenha').filter(':visible').first();
        const icon  = $('#iconeSenha');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });


    // -------------------
    // Utilizando cookies
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

});