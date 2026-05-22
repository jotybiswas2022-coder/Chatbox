@php
use Illuminate\Support\Str;
use App\Models\Message;

$activeUserId = request()->route('user_id') !== null ? (string) request()->route('user_id') : null;
$isChatPage = request()->routeIs('message');
@endphp

<!-- Top Bar -->
<nav class="navbar navbar-expand-lg navbar-light chatbox-top-navbar shadow-sm py-2">
    <div class="container-fluid">
        <a class="navbar-brand chatbox-brand-link d-flex align-items-center fw-bold fs-5 text-dark" href="/" style="padding-left: 12px;">
            <i class="bi bi-chat-dots-fill me-2 fs-3 chatbox-brand-icon"></i>
            <span style="margin-left: 4px;">ChatBox</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopNav"
                aria-controls="navbarTopNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto gap-2 gap-lg-3 align-items-center">

                <li class="nav-item">
                    <a class="nav-link chatbox-navlink-top {{ request()->is('/') ? 'active-navlink-chatbox' : '' }}" href="/">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link chatbox-navlink-top {{ request()->is('contact') ? 'active-navlink-chatbox' : '' }}" href="/contact">
                        <i class="bi bi-telephone me-1"></i> Contact
                    </a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link chatbox-navlink-top {{ $isChatPage ? 'active-navlink-chatbox' : '' }}" href="{{ route('message', auth()->id()) }}">
                            <i class="bi bi-chat-left-text me-1"></i> Messages
                        </a>
                    </li>

                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link chatbox-navlink-top {{ Str::startsWith(request()->path(), 'admin') ? 'active-navlink-chatbox' : '' }}" href="/admin">
                                <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link chatbox-navlink-top btn btn-link chatbox-logout-btn fw-semibold border-0">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link chatbox-navlink-top {{ request()->is('login') ? 'active-navlink-chatbox' : '' }}" href="/login">
                            <i class="bi bi-person-circle me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link chatbox-signup-button px-3 py-1 rounded text-white" href="/register">
                            <i class="bi bi-person-plus me-1"></i> Signup
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar + Content -->
<div class="row m-0 chatbox-main-layout-row">
    <div class="col-md-3 p-0">
        <div class="chatbox-sidebar-container">

            <!-- Search -->
            <div class="chatbox-search-wrapper px-3 mb-3">
                <div class="chatbox-search-input-box">
                    <i class="bi bi-search chatbox-search-icon"></i>
                    <input type="text" id="userSearch" class="form-control chatbox-search-field" placeholder="Search by Gmail...">
                    <div id="searchResult" class="chatbox-search-results-dropdown"></div>
                </div>
            </div>

            <ul class="chatbox-sidebar-user-list">

                @auth
                    <!-- My Account -->
                    <li class="ps-3 text-muted chatbox-section-label">My Account</li>
                    <li class="chatbox-user-list-item">
                        <a href="{{ route('message', auth()->id()) }}"
                           class="chatbox-user-link {{ $activeUserId === (string) auth()->id() ? 'active-user-chatbox' : '' }}">
                            
                            <div class="chatbox-user-avatar-wrapper">
                                <i class="bi bi-person-circle chatbox-user-avatar-icon"></i>
                                <span class="chatbox-online-indicator"></span>
                            </div>

                            <div class="chatbox-user-info">
                                <span class="chatbox-user-name">{{ auth()->user()->name }} (You)</span>
                                <span class="chatbox-user-status">Active now</span>
                            </div>
                        </a>
                    </li>

                    <!-- Recent Chats -->
                    <li class="mt-3 ps-3 text-muted chatbox-section-label">Recent Chats</li>

                    @php
                        $chattedUserIds = Message::conversationPartnerIdsFor((int) auth()->id());
                        $users = \App\Models\User::whereIn('id', $chattedUserIds)->orderBy('name')->get();
                    @endphp

                    @foreach($users as $user)
                        <li class="chatbox-user-list-item user-item"
                            data-name="{{ strtolower($user->name) }}"
                            data-email="{{ strtolower($user->email) }}">

                            <a href="{{ route('message', $user->id) }}"
                               class="chatbox-user-link {{ $activeUserId === (string) $user->id ? 'active-user-chatbox' : '' }}">

                                <div class="chatbox-user-avatar-wrapper">
                                    <i class="bi bi-person chatbox-user-avatar-icon"></i>
                                </div>

                                <div class="chatbox-user-info">
                                    <span class="chatbox-user-name">{{ $user->name }}</span>
                                    <span class="chatbox-user-status">{{ $user->email }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach

                @else
                    <li class="chatbox-user-list-item">
                        <a href="{{ route('login') }}" class="chatbox-user-link active-user-chatbox">
                            <div class="chatbox-user-info">
                                <span class="chatbox-user-name">Guest — Login to chat</span>
                            </div>
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>

    <!-- Content -->
    <div class="col-md-9 {{ $isChatPage ? 'p-0' : 'p-0 chatbox-content-area' }}">
        @yield('content')
    </div>
</div>

<!-- Live Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const userSearch = document.getElementById('userSearch');
    const searchResult = document.getElementById('searchResult');
    const searchUrl = "{{ route('users.search') }}";
    const chatUrlPrefix = "{{ url('/') }}/";

    if (!userSearch || !searchResult) return;

    userSearch.addEventListener('input', function () {
        const query = this.value.trim();
        const userItems = document.querySelectorAll('.user-item');

        if (query.length < 1) {
            userItems.forEach(i => i.style.display = '');
            searchResult.style.display = 'none';
            searchResult.innerHTML = '';
            return;
        }

        userItems.forEach(item => item.style.display = 'none');

        fetch(`${searchUrl}?query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(users => {
                if (!users.length) {
                    searchResult.innerHTML = '<div class="search-item text-muted">No user found</div>';
                    searchResult.style.display = 'block';
                    return;
                }

                searchResult.innerHTML = users.map(user => `
                    <a class="search-item" href="${chatUrlPrefix}${user.id}/message">
                        <strong>${user.name}</strong>
                        <div class="text-small text-secondary">${user.email ?? ''}</div>
                    </a>
                `).join('');

                searchResult.style.display = 'block';
            });
    });
});
</script>

<style>
    /* ChatBox Social Messaging - Global Styles */
*, *::before, *::after {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #FFFFFF;
    color: #1f2937;
    overflow-x: hidden;
}

/* Top Navbar Styles */
.chatbox-top-navbar {
    background: #FFFFFF;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 1000;
    animation: chatbox-navbar-slide-down 0.5s ease-out;
}

@keyframes chatbox-navbar-slide-down {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.chatbox-brand-link {
    text-decoration: none;
    color: #1f2937;
    transition: all 0.3s ease;
}

.chatbox-brand-link:hover {
    color: #2563EB;
    transform: scale(1.05);
}

.chatbox-brand-icon {
    color: #2563EB;
    animation: chatbox-icon-pulse 2s infinite;
}

@keyframes chatbox-icon-pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

.navbar .chatbox-navlink-top {
    text-decoration: none;
    color: #6b7280;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.navbar .chatbox-navlink-top::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: #2563EB;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.navbar .chatbox-navlink-top:hover {
    color: #2563EB;
    background: #eff6ff;
}

.navbar .chatbox-navlink-top:hover::before {
    width: 80%;
}

.navbar .active-navlink-chatbox {
    color: #2563EB;
    background: #eff6ff;
}

.navbar .active-navlink-chatbox::before {
    width: 80%;
}

.chatbox-logout-btn {
    color: #dc2626 !important;
    text-decoration: none;
}

.chatbox-logout-btn:hover {
    background: #fef2f2 !important;
    color: #dc2626 !important;
}

.chatbox-signup-button {
    background: linear-gradient(135deg, #2563EB 0%, #1d4ed8 100%);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
}

.chatbox-signup-button:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
}

/* Main Layout */
.chatbox-main-layout-row {
    height: calc(100vh - 60px);
}

/* Sidebar Styles */
.chatbox-sidebar-container {
    background: #f9fafb;
    height: 100%;
    border-right: 1px solid #e5e7eb;
    overflow-y: auto;
    animation: chatbox-sidebar-slide-in 0.6s ease-out;
}

@keyframes chatbox-sidebar-slide-in {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.chatbox-sidebar-container::-webkit-scrollbar {
    width: 6px;
}

.chatbox-sidebar-container::-webkit-scrollbar-track {
    background: #f9fafb;
}

.chatbox-sidebar-container::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
}

.chatbox-sidebar-container::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Search Box */
.chatbox-search-wrapper {
    padding-top: 20px;
    animation: chatbox-search-fade-in 0.8s ease-out;
}

@keyframes chatbox-search-fade-in {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chatbox-search-input-box {
    position: relative;
}

.chatbox-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    z-index: 1;
    font-size: 16px;
}

.chatbox-search-field {
    padding-left: 40px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    background: #FFFFFF;
    transition: all 0.3s ease;
    font-size: 14px;
}

.chatbox-search-field:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    outline: none;
}

.chatbox-search-results-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #FFFFFF;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    margin-top: 8px;
    max-height: 300px;
    overflow-y: auto;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    display: none;
    z-index: 10;
}

/* Sidebar User List */
.chatbox-sidebar-user-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.chatbox-section-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    margin-top: 10px;
}

.chatbox-user-list-item {
    animation: chatbox-user-item-fade-in 0.5s ease-out backwards;
}

.chatbox-user-list-item:nth-child(2) {
    animation-delay: 0.1s;
}

.chatbox-user-list-item:nth-child(3) {
    animation-delay: 0.2s;
}

.chatbox-user-list-item:nth-child(4) {
    animation-delay: 0.3s;
}

.chatbox-user-list-item:nth-child(5) {
    animation-delay: 0.4s;
}

.chatbox-user-list-item:nth-child(6) {
    animation-delay: 0.5s;
}

@keyframes chatbox-user-item-fade-in {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.chatbox-user-link {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    text-decoration: none;
    color: #1f2937;
    transition: all 0.3s ease;
    position: relative;
    border-left: 3px solid transparent;
}

.chatbox-user-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 0;
    background: linear-gradient(90deg, rgba(37, 99, 235, 0.1) 0%, transparent 100%);
    transition: width 0.3s ease;
}

.chatbox-user-link:hover {
    background: #FFFFFF;
}

.chatbox-user-link:hover::before {
    width: 100%;
}

.active-user-chatbox {
    background: #eff6ff;
    border-left-color: #2563EB;
}

.active-user-chatbox::before {
    width: 100%;
}

.chatbox-user-avatar-wrapper {
    position: relative;
    margin-right: 12px;
}

.chatbox-user-avatar-icon {
    font-size: 36px;
    color: #6b7280;
}

.active-user-chatbox .chatbox-user-avatar-icon {
    color: #2563EB;
}

.chatbox-online-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 10px;
    height: 10px;
    background: #10b981;
    border: 2px solid #FFFFFF;
    border-radius: 50%;
    animation: chatbox-online-pulse 2s infinite;
}

@keyframes chatbox-online-pulse {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    }
    50% {
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0);
    }
}

.chatbox-user-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.chatbox-user-name {
    font-weight: 600;
    font-size: 14px;
    color: #1f2937;
}

.chatbox-user-status {
    font-size: 12px;
    color: #9ca3af;
    margin-top: 2px;
}

.chatbox-unread-badge {
    background: #2563EB;
    color: #FFFFFF;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 12px;
    min-width: 20px;
    text-align: center;
    animation: chatbox-badge-bounce 0.5s ease;
}

@keyframes chatbox-badge-bounce {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
}

/* Content Area */
.chatbox-content-area {
    background: #FFFFFF;
    height: 100%;
    overflow-y: auto;
}

.chatbox-main-content-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 40px;
    animation: chatbox-content-fade-in 0.8s ease-out;
}

@keyframes chatbox-content-fade-in {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chatbox-welcome-title {
    font-size: 36px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 12px;
    background: linear-gradient(135deg, #2563EB 0%, #7c3aed 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: chatbox-title-slide-up 0.8s ease-out;
}

@keyframes chatbox-title-slide-up {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chatbox-welcome-subtitle {
    font-size: 16px;
    color: #6b7280;
    margin-bottom: 40px;
    animation: chatbox-subtitle-fade-in 1s ease-out;
}

@keyframes chatbox-subtitle-fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.chatbox-features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 24px;
    max-width: 800px;
    width: 100%;
}

.chatbox-feature-card {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 32px 24px;
    text-align: center;
    transition: all 0.4s ease;
    animation: chatbox-card-float-in 0.8s ease-out backwards;
}

.chatbox-feature-card:nth-child(1) {
    animation-delay: 0.2s;
}

.chatbox-feature-card:nth-child(2) {
    animation-delay: 0.4s;
}

.chatbox-feature-card:nth-child(3) {
    animation-delay: 0.6s;
}

@keyframes chatbox-card-float-in {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chatbox-feature-card:hover {
    background: #FFFFFF;
    border-color: #2563EB;
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.15);
}

.chatbox-feature-icon {
    font-size: 48px;
    color: #2563EB;
    margin-bottom: 16px;
    animation: chatbox-icon-rotate 3s linear infinite;
}

@keyframes chatbox-icon-rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.chatbox-feature-card:hover .chatbox-feature-icon {
    animation: chatbox-icon-bounce 0.6s ease;
}

@keyframes chatbox-icon-bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.chatbox-feature-card h5 {
    font-size: 18px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.chatbox-feature-card p {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .chatbox-top-navbar .navbar-nav {
        text-align: center;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
}

@media (max-width: 768px) {
    .chatbox-main-layout-row {
        flex-direction: column;
    }

    .chatbox-sidebar-container {
        height: auto;
        min-height: 300px;
    }

    .chatbox-content-area {
        height: auto;
        min-height: 400px;
    }

    .chatbox-welcome-title {
        font-size: 28px;
    }

    .chatbox-features-grid {
        grid-template-columns: 1fr;
    }
}

/* Loading Animation */
@keyframes chatbox-shimmer {
    0% {
        background-position: -1000px 0;
    }
    100% {
        background-position: 1000px 0;
    }
}

.chatbox-loading-shimmer {
    animation: chatbox-shimmer 2s infinite linear;
    background: linear-gradient(to right, #f9fafb 0%, #e5e7eb 50%, #f9fafb 100%);
    background-size: 1000px 100%;
}

/* Smooth Transitions */
.chatbox-transition-smooth {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Hover Effects */
.chatbox-hover-lift:hover {
    transform: translateY(-4px);
}

.chatbox-hover-scale:hover {
    transform: scale(1.05);
}

/* Glass Morphism Effect */
.chatbox-glass-effect {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

/* Gradient Text */
.chatbox-gradient-text {
    background: linear-gradient(135deg, #2563EB 0%, #7c3aed 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Box Shadow Utilities */
.chatbox-shadow-sm {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.chatbox-shadow-md {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
}

.chatbox-shadow-lg {
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.chatbox-shadow-xl {
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
}

/* Utility Classes */
.chatbox-text-primary {
    color: #2563EB;
}

.chatbox-bg-primary {
    background-color: #2563EB;
}

.chatbox-border-primary {
    border-color: #2563EB;
}
</style>