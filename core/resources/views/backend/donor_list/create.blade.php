@extends('backend.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Add New Donor</h3>
        <a href="{{ url('admin/donor_list') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">

            <form action="{{ url('admin/donor_list/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="number" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Blood Group</label>
                    <select name="blood" class="form-select" required>
                        <option value="">Select Blood Group</option>
                        @foreach($groups as $group)
                            <option value="{{ $group }}">{{ $group }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Division</label>
                    <select name="division" class="form-select" required>
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division }}">{{ $division }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Donation Date</label>
                    <input type="date" name="last_donated" class="form-control">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Save Donor</button>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- SweetAlert success --}}
<script>
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
@endif
</script>
@endsection