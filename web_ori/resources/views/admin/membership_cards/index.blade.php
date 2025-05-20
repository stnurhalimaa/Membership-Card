@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Membership Cards</h1>
            <a href="{{ route('membership_cards.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Card
            </a>
        </div>

        @if($cards->count() > 0)
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Membership Number</th>
                                    <th>Joining Date</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cards as $card)
                                    <tr>
                                        <td>{{ $card->name }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $card->membership_number }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($card->joining_date)->format('d M Y') }}</td>
                                        <td>
                                            @if($card->expiry_date)
                                                {{ \Carbon\Carbon::parse($card->expiry_date)->format('d M Y') }}
                                            @else
                                                <span class="text-muted">No expiry</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$card->expiry_date || \Carbon\Carbon::parse($card->expiry_date)->isFuture())
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Card Actions">
                                                <!-- View Button -->
                                                <a href="{{ route('membership_cards.show', $card->id) }}" 
                                                   class="btn btn-outline-info btn-sm" 
                                                   title="View Details"
                                                   data-bs-toggle="tooltip" 
                                                   data-bs-placement="top">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                
                                                <!-- Edit Button -->
                                                <a href="{{ route('membership_cards.edit', $card->id) }}" 
                                                   class="btn btn-outline-primary btn-sm" 
                                                   title="Edit Card"
                                                   data-bs-toggle="tooltip" 
                                                   data-bs-placement="top">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('membership_cards.destroy', $card->id) }}" 
                                                      method="POST" 
                                                      style="display: inline;"
                                                      onsubmit="return confirm('Are you sure you want to delete this membership card for {{ $card->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-outline-danger btn-sm" 
                                                            title="Delete Card"
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                <h4>No membership cards found</h4>
                <p>Start by <a href="{{ route('membership_cards.create') }}">creating your first membership card</a>.</p>
            </div>
        @endif
    </div>

    <!-- Script untuk mengaktifkan tooltip -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi tooltip Bootstrap
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection