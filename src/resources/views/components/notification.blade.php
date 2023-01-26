@if(Session::get('message') !== null )
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let message = "{{ Session::get('message') }}"
        window.notyf.open({
            type: 'success',
            message,
            duration: '5000',
            ripple: true,
            dismissible: true,
        });
    });
</script>
@endif
