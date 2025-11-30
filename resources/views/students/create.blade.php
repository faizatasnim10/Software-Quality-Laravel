@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h3 class="card-title mb-0">
                    <i class="bi bi-person-plus"></i> Add New Student
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="bi bi-person"></i> Full Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Enter student's full name"
                               required>
                        @error('name')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i> Email Address
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="student@example.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

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
                            <option value="Computer Science" {{ old('major') == 'Computer Science' ? 'selected' : '' }}>
                                Computer Science
                            </option>
                            <option value="Mathematics" {{ old('major') == 'Mathematics' ? 'selected' : '' }}>
                                Mathematics
                            </option>
                            <option value="Physics" {{ old('major') == 'Physics' ? 'selected' : '' }}>
                                Physics
                            </option>
                            <option value="Chemistry" {{ old('major') == 'Chemistry' ? 'selected' : '' }}>
                                Chemistry
                            </option>
                            <option value="Biology" {{ old('major') == 'Biology' ? 'selected' : '' }}>
                                Biology
                            </option>
                            <option value="Engineering" {{ old('major') == 'Engineering' ? 'selected' : '' }}>
                                Engineering
                            </option>
                            <option value="Business" {{ old('major') == 'Business' ? 'selected' : '' }}>
                                Business
                            </option>
                            <option value="Psychology" {{ old('major') == 'Psychology' ? 'selected' : '' }}>
                                Psychology
                            </option>
                            <option value="Art" {{ old('major') == 'Art' ? 'selected' : '' }}>
                                Art
                            </option>
                            <option value="History" {{ old('major') == 'History' ? 'selected' : '' }}>
                                History
                            </option>
                        </select>
                        @error('major')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

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
                            <option value="1" {{ old('year') == '1' ? 'selected' : '' }}>
                                1st Year (Freshman)
                            </option>
                            <option value="2" {{ old('year') == '2' ? 'selected' : '' }}>
                                2nd Year (Sophomore)
                            </option>
                            <option value="3" {{ old('year') == '3' ? 'selected' : '' }}>
                                3rd Year (Junior)
                            </option>
                            <option value="4" {{ old('year') == '4' ? 'selected' : '' }}>
                                4th Year (Senior)
                            </option>
                        </select>
                        @error('year')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                            Create Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
