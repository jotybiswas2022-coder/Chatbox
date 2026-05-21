@extends('frontend.app')

@section('content')

<!-- HERO STRIP -->
<div class="hero-strip">
    <h1>
        <i class="fa-solid fa-heart-pulse"></i>
        Blood Donor List
    </h1>
    <p>Save lives, donate blood. Contact our registered blood donors.</p>
</div>

<!-- STATS ROW -->
<div class="stats-row">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-number">{{ $sortedDonors->count() }}</div>
            <div class="stat-label">Total Donors</div>
        </div>
    </div>
</div>

<!-- MAIN CONTAINER -->
<div class="main-container">
    <div class="donor-card">
        <div class="donor-card-header">
            <h3>
                <i class="fa-solid fa-users me-2"></i>
                <span id="header-title">@if($bloodGroup) Donor List for Blood Group {{ $bloodGroup }} @else All Donors @endif</span>
                <span class="donor-count-badge" id="donor-count">Total Donors: {{ $sortedDonors->count() }}</span>
            </h3>
        </div>

        <!-- Search & Division Filter -->
                <div class="filter-row" style="display:flex;gap:10px;flex-wrap:wrap;margin:15px 0;">

                   <!-- Name/Mobile Search -->
                    <input type="text"
                        placeholder="Search by name or mobile..."
                        onkeyup="searchDonors(this.value)"
                        class="search-input">

                    <!-- Division Search -->
                    <select onchange="filterDivision(this.value)" class="division-select">
                        <option value="all">All Divisions</option>
                        <option value="Dhaka">Dhaka</option>
                        <option value="Chattogram">Chattogram</option>
                        <option value="Khulna">Khulna</option>
                        <option value="Rajshahi">Rajshahi</option>
                        <option value="Barishal">Barishal</option>
                        <option value="Sylhet">Sylhet</option>
                        <option value="Rangpur">Rangpur</option>
                        <option value="Mymensingh">Mymensingh</option>
                    </select>

                </div>

        <div class="table-responsive">
            <table class="donor-table">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Blood Group</th>
                        <th>Division</th>
                        <th>Next Donation</th>
                    </tr>
                </thead>
                <tbody id="donor-tbody">
                    @php
                    $ser = 1;
                    @endphp
                    @forelse($sortedDonors as $index => $donor)
                    <tr data-blood="{{ $donor->blood }}" data-name="{{ $donor->name }}" data-mobile="{{ $donor->number }}">
                        <td>{{ $ser++ }}</td>
                        <td>{{ $donor->name }}</td>
                        <td><i class="fa-solid fa-phone me-1"></i>{{ $donor->number }}</td>
                        <td>
                            <span class="blood-badge blood-{{ strtolower(str_replace(['+','-'], ['pos','neg'],$donor->blood)) }}">
                                {{ $donor->blood }}
                            </span>
                        </td>
                        <td>{{ $donor->division }}</td>
                        <td>
                            @if($donor->last_donated)
                                @php
                                    $nextDate = \Carbon\Carbon::parse($donor->nextDonationDate());
                                    $today = now()->startOfDay();
                                    $diffDays = $today->diffInDays($nextDate, false);
                                @endphp
                                <span class="eligible-badge
                                    @if($diffDays <= 0) eligible-now
                                    @elseif($diffDays === 0) eligible-today
                                    @elseif($diffDays === 1) eligible-soon
                                    @else eligible-waiting @endif">
                                    {{ $nextDate->format('d M Y') }}
                                    @if($diffDays === 0) (Today)
                                    @elseif($diffDays === 1) (Tomorrow)
                                    @elseif($diffDays > 1) (in {{ $diffDays }} days)
                                    @else (Eligible) @endif
                                </span>
                            @else
                                <span class="eligible-badge eligible-now"><i class="fa-solid fa-circle-check me-1"></i>Eligible Today</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr id="empty-row">
                            <td colspan="6"><i class="fa-solid fa-user-slash" style="font-size:28px;display:block;margin-bottom:10px;color:#fca5a5;"></i>No donors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
    <p>© 2025 Blood Bank &nbsp;|&nbsp; <span><i class="fa-solid fa-heart"></i> Donate Blood, Save Lives</span> &nbsp;|&nbsp; All Rights Reserved</p>
</footer>

<script>
let currentBlood = 'all';
let currentDivision = 'all';
let currentSearch = '';

// Blood Group filter
function filterBlood(el, group) {
    document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    currentBlood = group;
    applyFilter();
    const title = document.getElementById('header-title');
    title.textContent = group === 'all' ? 'All Donors' : 'Donor List for Blood Group ' + group;
}

// Division filter
function filterDivision(val) {
    currentDivision = val;
    applyFilter();
}

// Search by name or mobile
function searchDonors(val) {
    currentSearch = val.trim().toLowerCase();
    applyFilter();
}

// Apply all filters
function applyFilter() {
    const rows = document.querySelectorAll('#donor-tbody tr[data-blood]');
    let visible = 0;
    rows.forEach(row => {
        const blood = row.getAttribute('data-blood');
        const name = row.getAttribute('data-name').toLowerCase();
        const mobile = row.getAttribute('data-mobile').toLowerCase();
        const division = row.querySelector('td:nth-child(5)').textContent;

        const bloodMatch = currentBlood === 'all' || blood === currentBlood;
        const divisionMatch = currentDivision === 'all' || division === currentDivision;
        const searchMatch = !currentSearch || name.includes(currentSearch) || mobile.includes(currentSearch);

        if (bloodMatch && divisionMatch && searchMatch) {
            row.style.display = '';
            visible++;
        } else {
            row.style.display = 'none';
        }
    });

    // Update serial numbers
    let serial = 1;
    rows.forEach(row => {
        if (row.style.display !== 'none') {
            row.querySelector('td:first-child').textContent = serial++;
        }
    });

    document.getElementById('donor-count').textContent = 'Total Donors: ' + visible;

    // Show/hide empty state
    let emptyRow = document.getElementById('empty-row');
    if (visible === 0) {
        if (!emptyRow) {
            emptyRow = document.createElement('tr');
            emptyRow.id = 'empty-row';
            emptyRow.className = 'empty-row';
            emptyRow.innerHTML = '<td colspan="6"><i class="fa-solid fa-user-slash" style="font-size:28px;display:block;margin-bottom:10px;color:#fca5a5;"></i>No donors found.</td>';
            document.getElementById('donor-tbody').appendChild(emptyRow);
        }
        emptyRow.style.display = '';
    } else {
        if (emptyRow) emptyRow.style.display = 'none';
    }
}
</script>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap');

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --red-deep: #b91c1c;
            --red-main: #dc2626;
            --red-light: #ef4444;
            --red-soft: #fee2e2;
            --red-pale: #fff5f5;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --green: #16a34a;
            --green-light: #dcfce7;
            --yellow: #ca8a04;
            --yellow-light: #fef9c3;
            --orange: #ea580c;
            --orange-light: #ffedd5;
            --blue: #2563eb;
            --blue-light: #dbeafe;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.10);
            --shadow-lg: 0 8px 32px rgba(0,0,0,0.13);
            --radius: 14px;
            --radius-sm: 8px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
            background: linear-gradient(135deg, #fdf2f2 0%, #fff0f0 40%, #fef2f2 100%);
            min-height: 100vh;
            color: var(--gray-800);
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: linear-gradient(90deg, var(--red-deep) 0%, var(--red-main) 60%, #c81e1e 100%);
            box-shadow: 0 2px 16px rgba(185,28,28,0.25);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 68px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--white);
        }

        .navbar-logo {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            border: 2px solid rgba(255,255,255,0.35);
        }

        .navbar-title {
            display: flex;
            flex-direction: column;
        }

        .navbar-title span:first-child {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.3px;
            line-height: 1.2;
        }

        .navbar-title span:last-child {
            font-size: 11px;
            opacity: 0.8;
            font-weight: 400;
            letter-spacing: 1px;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }

        .navbar-links a {
            color: rgba(255,255,255,0.88);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 7px 14px;
            border-radius: var(--radius-sm);
            transition: background 0.2s, color 0.2s;
        }

        .navbar-links a:hover,
        .navbar-links a.active {
            background: rgba(255,255,255,0.18);
            color: #fff;
        }

        /* ===== HERO STRIP ===== */
        .hero-strip {
            background: linear-gradient(90deg, #7f1d1d 0%, var(--red-deep) 50%, #991b1b 100%);
            color: white;
            text-align: center;
            padding: 38px 24px 34px;
        }

        .hero-strip h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .hero-strip p {
            font-size: 14px;
            opacity: 0.82;
            max-width: 480px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ===== STATS ROW ===== */
        .stats-row {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        .stats-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 18px 24px;
            display: flex;
            gap: 0;
            flex-wrap: wrap;
        }

        .stat-item {
            flex: 1;
            min-width: 140px;
            text-align: center;
            padding: 10px 16px;
            position: relative;
        }

        .stat-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 15%;
            height: 70%;
            width: 1px;
            background: var(--gray-200);
        }

        .stat-number {
            font-size: 26px;
            font-weight: 700;
            color: var(--red-main);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-500);
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        /* ===== FILTER BAR ===== */
        .filter-bar {
            max-width: 1200px;
            margin: 28px auto 0;
            padding: 0 24px;
        }

        .filter-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin: 20px 0;
            justify-content: flex-start; 
            align-items: center;
            padding: 0 10px; 
        }


        .filter-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            border: 1px solid var(--gray-100);
        }

        .filter-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-600);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-label i {
            color: var(--red-main);
        }

        .filter-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            flex: 1;
        }

        .filter-chip {
            padding: 6px 16px;
            border-radius: 999px;
            border: 1.5px solid var(--gray-200);
            background: var(--gray-50);
            color: var(--gray-600);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }

        .filter-chip:hover {
            border-color: var(--red-main);
            color: var(--red-main);
            background: var(--red-soft);
        }

        .filter-chip.active {
            background: var(--red-main);
            color: white;
            border-color: var(--red-main);
            box-shadow: 0 2px 8px rgba(220,38,38,0.3);
        }

        .search-input-wrap {
            position: relative;
            margin-left: auto;
        }

        .search-input-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 14px;
        }

        .search-input {
            padding: 9px 14px 9px 36px;
            border-radius: 999px;
            border: 1.5px solid var(--gray-200);
            background: var(--gray-50);
            font-size: 13px;
            color: var(--gray-700);
            outline: none;
            min-width: 200px;
            transition: border 0.2s, box-shadow 0.2s;
            font-family: inherit;
            flex: 1;
        }

        .search-input:focus {
            border-color: var(--red-light);
            box-shadow: 0 0 0 3px rgba(220,38,38,0.08);
            background: white;
        }

        .division-select {
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            min-width: 150px;
        }

        /* ===== MAIN CONTAINER ===== */
        .main-container {
            max-width: 1200px;
            margin: 24px auto 60px;
            padding: 0 24px;
        }

        /* ===== DONOR CARD ===== */
        .donor-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            border: 1px solid var(--gray-100);
        }

        .donor-card-header {
            background: linear-gradient(90deg, var(--red-deep) 0%, var(--red-main) 100%);
            padding: 20px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .donor-card-header h3 {
            color: white;
            font-size: 17px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .donor-count-badge {
            background: rgba(255,255,255,0.18);
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.28);
            letter-spacing: 0.3px;
        }

        /* ===== TABLE ===== */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .donor-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .donor-table thead tr {
            background: var(--red-pale);
            border-bottom: 2px solid var(--red-soft);
        }

        .donor-table thead th {
            padding: 14px 18px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: var(--red-deep);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            white-space: nowrap;
        }

        .donor-table tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.18s;
        }

        .donor-table tbody tr:hover {
            background: var(--red-pale);
        }

        .donor-table tbody tr:last-child {
            border-bottom: none;
        }

        .donor-table tbody td {
            padding: 14px 18px;
            color: var(--gray-700);
            vertical-align: middle;
        }

        .donor-table tbody td:first-child {
            font-weight: 600;
            color: var(--gray-500);
            font-size: 13px;
            width: 60px;
        }

        .donor-table tbody td:nth-child(2) {
            font-weight: 600;
            color: var(--gray-800);
        }

        .donor-table tbody td i.fa-phone {
            color: var(--green);
            font-size: 12px;
        }

        /* ===== BLOOD BADGES ===== */
        .blood-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 13px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.4px;
            min-width: 50px;
        }

        .blood-apos  { background: #fee2e2; color: #b91c1c; border: 1.5px solid #fca5a5; }
        .blood-aneg  { background: #fce7f3; color: #9d174d; border: 1.5px solid #f9a8d4; }
        .blood-bpos  { background: #ffedd5; color: #9a3412; border: 1.5px solid #fdba74; }
        .blood-bneg  { background: #fef9c3; color: #854d0e; border: 1.5px solid #fde047; }
        .blood-abpos { background: #dbeafe; color: #1e40af; border: 1.5px solid #93c5fd; }
        .blood-abneg { background: #ede9fe; color: #5b21b6; border: 1.5px solid #c4b5fd; }
        .blood-opos  { background: #dcfce7; color: #14532d; border: 1.5px solid #86efac; }
        .blood-oneg  { background: #e0f2fe; color: #0c4a6e; border: 1.5px solid #7dd3fc; }

        /* ===== ELIGIBLE BADGES ===== */
        .eligible-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 13px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .eligible-now {
            background: var(--green-light);
            color: var(--green);
            border: 1.5px solid #86efac;
        }

        .eligible-today {
            background: var(--blue-light);
            color: var(--blue);
            border: 1.5px solid #93c5fd;
        }

        .eligible-soon {
            background: var(--yellow-light);
            color: var(--yellow);
            border: 1.5px solid #fde047;
        }

        .eligible-waiting {
            background: var(--orange-light);
            color: var(--orange);
            border: 1.5px solid #fdba74;
        }

        /* ===== EMPTY STATE ===== */
        .empty-row td {
            text-align: center;
            padding: 48px 20px;
            color: var(--gray-400);
            font-size: 15px;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--gray-900);
            color: var(--gray-400);
            text-align: center;
            padding: 24px;
            font-size: 13px;
        }

        .footer span {
            color: var(--red-light);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar-links { display: none; }
            .hero-strip h1 { font-size: 20px; }
            .stats-inner { gap: 0; }
            .stat-item { min-width: 100px; padding: 8px 10px; }
            .stat-number { font-size: 20px; }
            .filter-card { padding: 14px 16px; }
            .search-input { min-width: 150px; }
            .donor-card-header { padding: 16px 18px; }
            .donor-table thead th,
            .donor-table tbody td { padding: 11px 12px; }
            .main-container { margin-top: 18px; }
        }

        @media (max-width: 480px) {
            .filter-chip { padding: 5px 11px; font-size: 12px; }
            .hero-strip { padding: 24px 16px 20px; }
            .hero-strip h1 { font-size: 17px; }
        }
    </style>

@endsection