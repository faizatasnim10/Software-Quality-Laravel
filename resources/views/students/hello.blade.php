@extends('layouts.app')

@section('title', 'Hello World Demo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="card-title mb-0">
                    <i class="bi bi-hand-wave"></i> Hello World!
                </h2>
            </div>
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-emoji-smile" style="font-size: 5rem; color: #ffc107;"></i>
                </div>
                
                <h3 class="text-primary mb-3">Welcome to Laravel Views & Controllers!</h3>
                
                <p class="lead text-muted mb-4">
                    This is a simple Laravel controller response using Blade templating engine.
                    No more concatenating HTML strings - we now have beautiful, maintainable views!
                </p>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-people text-success"></i> Database Stats
                                </h5>
                                <p class="card-text display-4 text-success mb-0">
                                    {{ $totalStudents }}
                                </p>
                                <small class="text-muted">
                                    {{ $totalStudents == 1 ? 'Student' : 'Students' }} in database
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-clock text-info"></i> Current Time
                                </h5>
                                <p class="card-text text-info mb-0">
                                    {{ now()->format('H:i:s') }}
                                </p>
                                <small class="text-muted">
                                    {{ now()->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('students.index') }}" class="btn btn-primary">
                        <i class="bi bi-people"></i> View Students
                    </a>
                    <a href="/students/time" class="btn btn-outline-secondary">
                        <i class="bi bi-clock"></i> Time Demo
                    </a>
                    <a href="{{ route('students.create') }}" class="btn btn-outline-success">
                        <i class="bi bi-plus-circle"></i> Add Student
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Evolution Information -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightbulb"></i> Evolution from Lesson 5
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-danger">❌ Before (Lesson 5):</h6>
                        <pre class="bg-light p-3"><code>public function hello()
{
    return '&lt;h1&gt;Hello World!&lt;/h1&gt;
            &lt;p&gt;Students: ' . Student::count() . '&lt;/p&gt;
            &lt;a href="/students"&gt;View Students&lt;/a&gt;';
}</code></pre>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-success">✅ Now (Lesson 6):</h6>
                        <pre class="bg-light p-3"><code>public function hello()
{
    $totalStudents = Student::count();
    return view('students.hello', 
               compact('totalStudents'));
}</code></pre>
                    </div>
                </div>
                
                <hr>
                
                <h6>Benefits of Using Views:</h6>
                <ul class="mb-0">
                    <li><strong>Separation of Concerns:</strong> Logic separated from presentation</li>
                    <li><strong>Reusability:</strong> Layout can be shared across pages</li>
                    <li><strong>Maintainability:</strong> HTML in dedicated template files</li>
                    <li><strong>Features:</strong> Template inheritance, components, conditionals</li>
                    <li><strong>Security:</strong> Automatic XSS protection with double curly braces</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add some animation to the emoji
        const emoji = document.querySelector('.bi-emoji-smile');
        if (emoji) {
            setInterval(() => {
                emoji.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    emoji.style.transform = 'scale(1)';
                }, 200);
            }, 2000);
            
            emoji.style.transition = 'transform 0.2s ease';
        }
        
        // Update time every second
        const timeElement = document.querySelector('.text-info');
        if (timeElement) {
            setInterval(() => {
                const now = new Date();
                timeElement.textContent = now.toLocaleTimeString('en-US', {
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit', 
                    second: '2-digit'
                });
            }, 1000);
        }
    });
</script>
@endpush
