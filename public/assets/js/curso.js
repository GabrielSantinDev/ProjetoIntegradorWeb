$(function () {

    iniciarValidacao();
    configurarModal();
    configurarPublicacao();
    configurarUpload();

});

function iniciarValidacao() {

    // -------------------------------------------------
    // Validação com jQuery Validation
    // -------------------------------------------------
    $('#formCurso').validate({
        rules: {
            titulo:        { required: true, minlength: 3 },
            descricao:     { required: true, minlength: 10 },
            preco:         { required: true, number: true, min: 0 },
            horas_duracao: { required: true, number: true, min: 0.5 },
            categoria:     { required: true, minlength: 3 },
        },
        messages: {
            titulo:        { required: 'O título é obrigatório.', minlength: 'Mínimo de 3 caracteres.' },
            descricao:     { required: 'A descrição é obrigatória.', minlength: 'Mínimo de 10 caracteres.' },
            preco:         { required: 'O preço é obrigatório.', number: 'Digite um valor válido.', min: 'O preço não pode ser negativo.' },
            horas_duracao: { required: 'A carga horária é obrigatória.', number: 'Digite um número válido.', min: 'Mínimo de 0.5h.' },
            categoria:     { required: 'A categoria é obrigatória.', minlength: 'Mínimo de 3 caracteres.' },
        },
        errorClass: 'invalid-feedback',
        errorElement: 'div',
        highlight: function (el) {
            $(el).addClass('is-invalid');
        },
        unhighlight: function (el) {
            $(el).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
}

function configurarModal() {

    // -------------------------------------------------
    // Ao abrir o modal via botão "Editar"
    // O botão Editar no card-curso.php tem data-curso='...'
    // -------------------------------------------------

    $('#modalCurso').on('show.bs.modal', function (e) {

        const btn = $(e.relatedTarget); // botão que disparou o modal
        const cursoRaw = btn.attr('data-curso');
        const curso = cursoRaw ? JSON.parse(cursoRaw) : null;

        if (curso) {
            // MODO EDIÇÃO
            $('#modalCursoTitulo').text('Editar Curso');
            $('#modalCursoSubtitulo').text('Preencha os dados para editar o curso.');
            $('#btnConfirmar').text('Salvar');
            $('#formCurso').attr('action', BASE_URL + '/instrutor/cursos/' + curso.id + '/editar');

            $('#cursoId').val(curso.id);
            $('#cursoTitulo').val(curso.titulo);
            $('#cursoDescricao').val(curso.descricao);
            $('#cursoPreco').val(curso.preco);
            $('#cursoHoras').val(curso.horas_duracao);
            $('#cursoCategoria').val(curso.categoria);

        } else {
            // MODO CRIAÇÃO — limpa tudo
            $('#modalCursoTitulo').text('Novo Curso');
            $('#modalCursoSubtitulo').text('Preencha os dados para criar um novo curso.');
            $('#btnConfirmar').text('Criar Curso');
            $('#formCurso').attr('action', BASE_URL + '/instrutor/cursos/novo');

            $('#cursoId').val('');
            $('#formCurso')[0].reset();
            $('#formCurso').find('.is-invalid').removeClass('is-invalid');
            $('#formCurso').find('.invalid-feedback').remove();
        }
    });
}

function configurarPublicacao() {

    // ================================
    // publicar/privar cursos

    $('.js-toggle-publicacao').on('click', function () {

        const btn = $(this);
        const id = btn.data('id');

        $.ajax({
            url: BASE_URL + '/instrutor/cursos/toggle-publicacao',
            type: 'POST',
            data: { id: id },
            dataType: 'json',

            success: function (res) {

                if (res.success) {

                    // troca texto
                    if (res.publicado) {
                        btn.html('<i class="fa-regular fa-eye"></i> Despublicar');
                    } else {
                        btn.html('<i class="fa-regular fa-eye"></i> Publicar');
                    }

                    // atualiza badge visual
                    const card = btn.closest('.course-card');

                    const badge = card.find('.badge-public, .badge-private');

                    if (res.publicado) {
                        badge
                            .removeClass('badge-private')
                            .addClass('badge-public')
                            .text('Público');
                    } else {
                        badge
                            .removeClass('badge-public')
                            .addClass('badge-private')
                            .text('Privado');
                    }

                    btn.data('publicado', res.publicado ? 1 : 0);
                }
            },

            error: function () {
                alert('Erro ao alterar publicação');
            }
        });
    });
}

function configurarUpload() {

    // ------------------
    // atualizar imagens

    // abrir seletor ao clicar na imagem do curso
    $('.js-thumb-upload').on('click', function () {
        const id = $(this).data('id');
        $('.js-input-image[data-id="' + id + '"]').trigger('click');
    });

    // -------
    // enviar imagens com ajax

    $('.js-input-image').on('change', function () {

        const input = this;
        const file = input.files[0];
        const id = $(this).data('id');

        if (!file) return;

        const formData = new FormData();
        formData.append('imagem', file);
        formData.append('id', id);

        $.ajax({
            url: BASE_URL + '/instrutor/cursos/' + id + '/atualizar-imagem',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',

            success: function (data) {

                if (data.success) {

                    // Atualiza a miniatura do curso com a nova imagem retornada pelo servidor

                    const thumb = $('.course-thumbnail[data-id="' + id + '"]');
                    if (thumb.length) {
                        // cache-busting to force reload
                        let newUrl = data.url || '';
                        if (newUrl) {
                            newUrl += (newUrl.indexOf('?') === -1 ? '?_=' : '&_=') + Date.now();
                        }

                        const img = thumb.find('img');
                        if (img.length) {
                            img.attr('src', newUrl);
                        } else {
                            // insert image at the start so overlay/badge remain
                            thumb.prepend('<img src="' + newUrl + '" alt="Thumb" class="img-fluid" />');
                        }
                    }

                    alert('Imagem atualizada com sucesso!');
                } else {
                    alert('Erro ao atualizar imagem: ' + (data.message || ''));
                }
            },

            error: function (xhr) {
                console.log("STATUS:", xhr.status);
                console.log("RESPOSTA:", xhr.responseText);
                alert("Erro no upload (veja console)");
            }
        });
    });

}