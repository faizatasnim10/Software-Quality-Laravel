@extends('layouts.app')

@section('title', 'Current Time Demo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white text-center">
                <h2 class="card-title mb-0">
                    <i class="bi bi-clock"></i> Current Time
                </h2>
            </div>
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-stopwatch" style="font-size: 5rem; color: #17a2b8;"></i>
                </div>
                
                <!-- Current Time Display -->
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <h1 class="display-2 mb-2" id="current-time">{{ $currentTime }}</h1>
                        <p class="lead mb-0">Server Time (PHP)</p>
                    </div>
                </div>
                
                <!-- Live JavaScript Time -->
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h2 class="display-4 mb-2" id="live-time">--:--:--</h2>
                        <p class="lead mb-0">Live Time (JavaScript)</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-calendar-check text-warning"></i> Today's Date
                                </h5>
                                <p class="h4 text-warning">
                                    {{ now()->format('M d, Y') }}
                                </p>
                                <small class="text-muted">
                                    {{ now()->format('l') }} <!-- Day name -->
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-people text-info"></i> Students
                                </h5>
                                <p class="h4 text-info">
                                    {{ $totalStudents }}
                                </p>
                                <small class="text-muted">
                                    {{ $totalStudents == 1 ? 'Student' : 'Students' }} in database
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-globe text-danger"></i> Timezone
                                </h5>
                                <p class="h4 text-danger">
                                    {{ now()->format('T') }}
                                </p>
                                <small class="text-muted">
                                    {{ config('app.timezone') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <!-- Time Formats Demo -->
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-list-check"></i> Time Format Examples
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>ISO 8601:</strong></td>
                                        <td><code>{{ now()->toISOString() }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Unix Timestamp:</strong></td>
                                        <td><code>{{ now()->timestamp }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Human Readable:</strong></td>
                                        <td><code>{{ now()->diffForHumans() }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Day of Year:</strong></td>
                                        <td><code>{{ now()->dayOfYear }}</code></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Week of Year:</strong></td>
                                        <td><code>{{ now()->weekOfYear }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Quarter:</strong></td>
                                        <td><code>Q{{ now()->quarter }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Days in Month:</strong></td>
                                        <td><code>{{ now()->daysInMonth }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Age (if birthday):</strong></td>
                                        <td><code>{{ now()->age ?? 'N/A' }}</code></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('students.index') }}" class="btn btn-primary">
                            <i class="bi bi-people"></i> View Students
                        </a>
                        <a href="/students/hello" class="btn btn-outline-secondary">
                            <i class="bi bi-hand-wave"></i> Hello Demo
                        </a>
                        <button id="refresh-time" class="btn btn-outline-info">
                            <i class="bi bi-arrow-clockwise"></i> Refresh Time
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Technical Information -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i> Technical Details
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Laravel Carbon Features:</h6>
                        <ul class="small">
                            <li><code>now()</code> - Current timestamp</li>
                            <li><code>format()</code> - Custom formatting</li>
                            <li><code>diffForHumans()</code> - Relative time</li>
                            <li><code>toISOString()</code> - ISO format</li>
                            <li><code>addDays()</code> - Date arithmetic</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>View Features Used:</h6>
                        <ul class="small">
                            <li>Data passing from controller</li>
                            <li>Blade template inheritance</li>
                            <li>JavaScript integration</li>
                            <li>Conditional rendering</li>
                            <li>Real-time updates</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const liveTimeElement = document.getElementById('live-time');
        const currentTimeElement = document.getElementById('current-time');
        const refreshButton = document.getElementById('refresh-time');
        
        // Update live time every second
        function updateLiveTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            liveTimeElement.textContent = timeString;
        }
        
        // Start the live time updates
        updateLiveTime();
        const timeInterval = setInterval(updateLiveTime, 1000);
        
        // Refresh server time button
        refreshButton.addEventListener('click', function() {
            const button = this;
            const originalText = button.innerHTML;
            
            button.innerHTML = '<i class="bi bi-hourglass-split"></i> Refreshing...';
            button.disabled = true;
            
            // Simulate server refresh (in real app, this would be an AJAX call)
            setTimeout(() => {
                const now = new Date();
                const serverTimeString = now.toLocaleTimeString('en-US', {
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                currentTimeElement.textContent = now.toISOString().slice(0, 19).replace('T', ' ');
                
                button.innerHTML = originalText;
                button.disabled = false;
                
                // Flash effect
                currentTimeElement.style.background = '#28a745';
                currentTimeElement.style.color = 'white';
                currentTimeElement.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    currentTimeElement.style.background = '';
                    currentTimeElement.style.color = '';
                }, 1000);
            }, 1000);
        });
        
        // Add animation to the clock icon
        const clockIcon = document.querySelector('.bi-stopwatch');
        if (clockIcon) {
            setInterval(() => {
                clockIcon.style.transform = 'rotate(360deg)';
                setTimeout(() => {
                    clockIcon.style.transform = 'rotate(0deg)';
                }, 1000);
            }, 5000);
            
            clockIcon.style.transition = 'transform 1s ease-in-out';
        }
        
        // Cleanup interval when page is unloaded
        window.addEventListener('beforeunload', function() {
            clearInterval(timeInterval);
        });
    });
</script>
@endpush
