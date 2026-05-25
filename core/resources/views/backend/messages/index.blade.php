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
                            <td class="text-truncate" style="max-width:320px;">{{ \Illuminate\Support\Str::limit($message->message ?? '-', 80) }}</td>
                            <td>{{ optional($message->created_at)->diffForHumans() ?? '—' }}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary btn-view-message" 
                                    data-id="{{ $message->id }}"
                                    data-sender="{{ optional($message->sender)->name }}"
                                    data-recipient="{{ optional($message->recipient)->name }}"
                                    data-email="{{ optional($message->sender)->email }}"
                                    data-message="{{ e($message->message ?? '') }}"
                                    data-created="{{ optional($message->created_at)->toDayDateTimeString() }}"
                                >
                                    <i class="bi bi-eye"></i> View
                                </button>
                                <!-- Optional: add delete/edit buttons later -->
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
        <div id="m-body" class="small text-break">—</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
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

            document.getElementById('m-sender').textContent = sender;
            document.getElementById('m-recipient').textContent = recipient;
            document.getElementById('m-email').textContent = email;
            document.getElementById('m-body').innerHTML = message.replace(/\n/g, '<br>');
            document.getElementById('m-created').textContent = created;

            var modalEl = document.getElementById('messageModal');
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        });
    });
});
</script>

@endsection