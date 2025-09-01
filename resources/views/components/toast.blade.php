@if(session('success'))
    <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1100">
        <div id="actionToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" style="border-radius: 20px; background-color: #fff; color: #333; font-size: 1.1rem; min-width: 350px; padding: 0.75rem 1rem;">
            <div class="d-flex">
            <div class="toast-body">
                ✅ Event: 
                <span class="fw-bold text-danger" style="text-decoration: underline;">
                {{ session('title') ?? '' }}
                </span>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
@endif

@if(session('success'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('actionToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 4000
            });
            toast.show();
        }
    });
    </script>
@endif