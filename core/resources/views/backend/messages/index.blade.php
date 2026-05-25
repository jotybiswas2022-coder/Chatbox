@extends('backend.app')

@section('content')

@if (session('success'))
<div class="alert-toast" id="successToast">
    <span class="toast-icon">✓</span>
    <span>{{ session('success') }}</span>
    <button class="toast-close" onclick="this.parentElement.remove()">×</button>
</div>
@endif

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

    :root {
        --bg:          #f8fafc;
        --surface:     #ffffff;
        --surface2:    #f1f5f9;
        --border:      #e2e8f0;
        --accent:      #2563eb;
        --accent-glow: rgba(37,99,235,.16);
        --accent2:     #14b8a6;
        --danger:      #ef4444;
        --warn:        #f59e0b;
        --text:        #111827;
        --muted:       #6b7280;
        --radius:      12px;
        --font:        'Plus Jakarta Sans', sans-serif;
        --mono:        'JetBrains Mono', monospace;
        --shadow:      0 10px 30px rgba(15,23,42,.08);
    }

    /* ── Base ── */
    body { background: var(--bg); color: var(--text); font-family: var(--font); }

    /* ── Toast ── */
    .alert-toast {
        position: fixed; top: 22px; right: 22px; z-index: 9999;
        display: flex; align-items: center; gap: 10px;
        background: var(--surface2); border: 1px solid var(--accent2);
        border-radius: var(--radius); padding: 14px 18px;
        box-shadow: 0 8px 32px rgba(56,226,196,.18);
        font-size: .9rem; animation: slideIn .35s cubic-bezier(.4,0,.2,1);
    }
    .toast-icon { color: var(--accent2); font-weight: 700; }
    .toast-close {
        margin-left: 8px; background: none; border: none;
        color: var(--muted); cursor: pointer; font-size: 1.1rem;
    }
    @keyframes slideIn { from { opacity:0; transform:translateX(40px); } to { opacity:1; transform:translateX(0); } }

    /* ── Page wrapper ── */
    .inbox-page { padding: 32px 28px; max-width: 1400px; margin: 0 auto; }

    /* ── Header ── */
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-end;
        margin-bottom: 28px;
    }
    .page-header h1 {
        font-size: 1.7rem; font-weight: 700; letter-spacing: -.4px;
        background: linear-gradient(135deg, var(--text) 40%, var(--accent));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        margin: 0;
    }
    .page-header .sub { color: var(--muted); font-size: .82rem; margin-top: 4px; }

    /* ── Stats strip ── */
    .stats-strip { display: flex; gap: 14px; margin-bottom: 24px; }
    .stat-pill {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 50px; padding: 7px 18px;
        font-size: .8rem; color: var(--muted); display: flex; align-items: center; gap: 7px;
    }
    .stat-pill span { color: var(--text); font-weight: 600; font-size: .9rem; }

    /* ── Card ── */
    .inbox-card {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden;
    }

    .card-toolbar {
        padding: 18px 22px; border-bottom: 1px solid var(--border);
        display: flex; align-items: center; gap: 14px;
        background: var(--surface);
    }
    .card-toolbar {
        padding: 18px 22px; border-bottom: 1px solid var(--border);
        display: flex; align-items: center; gap: 14px;
    }

    /* ── Search ── */
    .search-wrap { position: relative; flex: 1; max-width: 340px; }
    .search-wrap svg {
        position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
        color: var(--muted); pointer-events: none;
    }
    .search-wrap input {
        width: 100%; background: var(--surface); border: 1px solid var(--border);
        border-radius: 8px; padding: 9px 14px 9px 38px;
        color: var(--text); font-family: var(--font); font-size: .85rem;
        transition: border-color .2s, box-shadow .2s;
    }
    .search-wrap input:focus {
        outline: none; border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-glow);
    }
    .search-wrap input::placeholder { color: var(--muted); }

    /* ── Table ── */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: .875rem; }
    thead tr { border-bottom: 1px solid var(--border); }
    thead th {
        padding: 13px 18px; text-align: left; font-weight: 600;
        font-size: .75rem; text-transform: uppercase; letter-spacing: .07em;
        color: var(--muted); white-space: nowrap;
    }
    tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .15s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--surface2); }
    td { padding: 14px 18px; vertical-align: middle; }

    /* ── Index badge ── */
    .idx {
        display: inline-flex; align-items: center; justify-content: center;
        width: 28px; height: 28px; border-radius: 7px;
        background: var(--bg); border: 1px solid var(--border);
        font-family: var(--mono); font-size: .72rem; color: var(--muted);
    }

    /* ── Avatar-name cell ── */
    .user-cell { display: flex; align-items: center; gap: 11px; }
    .avatar {
        width: 36px; height: 36px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: .85rem; flex-shrink: 0;
        border: 2px solid var(--border);
    }
    .av-blue  { background: rgba(79,142,247,.15); color: var(--accent); border-color: rgba(79,142,247,.3); }
    .av-teal  { background: rgba(56,226,196,.12); color: var(--accent2); border-color: rgba(56,226,196,.25); }
    .user-name { font-weight: 600; font-size: .87rem; }
    .user-email { font-size: .75rem; color: var(--muted); margin-top: 1px; }

    /* ── Message preview ── */
    .msg-preview { display: flex; align-items: center; gap: 9px; max-width: 320px; }
    .msg-preview img { border-radius: 6px; height: 40px; width: auto; object-fit: cover; border: 1px solid var(--border); }
    .msg-text { color: var(--muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: .83rem; }

    /* ── Time badge ── */
    .time-badge {
        font-size: .75rem; color: var(--muted); font-family: var(--mono);
        white-space: nowrap;
    }

    /* ── Action buttons ── */
    .actions { display: flex; align-items: center; gap: 7px; justify-content: flex-end; }
    .btn-icon {
        width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--border);
        background: transparent; cursor: pointer; display: inline-flex;
        align-items: center; justify-content: center; transition: all .18s;
        color: var(--muted); font-size: .85rem;
    }
    .btn-icon:hover        { border-color: var(--accent); color: var(--accent); background: var(--accent-glow); }
    .btn-icon.edit:hover   { border-color: var(--warn); color: var(--warn); background: rgba(247,169,65,.12); }
    .btn-icon.del:hover    { border-color: var(--danger); color: var(--danger); background: rgba(247,89,107,.12); }

    /* ── Pagination ── */
    .table-footer {
        display: flex; justify-content: space-between; align-items: center;
        padding: 16px 22px; border-top: 1px solid var(--border);
        font-size: .8rem; color: var(--muted);
        background: var(--surface2);
    }
    .table-footer .pagination { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
    .table-footer .page-link {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 9px; padding: 7px 13px; color: var(--text);
        font-size: .8rem; text-decoration: none; transition: all .15s;
        min-width: 42px; text-align: center;
    }
    .table-footer .page-item.active .page-link {
        border-color: var(--accent); color: #ffffff; background: var(--accent);
    }
    .table-footer .page-link:hover {
        background: #eff6ff; border-color: #bfdbfe; color: var(--text);
    }
    .table-footer .page-item.disabled .page-link {
        opacity: .55; cursor: not-allowed;
        background: var(--surface2); border-color: var(--border);
    }
    .table-footer .pagination .page-item:first-child .page-link,
    .table-footer .pagination .page-item:last-child .page-link {
        padding-left: 10px; padding-right: 10px;
    }

    /* ── Empty state ── */
    .empty-state { text-align: center; padding: 60px 20px; color: var(--muted); }
    .empty-state svg { margin-bottom: 16px; opacity: .35; }
    .empty-state p { margin: 0; font-size: .9rem; }

    /* ── Modal ── */
    .modal-content {
        background: var(--surface) !important;
        border: 1px solid var(--border) !important;
        border-radius: var(--radius) !important;
        color: var(--text) !important;
    }
    .modal-header {
        border-bottom: 1px solid var(--border) !important;
        padding: 18px 22px !important;
    }
    .modal-title { font-weight: 700 !important; font-size: 1rem !important; }
    .btn-close { filter: invert(1) brightness(.6); }
    .modal-footer { border-top: 1px solid var(--border) !important; padding: 14px 22px !important; }

    .detail-grid { display: grid; grid-template-columns: 120px 1fr; gap: 12px 16px; align-items: start; }
    .detail-label { font-size: .75rem; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); font-weight: 600; padding-top: 2px; }
    .detail-value { font-size: .88rem; word-break: break-word; }
    .detail-divider { grid-column: 1/-1; border: none; border-top: 1px solid var(--border); margin: 4px 0; }

    .msg-body-block {
        grid-column: 1/-1; background: var(--bg); border: 1px solid var(--border);
        border-radius: 10px; padding: 16px; font-size: .875rem; line-height: 1.65;
        color: var(--text); max-height: 280px; overflow-y: auto;
    }

    textarea.form-control {
        background: var(--bg) !important; border: 1px solid var(--border) !important;
        border-radius: 8px !important; color: var(--text) !important;
        font-family: var(--font) !important; font-size: .875rem !important;
        resize: vertical;
    }
    textarea.form-control:focus {
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 3px var(--accent-glow) !important;
        outline: none !important;
    }
    label.form-label { font-size: .78rem; font-weight: 600; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); }

    .btn-primary-custom {
        background: var(--accent); border: none; border-radius: 8px;
        color: #fff; font-family: var(--font); font-weight: 600;
        padding: 9px 20px; cursor: pointer; font-size: .85rem;
        transition: opacity .18s, transform .12s;
    }
    .btn-primary-custom:hover { opacity: .88; transform: translateY(-1px); }
    .btn-secondary-custom {
        background: transparent; border: 1px solid var(--border); border-radius: 8px;
        color: var(--muted); font-family: var(--font); font-weight: 500;
        padding: 9px 20px; cursor: pointer; font-size: .85rem; transition: all .18s;
    }
    .btn-secondary-custom:hover { border-color: var(--muted); color: var(--text); }

    /* scrollbar */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }
</style>

<div class="inbox-page">

    {{-- Header --}}
    <div class="page-header">
        <div>
            <h1>Inbox</h1>
            <div class="sub">Users' personal messages</div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-strip">
        <div class="stat-pill">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z M4 9h16"/></svg>
            Total &nbsp;<span>{{ $messages->total() ?? ($messages->count() ?? 0) }}</span>
        </div>
        <div class="stat-pill">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            Page &nbsp;<span>{{ $messages->currentPage() ?? 1 }}</span> of <span>{{ $messages->lastPage() ?? 1 }}</span>
        </div>
    </div>

    {{-- Card --}}
    <div class="inbox-card">
        <div class="card-toolbar">
            <div class="search-wrap">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <input id="messagesSearch" type="search" placeholder="Search by sender…">
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Message</th>
                        <th>Received</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages ?? collect() as $message)
                    @php
                        $senderName    = optional($message->sender)->name ?? '—';
                        $recipientName = optional($message->recipient)->name ?? '—';
                        $senderInitial    = strtoupper(substr($senderName, 0, 1));
                        $recipientInitial = strtoupper(substr($recipientName, 0, 1));
                    @endphp
                    <tr>
                        <td>
                            <span class="idx">{{ $loop->iteration + (($messages->currentPage() ?? 1) - 1) * ($messages->perPage() ?? 0) }}</span>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar av-blue">{{ $senderInitial }}</div>
                                <div>
                                    <div class="user-name">{{ $senderName }}</div>
                                    <div class="user-email">{{ optional($message->sender)->email ?? '—' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar av-teal">{{ $recipientInitial }}</div>
                                <div>
                                    <div class="user-name">{{ $recipientName }}</div>
                                    <div class="user-email">{{ optional($message->recipient)->email ?? '—' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="msg-preview">
                                @if($message->image_path)
                                <img src="{{ route('media.show', ['path' => $message->image_path]) }}" alt="img">
                                @endif
                                <span class="msg-text">{{ \Illuminate\Support\Str::limit($message->message ?? '—', 70) }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="time-badge">{{ optional($message->created_at)->diffForHumans() ?? '—' }}</span>
                        </td>
                        <td>
                            <div class="actions">
                                <button type="button" class="btn-icon btn-view-message"
                                    data-id="{{ $message->id }}"
                                    data-sender="{{ optional($message->sender)->name }}"
                                    data-recipient="{{ optional($message->recipient)->name }}"
                                    data-email="{{ optional($message->sender)->email }}"
                                    data-message="{{ e($message->message ?? '') }}"
                                    data-image="{{ $message->image_path ? route('media.show', ['path' => $message->image_path]) : '' }}"
                                    data-created="{{ optional($message->created_at)->toDayDateTimeString() }}"
                                    title="View">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                                <button type="button" class="btn-icon edit btn-edit-message"
                                    data-action="{{ route('messages.update', $message->id) }}"
                                    data-message="{{ e($message->message ?? '') }}"
                                    title="Edit">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <form method="POST" action="{{ route('messages.destroy', $message->id) }}" class="d-inline-block" onsubmit="return confirm('Delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon del" title="Delete">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M4 9h16M9 4v5"/></svg>
                                <p>No messages found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div>Showing <strong>{{ $messages->count() ?? 0 }}</strong> of <strong>{{ $messages->total() ?? ($messages->count() ?? 0) }}</strong> messages</div>
            <div>
                @if(method_exists($messages, 'links'))
                    {{ $messages->links() }}
                @endif
            </div>
        </div>
    </div>
</div>

{{-- View Modal --}}
<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right:8px;vertical-align:middle;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            Message Details
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="padding:22px;">
        <div class="detail-grid">
          <span class="detail-label">From</span>
          <span class="detail-value" id="m-sender">—</span>

          <span class="detail-label">To</span>
          <span class="detail-value" id="m-recipient">—</span>

          <span class="detail-label">Email</span>
          <span class="detail-value" id="m-email">—</span>

          <span class="detail-label">Received</span>
          <span class="detail-value" id="m-created" style="font-family:var(--mono);font-size:.8rem;">—</span>

          <hr class="detail-divider">

          <div id="m-image" class="detail-grid" style="display:none;grid-column:1/-1;text-align:center;margin-bottom:4px;"></div>

          <div class="msg-body-block" id="m-body">—</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editMessageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="editMessageForm" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">
              <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right:8px;vertical-align:middle;"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              Edit Message
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding:22px;">
          <label for="editMessageText" class="form-label">Message text</label>
          <textarea id="editMessageText" name="message" class="form-control" rows="5" maxlength="1000"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-primary-custom">Update Message</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Auto-dismiss success toast
    var toast = document.getElementById('successToast');
    if (toast) setTimeout(function(){ toast.style.opacity='0'; toast.style.transition='opacity .4s'; setTimeout(function(){ toast.remove(); }, 400); }, 3500);

    // View modal
    document.querySelectorAll('.btn-view-message').forEach(function(btn){
        btn.addEventListener('click', function(){
            document.getElementById('m-sender').textContent    = this.dataset.sender    || '—';
            document.getElementById('m-recipient').textContent = this.dataset.recipient || '—';
            document.getElementById('m-email').textContent     = this.dataset.email     || '—';
            document.getElementById('m-created').textContent   = this.dataset.created   || '—';

            var imgBox = document.getElementById('m-image');
            var imgUrl = this.dataset.image || '';
            if (imgUrl) {
                imgBox.style.display = 'block';
                imgBox.innerHTML = '<img src="'+imgUrl+'" class="img-fluid rounded" style="max-height:280px;border:1px solid var(--border);border-radius:10px;">';
            } else {
                imgBox.style.display = 'none';
                imgBox.innerHTML = '';
            }
            document.getElementById('m-body').innerHTML = (this.dataset.message || '').replace(/\n/g,'<br>') || '—';
            new bootstrap.Modal(document.getElementById('messageModal')).show();
        });
    });

    // Edit modal
    document.querySelectorAll('.btn-edit-message').forEach(function(btn){
        btn.addEventListener('click', function(){
            document.getElementById('editMessageForm').action = this.dataset.action;
            document.getElementById('editMessageText').value  = this.dataset.message || '';
            new bootstrap.Modal(document.getElementById('editMessageModal')).show();
        });
    });

    // Live search
    function debounce(fn, d){ var t; return function(){ clearTimeout(t); var a=arguments,c=this; t=setTimeout(function(){ fn.apply(c,a); }, d); }; }
    var inp = document.getElementById('messagesSearch');
    if (inp) {
        inp.addEventListener('input', debounce(function(e){
            var q = e.target.value.toLowerCase().trim();
            document.querySelectorAll('table tbody tr').forEach(function(row){
                var sender = ((row.cells[1] && row.cells[1].innerText) || '').toLowerCase();
                row.style.display = (!q || sender.indexOf(q) !== -1) ? '' : 'none';
            });
        }, 200));
    }
});
</script>

@endsection