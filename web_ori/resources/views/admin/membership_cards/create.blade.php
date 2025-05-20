@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Create Membership Card</h1>

        <form action="{{ route('membership_cards.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <!-- Tanggal Bergabung -->
            <div class="mb-3">
                <label for="joining_date" class="form-label">Joining Date</label>
                <input type="date" class="form-control" id="joining_date" name="joining_date" required>
            </div>

            <!-- Tanggal Kadaluarsa -->
            <div class="mb-3">
                <label for="expiry_date" class="form-label">Expiry Date (Optional)</label>
                <input type="date" class="form-control" id="expiry_date" name="expiry_date">
            </div>

            <!-- Nomor Keanggotaan -->
            <div class="mb-3">
                <label for="membership_number" class="form-label">Membership Number</label>
                <input type="text" class="form-control" id="membership_number" name="membership_number" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Membership</button>
        </form>
    </div>
@endsection
