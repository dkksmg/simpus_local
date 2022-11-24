    <!-- CoreUI and necessary plugins-->
    <script src="{{ url('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ url('vendors/simplebar/js/simplebar.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ url('vendors/@coreui/utils/js/coreui-utils.js') }}"></script>

    <script>
        if (document.body.classList.contains('dark-theme')) {
            var element = document.getElementById('btn-dark-theme');
            if (typeof(element) != 'undefined' && element != null) {
                document.getElementById('btn-dark-theme').checked = true;
            }
        } else {
            var element = document.getElementById('btn-light-theme');
            if (typeof(element) != 'undefined' && element != null) {
                document.getElementById('btn-light-theme').checked = true;
            }
        }

        function handleThemeChange(src) {
            var event = document.createEvent('Event');
            event.initEvent('themeChange', true, true);

            if (src.value === 'light') {
                document.body.classList.remove('dark-theme');
            }
            if (src.value === 'dark') {
                document.body.classList.add('dark-theme');
            }
            document.body.dispatchEvent(event);
        }
    </script>
