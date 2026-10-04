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

    new Chart(ctx, {
        type: 'line',

        data: {
            labels,

            datasets: [
                {
                    label: 'Pengguna Baru',

                    data: values,

                    borderColor: '#F97516',

                    backgroundColor: 'rgba(249, 117, 22, 0.12)',

                    fill: true,

                    tension: 0.35,

                    borderWidth: 3,

                    pointRadius: 4,

                    pointHoverRadius: 6,

                    pointBackgroundColor: '#FFFFFF',

                    pointBorderColor: '#F97516',

                    pointBorderWidth: 2,

                    pointHoverBackgroundColor:
                        '#F97516',

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
                    backgroundColor: '#172554',

                    titleColor: '#FFFFFF',

                    bodyColor: '#FFF7ED',

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
                        color: '#172554',

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
                        color: '#172554',

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
