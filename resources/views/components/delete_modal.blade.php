@auth
    @if(Auth::user()->user_type === 'Organiser')
    <!-- Shared Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title text-white" id="deleteModalLabel">Delete Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Are you sure you want to delete <strong id="modal-event-title"></strong>? -->
            Are you sure you want to delete <strong class="text-danger" style="text-decoration: underline;" id="modal-event-title"></strong>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <!-- Trigger form submit -->
            <form id="delete-form" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Confirm Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteModal');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var eventId = button.getAttribute('data-id');
            var eventTitle = button.getAttribute('data-title');
            var targetUrl = button.getAttribute('data-url');

            // update modal title
            deleteModal.querySelector('#modal-event-title').textContent = eventTitle;

            // update delete form action
            deleteModal.querySelector('#delete-form').action = targetUrl;
        });
    });
    </script>
    @endif
@endauth
