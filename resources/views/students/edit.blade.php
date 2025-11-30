@extends('layouts.app')

@section('title', 'Edit Student - ' . $student->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Student: {{ $student->name }}
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('students.update', $student) }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="bi bi-person"></i> Full Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $student->name) }}" 
                               placeholder="Enter student's full name"
                               required>
                        @error('name')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            Current: <strong>{{ $student->name }}</strong>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i> Email Address
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $student->email) }}" 
                               placeholder="student@example.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            Current: <strong>{{ $student->email }}</strong>
                        </div>
                    </div>

                    <!-- Major Field -->
                    <div class="mb-3">
                        <label for="major" class="form-label">
                            <i class="bi bi-book"></i> Major
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('major') is-invalid @enderror" 
                                id="major" 
                                name="major" 
                                required>
                            <option value="">-- Select Major --</option>
                            @php
                                $majors = [
                                    'Computer Science' => '💻 Computer Science',
                                    'Mathematics' => '🔢 Mathematics', 
                                    'Physics' => '⚛️ Physics',
                                    'Chemistry' => '🧪 Chemistry',
                                    'Biology' => '🧬 Biology',
                                    'Engineering' => '⚙️ Engineering',
                                    'Business' => '💼 Business',
                                    'Psychology' => '🧠 Psychology',
                                    'Art' => '🎨 Art',
                                    'History' => '📚 History'
                                ];
                            @endphp
                            @foreach($majors as $value => $label)
                                <option value="{{ $value }}" 
                                        {{ old('major', $student->major) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('major')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            Current: <strong>{{ $student->major }}</strong>
                        </div>
                    </div>

                    <!-- Year Field -->
                    <div class="mb-3">
                        <label for="year" class="form-label">
                            <i class="bi bi-calendar-check"></i> Academic Year
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('year') is-invalid @enderror" 
                                id="year" 
                                name="year" 
                                required>
                            <option value="">-- Select Year --</option>
                            @for($i = 1; $i <= 4; $i++)
                                @php
                                    $yearNames = [
                                        1 => '🌱 1st Year (Freshman)',
                                        2 => '📚 2nd Year (Sophomore)', 
                                        3 => '🎯 3rd Year (Junior)',
                                        4 => '🎓 4th Year (Senior)'
                                    ];
                                @endphp
                                <option value="{{ $i }}" 
                                        {{ old('year', $student->year) == $i ? 'selected' : '' }}>
                                    {{ $yearNames[$i] }}
                                </option>
                            @endfor
                        </select>
                        @error('year')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            Current: <strong>Year {{ $student->year }}</strong>
                            @if($student->year == 1) (Freshman)
                            @elseif($student->year == 2) (Sophomore)
                            @elseif($student->year == 3) (Junior)
                            @else (Senior)
                            @endif
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('students.show', $student) }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Side Panel with Information -->
    <div class="col-md-4">
        <!-- Current Information -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="bi bi-person-circle"></i> Current Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><small>{{ $student->email }}</small></td>
                    </tr>
                    <tr>
                        <td><strong>Major:</strong></td>
                        <td>{{ $student->major }}</td>
                    </tr>
                    <tr>
                        <td><strong>Year:</strong></td>
                        <td>
                            <span class="badge 
                                @if($student->year == 1) bg-success
                                @elseif($student->year == 2) bg-info
                                @elseif($student->year == 3) bg-warning
                                @else bg-danger
                                @endif">
                                Year {{ $student->year }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Registered:</strong></td>
                        <td><small>{{ $student->created_at->format('M d, Y') }}</small></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Update Information -->
        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <h6 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i> Update Information
                </h6>
            </div>
            <div class="card-body">
                <h6>Form Features</h6>
                <ul class="list-unstyled small">
                    <li><i class="bi bi-shield-check text-success"></i> CSRF Protection</li>
                    <li><i class="bi bi-arrow-clockwise text-info"></i> Form State Preservation</li>
                    <li><i class="bi bi-exclamation-triangle text-warning"></i> Validation Errors</li>
                    <li><i class="bi bi-pencil text-primary"></i> HTTP PUT Method</li>
                </ul>
                
                <hr>
                
                <h6>Validation Rules</h6>
                <ul class="list-unstyled small">
                    <li><code>name</code>: Required, max 255 chars</li>
                    <li><code>email</code>: Required, valid email, unique</li>
                    <li><code>major</code>: Required, max 255 chars</li>
                    <li><code>year</code>: Required, 1-4 integer</li>
                </ul>
            </div>
        </div>

        <!-- Blade Features Demo -->
        <div class="card mt-3">
            <div class="card-header bg-secondary text-white">
                <h6 class="card-title mb-0">
                    <i class="bi bi-code-square"></i> Blade Features
                </h6>
            </div>
            <div class="card-body">
                <h6>Features Used:</h6>
                <ul class="list-unstyled small">
                    <li><code>@method('PUT')</code> - HTTP method spoofing</li>
                    <li><code>old('field', $model->field)</code> - Form state with fallback</li>
                    <li><code>@foreach</code> - Loop through options</li>
                    <li><code>@php</code> - Inline PHP code</li>
                    <li><code>@for</code> - Simple loops</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');
        
        // Track form changes
        let hasChanges = false;
        const formFields = form.querySelectorAll('input, select');
        
        formFields.forEach(field => {
            const originalValue = field.value;
            
            field.addEventListener('input', function() {
                hasChanges = this.value !== originalValue;
                updateSubmitButton();
            });
            
            field.addEventListener('change', function() {
                hasChanges = this.value !== originalValue;
                updateSubmitButton();
            });
        });
        
        function updateSubmitButton() {
            if (hasChanges) {
                submitButton.classList.remove('btn-warning');
                submitButton.classList.add('btn-success');
                submitButton.innerHTML = '<i class="bi bi-check-circle"></i> Save Changes';
            } else {
                submitButton.classList.remove('btn-success');
                submitButton.classList.add('btn-warning');
                submitButton.innerHTML = '<i class="bi bi-check-circle"></i> Update Student';
            }
        }
        
        // Form submission feedback
        form.addEventListener('submit', function() {
            submitButton.innerHTML = '<i class="bi bi-hourglass-split"></i> Updating...';
            submitButton.disabled = true;
        });
        
        // Warn about unsaved changes
        window.addEventListener('beforeunload', function(e) {
            if (hasChanges) {
                e.preventDefault();
                e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
                return e.returnValue;
            }
        });
        
        // Remove warning when navigating to safe pages
        const cancelButton = document.querySelector('a.btn-secondary');
        if (cancelButton) {
            cancelButton.addEventListener('click', function() {
                if (hasChanges) {
                    return confirm('You have unsaved changes. Are you sure you want to cancel?');
                }
            });
        }
    });
</script>
@endpush
