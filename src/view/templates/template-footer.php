<script
    src="https://code.jquery.com/jquery-3.7.1.min.js">
</script>

<script
    src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js">
</script>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<script src="<?= BASE_URL ?>/assets/js/modal-curso.js"></script>

<script>

    $(function () {

        $('#theme-toggle').click(function () {

            let html = document.documentElement;

            let theme = html.getAttribute('data-theme');

            let nextTheme =
                theme === 'dark'
                    ? 'light'
                    : 'dark';

            html.setAttribute(
                'data-theme',
                nextTheme
            );

            localStorage.setItem(
                'theme',
                nextTheme
            );

        });

        let savedTheme =
            localStorage.getItem('theme');

        if (savedTheme) {

            document.documentElement
                .setAttribute(
                    'data-theme',
                    savedTheme
                );
        }

    });

</script>

</body>
</html>