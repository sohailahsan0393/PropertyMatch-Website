<canvas id="investmentChart"></canvas>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($chartData);
        renderChart(chartData);
    });

    function renderChart(data) {
        const ctx = document.getElementById('investmentChart').getContext('2d');

        // Destroy existing chart if it exists
        if (window.investmentChart) {
            window.investmentChart.destroy();
        }

        window.investmentChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Total value',
                        data: data.totalValues,
                        borderColor: '#01a2dd',
                        backgroundColor: 'rgba(1, 162, 221, 0.1)',
                        borderWidth: 3,
                        pointRadius: 5,
                        pointBackgroundColor: '#01a2dd',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Your contributions',
                        data: data.contributions,
                        borderColor: '#343a40',
                        borderWidth: 3,
                        borderDash: [5, 5],
                        pointRadius: 5,
                        pointBackgroundColor: '#343a40',
                        tension: 0.3,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            },
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: PKR ${context.parsed.y.toLocaleString('en-PK')}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'PKR ' + value.toLocaleString('en-PK');
                            }
                        },
                        title: {
                            display: true,
                            text: 'Amount (PKR)',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Investment Period',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    }
</script>
