@extends('layouts.app')

@section('title', 'Student Details - ' . $student->name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">
                    <i class="bi bi-person-circle"></i> Student Details
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150" class="text-muted">Student ID:</th>
                                <td>
                                    <span class="badge bg-dark fs-6">#{{ $student->id }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Full Name:</th>
                                <td>
                                    <h5 class="mb-0 text-primary">{{ $student->name }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Email Address:</th>
                                <td>
                                    <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                        <i class="bi bi-envelope"></i> {{ $student->email }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Major:</th>
                                <td>
                                    <span class="text-info fw-bold">{{ $student->major }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Academic Year:</th>
                                <td>
                                    <span class="badge fs-6
                                        @if($student->year == 1) bg-success
                                        @elseif($student->year == 2) bg-info
                                        @elseif($student->year == 3) bg-warning
                                        @else bg-danger
                                        @endif">
                                        {{ $student->year }}
                                        @if($student->year == 1)
                                            <span class="ms-2">Freshman 🌱</span>
                                        @elseif($student->year == 2)
                                            <span class="ms-2">Sophomore 📚</span>
                                        @elseif($student->year == 3)
                                            <span class="ms-2">Junior 🎯</span>
                                        @else
                                            <span class="ms-2">Senior 🎓</span>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Registration Date:</th>
                                <td>
                                    <i class="bi bi-calendar-check text-muted"></i>
                                    {{ $student->created_at->format('M d, Y') }}
                                    <small class="text-muted">
                                        ({{ $student->created_at->diffForHumans() }})
                                    </small>
                                </td>
                            </tr>
                            @if($student->updated_at != $student->created_at)
                            <tr>
                                <th class="text-muted">Last Updated:</th>
                                <td>
                                    <i class="bi bi-pencil-square text-muted"></i>
                                    {{ $student->updated_at->format('M d, Y \a\t H:i') }}
                                    <small class="text-muted">
                                        ({{ $student->updated_at->diffForHumans() }})
                                    </small>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="bg-light rounded p-4">
                            <div class="display-1 text-muted mb-3">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <h6 class="text-muted">Student Avatar</h6>
                            <small class="text-muted">Photo placeholder</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Quick Stats Card -->
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="card-title mb-0">
                    <i class="bi bi-graph-up"></i> Quick Stats
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-primary mb-1">{{ $student->year }}</h4>
                            <small class="text-muted">Current Year</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success mb-1">{{ 4 - $student->year + 1 }}</h4>
                        <small class="text-muted">Years Left</small>
                    </div>
                </div>
                <hr>
                <div class="progress mb-2">
                    <div class="progress-bar" role="progressbar" 
                         style="width: {{ ($student->year / 4) * 100 }}%" 
                         aria-valuenow="{{ $student->year }}" 
                         aria-valuemin="0" 
                         aria-valuemax="4">
                    </div>
                </div>
                <small class="text-muted">Academic Progress: {{ round(($student->year / 4) * 100) }}%</small>
            </div>
        </div>

        <!-- Student Info Card -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h6 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i> Student Information
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <small class="text-muted">Database ID:</small><br>
                        <code class="text-primary">{{ $student->id }}</code>
                    </li>
                    <li class="mb-2">
                        <small class="text-muted">Created At:</small><br>
                        <code class="text-success">{{ $student->created_at->toISOString() }}</code>
                    </li>
                    <li class="mb-2">
                        <small class="text-muted">Updated At:</small><br>
                        <code class="text-warning">{{ $student->updated_at->toISOString() }}</code>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="mt-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Student
                </a>
                <form class="d-inline" method="POST" action="{{ route('students.destroy', $student) }}" 
                      onsubmit="return confirm('Are you sure you want to delete {{ $student->name }}? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Delete Student
                    </button>
                </form>
                
                <!-- Demo Links -->
                <div class="ms-auto">
                    <a href="/students/hello" class="btn btn-outline-info btn-sm">
                        <i class="bi bi-hand-thumbs-up"></i> Hello Demo
                    </a>
                    <a href="/students/time" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-clock"></i> Time Demo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Information Section -->
<div class="mt-4">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title mb-0">
                <i class="bi bi-lightbulb"></i> Blade Features Demo
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Template Features Used:</h6>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check text-success"></i> <code>@extends</code> - Layout inheritance</li>
                        <li><i class="bi bi-check text-success"></i> <code>@section</code> - Content sections</li>
                        <li><i class="bi bi-check text-success"></i> <code>@if/@elseif/@else</code> - Conditionals</li>
                        <li><i class="bi bi-check text-success"></i> <code>{{ }}</code> - Safe output</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Laravel Features:</h6>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check text-success"></i> Route Model Binding</li>
                        <li><i class="bi bi-check text-success"></i> Carbon Date Formatting</li>
                        <li><i class="bi bi-check text-success"></i> Named Routes</li>
                        <li><i class="bi bi-check text-success"></i> CSRF Protection</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Add some interactivity to the page
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bar
        const progressBar = document.querySelector('.progress-bar');
        if (progressBar) {
            setTimeout(() => {
                progressBar.style.transition = 'width 1s ease-in-out';
                progressBar.style.width = progressBar.style.width;
            }, 500);
        }
        
        // Add tooltips (if Bootstrap tooltips are available)
        const tooltipElements = document.querySelectorAll('[title]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.cursor = 'help';
            });
        });
    });
</script>
@endpush
