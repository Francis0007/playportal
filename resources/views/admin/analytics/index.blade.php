@extends('admin.layouts.master')
@section('title', 'Analytics')

@section('content')
    <div class="container">
        <h1>Analytics</h1>
        <div style="max-width: 800px; margin: 0 auto;">
            <canvas id="analyticsChart" width="400" height="400"></canvas>
        </div>
        <p>Total Apps: {{ $totalApps }}</p>
        <p>Total Android Apps: {{ $totalAndroidApps }}</p>
        <p>Total iOS Apps: {{ $totaliOSApps }}</p>
        <p>Total PC Apps: {{ $totalPCApps ?? '' }}</p>
    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('analyticsChart').getContext('2d');
            var analyticsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Apps', 'Android Apps', 'iOS Apps', 'PC Apps'],
                    datasets: [{
                        label: 'Number of Apps',
                        data: [{{ $totalApps }}, {{ $totalAndroidApps }}, {{ $totaliOSApps }}, {{ $totalPCApps ?? '' }}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)', // Red
                            'rgba(54, 162, 235, 0.5)', // Blue
                            'rgba(255, 206, 86, 0.5)', // Yellow
                            'rgba(75, 192, 192, 0.5)' // Green
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Analytics Summary'
                    }
                }
            });
        });
    </script>
@endsection
