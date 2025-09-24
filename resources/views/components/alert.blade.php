@if(session('error'))
    <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1100">
        <div id="alertToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" style="border-radius: 20px; background-color: #fff; color: #333; font-size: 1.1rem; min-width: 350px; padding: 0.75rem 1rem;">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('alertToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 4500
            });
            toast.show();
        }
    });
    </script>
@endif