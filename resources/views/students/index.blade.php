@extends('layouts.app')

@section('title', 'Student List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Student Management</h1>
        <p class="text-muted mb-0">Manage student records with beautiful Blade views</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Add New Student
    </a>
</div>

@if($students->count() > 0)
    <!-- Students Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $students->count() }}</h3>
                    <p class="card-text">Total Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $students->unique('major')->count() }}</h3>
                    <p class="card-text">Different Majors</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $students->where('year', 1)->count() }}</h3>
                    <p class="card-text">Freshmen</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $students->where('year', 4)->count() }}</h3>
                    <p class="card-text">Seniors</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-people"></i> All Students ({{ $students->count() }})
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Major</th>
                            <th scope="col">Year</th>
                            <th scope="col">Registered</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">#{{ $student->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $student->name }}</strong>
                            </td>
                            <td>
                                <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                    {{ $student->email }}
                                </a>
                            </td>
                            <td>
                                <span class="text-primary">{{ $student->major }}</span>
                            </td>
                            <td>
                                <span class="badge year-badge 
                                    @if($student->year == 1) bg-success
                                    @elseif($student->year == 2) bg-info  
                                    @elseif($student->year == 3) bg-warning
                                    @else bg-danger
                                    @endif">
                                    Year {{ $student->year }}
                                    @if($student->year == 1) (Freshman)
                                    @elseif($student->year == 2) (Sophomore)
                                    @elseif($student->year == 3) (Junior)
                                    @else (Senior)
                                    @endif
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $student->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('students.show', $student) }}" 
                                       class="btn btn-outline-primary" 
                                       title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('students.edit', $student) }}" 
                                       class="btn btn-outline-warning"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form class="d-inline" method="POST" action="{{ route('students.destroy', $student) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete {{ $student->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
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

    <!-- Quick Actions -->
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Quick Actions</h6>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-success">
                        <i class="bi bi-plus"></i> Add Student
                    </a>
                    <a href="/students/hello" class="btn btn-sm btn-info">
                        <i class="bi bi-hand-thumbs-up"></i> Hello Demo
                    </a>
                    <a href="/students/time" class="btn btn-sm btn-secondary">
                        <i class="bi bi-clock"></i> Time Demo
                    </a>
                </div>
            </div>
        </div>
    </div>

@else
    <!-- Empty State -->
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="bi bi-people" style="font-size: 4rem; color: #dee2e6;"></i>
                    </div>
                    <h3 class="text-muted">No Students Found</h3>
                    <p class="text-muted mb-4">
                        Welcome to the Student Management System!<br>
                        There are no students in the database yet. Get started by adding your first student.
                    </p>
                    <a href="{{ route('students.create') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-plus-circle"></i> Add First Student
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script>
    // Add some interactivity
    document.addEventListener('DOMContentLoaded', function() {
        // Highlight row on hover
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
            });
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });
    });
</script>
@endpush
