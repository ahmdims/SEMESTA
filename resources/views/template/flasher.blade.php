@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "OK, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                },
                timer: 2000,
                timerProgressBar: true
            });
        });
    </script>
@elseif (session('warning'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                text: "{{ session('warning') }}",
                icon: "warning",
                buttonsStyling: false,
                confirmButtonText: "OK, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                },
                timer: 2000,
                timerProgressBar: true
            });
        });
    </script>
@elseif (session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                text: "{{ session('error') }}",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "OK, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                },
                timer: 2000,
                timerProgressBar: true
            });
        });
    </script>
@elseif (session('status'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                text: "{{ session('status') }}",
                icon: "info",
                buttonsStyling: false,
                confirmButtonText: "OK, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                },
                timer: 2000,
                timerProgressBar: true
            });
        });
    </script>
@elseif ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "OK, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                },
                timer: 2000,
                timerProgressBar: true
            });
        });
    </script>
@endif