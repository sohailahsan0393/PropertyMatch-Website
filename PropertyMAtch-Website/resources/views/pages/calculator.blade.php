<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('styles/home.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/about.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/add-property.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/register.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/calculator.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/property-detail.css') }}">
</head>
<body>
 
    <x-nav />
    <div class="investment-calculator-container">
        <div class="investment-form">
            <h2>Investment Calculator</h2>
            <input type="number" id="initial" placeholder="(PKR) Initial Investment Amount" value="">
            <input type="number" id="monthly" placeholder="(PKR) Monthly Contribution (Optional)" value="">
            <input type="number" id="rate" placeholder="Estimated Rate of Return %" value="">
            <input type="number" id="years" placeholder="Years to grow" value="">
            <button onclick="calculate()" class="investment-calculate-btn">Calculate</button>
            <p class="note">* All fields are required except monthly contribution</p>
        </div>

        <div class="investment-result">
            <h3>Your Future Value</h3>
            <h1 id="futureValue" class="investment-result-value">PKR 0</h1>

            <div class="investment-chart-container" style="width: 100%; max-width: 500px; margin: auto; height: 400px;">
                <canvas id="investmentChart" style="height: 100% !important; width: 100% !important;"></canvas>
            </div>

            <div class="summary-container">
                <div class="summary-card">
                    <h4>Total Invested</h4>
                    <p id="totalInvested">PKR 0</p>
                </div>

                <div class="summary-card">
                    <h4>Profit Earned</h4>
                    <p id="interestEarned">PKR 0</p>
                </div>
            </div>
        </div>
    </div>
<x-footer />

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function calculate() {
        const initial = parseFloat(document.getElementById('initial').value);
        const monthly = parseFloat(document.getElementById('monthly').value) || 0;
        const rate = parseFloat(document.getElementById('rate').value) / 100;
        const years = parseInt(document.getElementById('years').value);

        let futureValue = initial * Math.pow((1 + rate), years);
        let totalInvested = initial;

        for (let i = 1; i <= years; i++) {
            futureValue += monthly * 12 * Math.pow((1 + rate), (years - i));
            totalInvested += monthly * 12;
        }

        const interestEarned = futureValue - totalInvested;

        document.getElementById('futureValue').innerText = `PKR ${futureValue.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
        document.getElementById('totalInvested').innerText = `PKR ${totalInvested.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
        document.getElementById('interestEarned').innerText = `PKR ${interestEarned.toLocaleString(undefined, {maximumFractionDigits: 0})}`;

        console.log("Drawing chart", totalInvested, interestEarned);
        setTimeout(() => drawChart(totalInvested, interestEarned), 100);
    }

    let chart;
    function drawChart(invested, interest) {
        const canvas = document.getElementById('investmentChart');
        if (!canvas) {
            console.error("Canvas not found");
            return;
        }

        const ctx = canvas.getContext('2d');
        if (!ctx) {
            console.error("Canvas context not found");
            return;
        }

        if (chart) chart.destroy();

        chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Total Invested', 'Interest Earned'],
                datasets: [{
                    data: [invested, interest],
                    backgroundColor: ['#4CAF50', '#FFC107'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#333' }
                    }
                }
            }
        });
    }
</script>


    <script src="{{ asset('js/script.js') }}"></script>
    {{-- <script>

        window.addEventListener('mouseover', initLandbot, { once: true });

        window.addEventListener('touchstart', initLandbot, { once: true });

        var myLandbot;

        function initLandbot() {

            if (!myLandbot) {

                var s = document.createElement('script');

                s.type = "module"

                s.async = true;

                s.addEventListener('load', function() {

                    var myLandbot = new Landbot.Livechat({

                        configUrl: 'https://storage.googleapis.com/landbot.online/v3/H-2994092-87MC7JYGJPYQ3VW0/index.json',

                    });

                });

                s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.mjs';

                var x = document.getElementsByTagName('script')[0];

                x.parentNode.insertBefore(s, x);

            }

        }

    </script> --}}
    <x-chatbot>
    </x-chatbot> 
</body>
</html>
    
