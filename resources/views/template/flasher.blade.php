@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: "Oke, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            });
        });
    </script>
@elseif (session('warning'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                text: "{{ session('warning') }}",
                icon: "warning",
                buttonsStyling: !1,
                confirmButtonText: "Oke, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            });
        });
    </script>
@elseif (session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                text: "{{ session('error') }}",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "Oke, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            });
        });
    </script>
@elseif (session('status'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                text: "{{ session('status') }}",
                icon: "info",
                buttonsStyling: !1,
                confirmButtonText: "Oke, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            });
        });
    </script>
@elseif ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "Oke, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            });
        });
    </script>
@endif