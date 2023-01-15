<script src="{{ Vite::js('jquery-3.6.1.min.js') }}"></script>
<script src="https://jsuites.net/v4/jsuites.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@yield('js')
@stack('js')

<script>
@if(session('success'))
    toastr.success('{{ session('success') }}');
@endif
</script>

<script>
    function showModal(id) {
        $(`#${id}`).modal('show');
    }

    function closeModal(id, reset_form = '') {
        $(`#${id}`).modal('hide');
        if (reset_form != '') {
            $(`#${reset_form}`)[0].reset();
        }
    }
</script>