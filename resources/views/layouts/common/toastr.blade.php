<script>
    $(document).ready(function() {
    @if(Session::has('message'))
        toastr.success("{{ session('message') }}", "Tudo certo!");
    @endif

    @if(Session::has('error'))
        toastr.error("{{ session('error') }}", "Ops.. Ocorreu um Erro!");
    @endif

    @if(Session::has('info'))
        toastr.info("{{ session('info') }}", "Informação!");
    @endif

    @if(Session::has('warning'))
        toastr.warning("{{ session('warning') }}", "Aviso!");
    @endif

    @if(Session::has('success'))
        toastr.success("{{ session('success') }}", "Tudo certo!");
    @endif
    });

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>
