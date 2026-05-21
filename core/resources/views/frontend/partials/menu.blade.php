@php
use Illuminate\Support\Str;

$activeUserId = request()->route('user_id') !== null ? (string) request()->route('user_id') : null;
$isChatPage = request()->routeIs('message');
@endphp

<!-- Top Bar -->
<nav class="navbar navbar-expand-lg shadow-sm py-2" style="background: #ffffff;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center fw-bold fs-5 text-dark" href="/" style="padding-left: 12px;">
            <i class="bi bi-chat-dots-fill me-2 fs-3 text-primary"></i>
            <span style="margin-left: 4px;">ChatBox</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto gap-3 align-items-center">
                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('/') ? 'active-link' : '' }}" href="/">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('contact') ? 'active-link' : '' }}" href="/contact">
                        <i class="bi bi-telephone me-1"></i> Contact
                    </a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link top-nav-link {{ $isChatPage ? 'active-link' : '' }}" href="{{ route('message', auth()->id()) }}">
                            <i class="bi bi-chat-left-text me-1"></i> Messages
                        </a>
                    </li>

                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link top-nav-link {{ Str::startsWith(request()->path(), 'admin') ? 'active-link' : '' }}" href="/admin">
                                <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-danger fw-semibold">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link top-nav-link {{ request()->is('login') ? 'active-link' : '' }}" href="/login">
                            <i class="bi bi-person-circle me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link signup-btn px-3 py-1 rounded text-white" href="/register">
                            <i class="bi bi-person-plus me-1"></i> Signup
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar + Content -->
<div class="row m-0 app-layout-row">
    <div class="col-md-3 p-0">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <!-- 🔍 Live Search Box (visible to all users) -->
                <li class="px-3 mb-2 position-relative search-li">
                    <div class="search-box">
                        <input type="text" id="userSearch" class="form-control" placeholder="Search by Gmail...">

                        <!-- Result Box -->
                        <div id="searchResult" class="search-result-box"></div>
                    </div>
                </li>

                @auth
                    <li class="ps-3 text-muted sidebar-label">My Account</li>
                    <li>
                        <a href="{{ route('message', auth()->id()) }}" class="{{ $activeUserId === (string) auth()->id() ? 'active' : '' }}">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ auth()->user()->name }} (You)</span>
                        </a>
                    </li>


                    <li class="mt-3 ps-3 text-muted sidebar-label">All Users</li>
                    @php $users = \App\Models\User::where('id', '!=', auth()->id())->orderBy('name')->get(); @endphp
                    @foreach($users as $user)
                        <li class="user-item" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}">
                            <a href="{{ route('message', $user->id) }}" class="{{ $activeUserId === (string) $user->id ? 'active' : '' }}">
                                <i class="bi bi-person"></i>
                                <span>{{ $user->name }}</span>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>
                        <a href="{{ route('login') }}" class="active">
                            <i class="bi bi-person-circle"></i>
                            <span>Guest — Login to chat</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

    <div class="col-md-9 {{ $isChatPage ? 'p-0 chat-content-col' : 'p-4' }}">
        @yield('content')
    </div>
</div>

<style>
.navbar .top-nav-link {
    font-weight: 500;
    color: #343a40;
    transition: color .3s, transform .3s;
    position: relative;
}
.navbar .top-nav-link:hover {
    color: #6366f1;
    transform: translateY(-1px);
}
.navbar .top-nav-link.active-link::after {
    content: "";
    display: block;
    height: 2px;
    background: #6366f1;
    border-radius: 1px;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
}

.navbar-brand i { color: #6366f1 !important; }

.signup-btn {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    transition: all 0.3s;
}
.signup-btn:hover {
    opacity: .9;
    transform: translateY(-1px);
}

.app-layout-row {
    min-height: calc(100vh - 56px);
    height: calc(100vh - 56px);
    overflow: hidden;
}

.sidebar {
    background: #fefefe;
    min-height: 100%;
    height: 100%;
    position: sticky;
    top: 0;
    overflow: hidden;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
    padding-top: 20px;
    border-right: 1px solid #e3e6f0;
}

.sidebar-label {
    font-size: .85rem;
    margin-bottom: 4px;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}
.sidebar-menu li { margin-bottom: 8px; }
.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 14px;
    color: #4b4b4b;
    padding: 12px 22px;
    font-weight: 500;
    border-left: 4px solid transparent;
    border-radius: 6px;
    transition: all 0.25s ease;
    text-decoration: none;
}
.sidebar-menu a i { font-size: 18px; }
.sidebar-menu a:hover {
    background: rgba(99, 102, 241, 0.1);
    color: #6366f1;
    border-left: 4px solid #6366f1;
}
.sidebar-menu a.active {
    background: rgba(99, 102, 241, 0.15);
    color: #6366f1;
    border-left: 4px solid #6366f1;
}

.chat-content-col {
    display: flex;
    flex-direction: column;
    min-height: calc(100vh - 56px);
    height: 100%;
    overflow: hidden;
    background: #f8f9fc;
}

@media (max-width: 768px) {
    .sidebar { min-height: auto; padding-top: 0; }
    .navbar-nav { text-align: center; }
    .app-layout-row { min-height: auto; }
    .chat-content-col { min-height: calc(100vh - 120px); }
}

.search-result-box {
    position: absolute;
    width: 100%;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-top: 4px;
    max-height: 250px;
    overflow-y: auto;
    z-index: 999;
    display: none;
}

.search-item {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}

.search-item:hover {
    background: #f1f1f1;
}

/* Ensure search input displays nicely inside sidebar menu */
.sidebar-menu .search-li { list-style: none; }
.sidebar-menu .search-box .form-control { width: 100%; }
.sidebar-menu .search-li .search-result-box { left: 12px; right: 12px; width: calc(100% - 24px); }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const userSearch = document.getElementById('userSearch');
    const searchResult = document.getElementById('searchResult');

    if (!userSearch || !searchResult) return; // input or box not present (e.g. guest)

    userSearch.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();

        const userItems = document.querySelectorAll('.sidebar-menu .user-item');
        let anyVisible = false;

        if (query.length < 1) {
            userItems.forEach(i => i.style.display = '');
            searchResult.style.display = 'none';
            searchResult.innerHTML = '';
            return;
        }

        userItems.forEach(item => {
            const name = (item.dataset.name || '').toLowerCase();
            const email = (item.dataset.email || '').toLowerCase();
            if (name.includes(query) || email.includes(query)) {
                item.style.display = '';
                anyVisible = true;
            } else {
                item.style.display = 'none';
            }
        });

        if (!anyVisible) {
            searchResult.innerHTML = '<div class="search-item text-muted">No user found</div>';
            searchResult.style.display = 'block';
        } else {
            searchResult.style.display = 'none';
            searchResult.innerHTML = '';
        }
    });
});
</script>
