@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3 shadow-sm" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid mt-4">
    <div class="card shadow-sm mx-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Inbox Messages</h5>
            <small class="text-muted">Users' personal messages</small>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <input id="messagesSearch" class="form-control form-control-sm" type="search" placeholder="Search sender..." aria-label="Search sender">
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sender</th>
                            <th scope="col">Receiver</th>
                            <th scope="col">Message</th>
                            <th scope="col">Received</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages ?? collect() as $message)
                        <tr>
                            <td>{{ $loop->iteration + (($messages->currentPage() ?? 1) - 1) * ($messages->perPage() ?? 0) }}</td>
                            <td>
                                <div>{{ optional($message->sender)->name ?? '—' }}</div>
                                <div class="small text-muted">{{ optional($message->sender)->email ?? '—' }}</div>
                            </td>
                            <td>
                                <div>{{ optional($message->recipient)->name ?? '—' }}</div>
                                <div class="small text-muted">{{ optional($message->recipient)->email ?? '—' }}</div>
                            </td>
                            <td class="text-truncate" style="max-width:320px;">
                                @if($message->image_path)
                                    <img src="{{ route('media.show', ['path' => $message->image_path]) }}" alt="image" class="rounded me-2" style="max-height:60px; width:auto;">
                                @endif
                                <span>{{ \Illuminate\Support\Str::limit($message->message ?? '-', 80) }}</span>
                            </td>
                            <td>{{ optional($message->created_at)->diffForHumans() ?? '—' }}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary btn-view-message" 
                                    data-id="{{ $message->id }}"
                                    data-sender="{{ optional($message->sender)->name }}"
                                    data-recipient="{{ optional($message->recipient)->name }}"
                                    data-email="{{ optional($message->sender)->email }}"
                                    data-message="{{ e($message->message ?? '') }}"
                                    data-image="{{ $message->image_path ? route('media.show', ['path' => $message->image_path]) : '' }}"
                                    data-created="{{ optional($message->created_at)->toDayDateTimeString() }}"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-message ms-1" 
                                    data-action="{{ route('messages.update', $message->id) }}"
                                    data-message="{{ e($message->message ?? '') }}"
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form method="POST" action="{{ route('messages.destroy', $message->id) }}" class="d-inline-block ms-1" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No messages found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Showing {{ $messages->count() ?? 0 }} of {{ $messages->total() ?? ($messages->count() ?? 0) }}
                </div>
                <div>
                    @if(method_exists($messages, 'links'))
                        {{ $messages->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message View Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <dl class="row">

          <dt class="col-sm-3">From</dt>
          <dd class="col-sm-9" id="m-sender">—</dd>

          <dt class="col-sm-3">To</dt>
          <dd class="col-sm-9" id="m-recipient">—</dd>

          <dt class="col-sm-3">Email</dt>
          <dd class="col-sm-9" id="m-email">—</dd>

          <dt class="col-sm-3">Received</dt>
          <dd class="col-sm-9" id="m-created">—</dd>
        </dl>

        <hr />
        <div id="m-image" class="mb-3 text-center"></div>
        <div id="m-body" class="small text-break">—</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Message Modal -->
<div class="modal fade" id="editMessageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="editMessageForm" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="editMessageText" class="form-label">Message text</label>
            <textarea id="editMessageText" name="message" class="form-control" rows="4" maxlength="1000"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var viewButtons = document.querySelectorAll('.btn-view-message');
    viewButtons.forEach(function(btn){
        btn.addEventListener('click', function (){
            var sender = this.dataset.sender || '—';
            var email = this.dataset.email || '—';
            var recipient = this.dataset.recipient || '—';
            var message = this.dataset.message || '';
            var created = this.dataset.created || '—';
            var imageUrl = this.dataset.image || '';

            document.getElementById('m-sender').textContent = sender;
            document.getElementById('m-recipient').textContent = recipient;
            document.getElementById('m-email').textContent = email;
            var imageContainer = document.getElementById('m-image');
            if (imageUrl) {
                imageContainer.innerHTML = '<img src="' + imageUrl + '" class="img-fluid rounded" style="max-height:360px;">';
            } else {
                imageContainer.innerHTML = '';
            }
            document.getElementById('m-body').innerHTML = message.replace(/\n/g, '<br>');
            document.getElementById('m-created').textContent = created;

            var modalEl = document.getElementById('messageModal');
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        });
    });

    // Live search (client-side) - filters rows by sender name as you type
    function debounce(fn, delay) {
        var timer;
        return function () {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () { fn.apply(context, args); }, delay);
        };
    }

    var editButtons = document.querySelectorAll('.btn-edit-message');
    editButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var action = this.dataset.action;
            var messageText = this.dataset.message || '';

            var editForm = document.getElementById('editMessageForm');
            editForm.action = action;
            document.getElementById('editMessageText').value = messageText;

            var editModal = new bootstrap.Modal(document.getElementById('editMessageModal'));
            editModal.show();
        });
    });

    var searchInput = document.getElementById('messagesSearch');
    if (searchInput) {
        var onSearch = function (e) {
            var q = (e.target.value || '').toLowerCase().trim();
            var rows = document.querySelectorAll('table tbody tr');
            rows.forEach(function (row) {
                // sender is cell index 1
                var sender = (row.cells[1] && row.cells[1].innerText || '').toLowerCase();
                if (!q || sender.indexOf(q) !== -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        };

        searchInput.addEventListener('input', debounce(onSearch, 200));
    }
});
</script>

@endsection