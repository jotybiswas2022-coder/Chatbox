@extends('backend.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
        <h3 class="fw-bold mb-0">Donor List ({{ $donorsCount }})</h3>

        <!-- Add New Donor Button -->
        <a href="/admin/donor_list/create/" class="btn btn-success">
            + Add New Donor
        </a>
    </div>

    {{-- ================= SEARCH FORM ================= --}}
    <div class="card mb-3 shadow-sm border-0 rounded-4">
        <div class="card-body p-3 p-md-4">
            <form action="{{ url('admin/donor_list') }}" method="GET">
                <div class="row g-2">
                    <div class="col-12 col-md-5">
                        <input type="text" name="search_name" class="form-control" placeholder="Search by Name" value="{{ request('search_name') }}">
                    </div>
                    <div class="col-12 col-md-5">
                        <select name="search_division" class="form-select">
                            <option value="">All Divisions</option>
                            @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Barishal','Sylhet','Rangpur','Mymensingh'] as $division)
                                <option value="{{ $division }}" {{ request('search_division') == $division ? 'selected' : '' }}>
                                    {{ $division }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-1">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                    <div class="col-6 col-md-1">
                        <a href="{{ url('admin/donor_list') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- ================= END SEARCH ================= --}}

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">

            <!-- Scrollable Table Container -->
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-dark position-sticky top-0">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Blood Group</th>
                            <th>Division</th>
                            <th>Last Donation</th>
                            <th width="160">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donors as $index => $donor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $donor->name ?? 'N/A' }}</td>
                            <td>{{ $donor->number ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-danger">{{ $donor->blood ?? 'N/A' }}</span>
                            </td>
                            <td>{{ $donor->division ?? 'N/A' }}</td>
                            <td>{{ optional($donor->last_donated)->format('d M Y') ?? 'N/A' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $donor->id }}">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ url('admin/donor_list/delete/'.$donor->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>

                        {{-- ================= EDIT MODAL ================= --}}
                        <div class="modal fade" id="editModal{{ $donor->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content rounded-4">

                                    <form action="{{ url('admin/donor_list/update/'.$donor->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Edit Donor</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body text-start">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" value="{{ $donor->name }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" name="number" value="{{ $donor->number }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Blood Group</label>
                                                <select name="blood" class="form-select" required>
                                                    @php $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-']; @endphp
                                                    @foreach($groups as $group)
                                                        <option value="{{ $group }}" {{ $donor->blood == $group ? 'selected' : '' }}>{{ $group }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Division</label>
                                                <select name="division" class="form-select" required>
                                                    @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Barishal','Sylhet','Rangpur','Mymensingh'] as $division)
                                                        <option value="{{ $division }}" {{ $donor->division == $division ? 'selected' : '' }}>{{ $division }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Last Donation Date</label>
                                                <input type="date" name="last_donated" value="{{ optional($donor->last_donated)->format('Y-m-d') }}" class="form-control">
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

                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No donors found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- End Scrollable Table -->

        </div>
    </div>
</div>

{{-- ================= SWEETALERT SCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('.delete-form');

            Swal.fire({
                title: 'Are you sure?',
                text: "This donor will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    @endif
});
</script>
@endsection