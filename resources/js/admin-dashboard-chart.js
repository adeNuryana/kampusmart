import Chart from 'chart.js/auto';

const canvas = document.getElementById('userGrowthChart');

if (canvas) {
    const labels = JSON.parse(
        canvas.dataset.labels || '[]'
    );

    const values = JSON.parse(
        canvas.dataset.values || '[]'
    );

    const period = canvas.dataset.period || 'month';
    const year = canvas.dataset.year || '';

    const ctx = canvas.getContext('2d');

    const gradient = ctx.createLinearGradient(
        0,
        0,
        0,
        300
    );

    gradient.addColorStop(
        0,
        'rgba(111, 78, 55, 0.25)'
    );

    gradient.addColorStop(
        1,
        'rgba(111, 78, 55, 0.01)'
    );


    new Chart(ctx, {
        type: 'line',

        data: {
            labels,

            datasets: [
                {
                    label: 'Pengguna Baru',

                    data: values,

                    borderColor: '#6F4E37',

                    backgroundColor: gradient,

                    fill: true,

                    tension: 0.35,

                    borderWidth: 3,

                    pointRadius: 4,

                    pointHoverRadius: 6,

                    pointBackgroundColor: '#FFFFFF',

                    pointBorderColor: '#6F4E37',

                    pointBorderWidth: 2,

                    pointHoverBackgroundColor:
                        '#6F4E37',

                    pointHoverBorderColor:
                        '#FFFFFF',

                    pointHoverBorderWidth: 2,
                }
            ]
        },


        options: {
            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index',
            },


            plugins: {
                legend: {
                    display: false,
                },


                tooltip: {
                    backgroundColor: '#332B26',

                    titleColor: '#FFFFFF',

                    bodyColor: '#F4EAE2',

                    padding: 12,

                    cornerRadius: 10,

                    displayColors: false,

                    callbacks: {
                        title(items) {
                            if (!items.length) {
                                return '';
                            }

                            const label =
                                items[0].label;

                            if (period === 'month') {
                                return `Tanggal ${label}`;
                            }

                            return `${label} ${year}`;
                        },

                        label(context) {
                            return `${context.parsed.y} pengguna baru`;
                        },
                    },
                },
            },


            scales: {
                x: {
                    border: {
                        display: false,
                    },

                    grid: {
                        display: false,
                    },

                    ticks: {
                        color: '#927D6F',

                        font: {
                            size: 10,
                            weight: '500',
                        },

                        maxRotation: 0,

                        autoSkip: false,

                        callback(value) {
                            return this.getLabelForValue(value);
                        },
                    },
                },


                y: {
                    beginAtZero: true,

                    border: {
                        display: false,
                    },

                    grid: {
                        color: '#EEE4DC',
                        drawTicks: false,
                    },

                    ticks: {
                        color: '#927D6F',

                        padding: 10,

                        precision: 0,

                        stepSize: 1,

                        font: {
                            size: 10,
                        },
                    },
                },
            },
        },
    });
}
