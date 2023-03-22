<template>
    <div>
        <canvas ref="chart" width="749" height="350"></canvas>
    </div>
</template>

<script>
import Chart from 'chart.js/auto';

export default {
    props: ['chartData', 'chartType'],
    mounted() {
        this.createChart();
    },
    methods: {
        createChart() {
            const ctx = this.$refs.chart.getContext('2d');
            const chart = new Chart(ctx, {
                type: this.chartType,
                data: {
                    labels: this.chartData.labels,
                    datasets: [
                        {
                            label: 'Opens',
                            data: this.chartData.opens,
                            fill: this.chartType === 'line',
                            backgroundColor: this.chartType === 'bar' ? '#3B82EC' : 'transparent', // Updated color
                            borderColor: "#3B82EC",
                            tension: this.chartType === 'line' ? 0.4 : 0,
                        },
                        {
                            label: 'Clicks',
                            data: this.chartData.clicks,
                            fill: this.chartType === 'line',
                            backgroundColor: this.chartType === 'bar' ? '#E8EAED' : 'transparent', // Updated color
                            borderColor: '#E8EAED',
                            borderDash: this.chartType === 'line' ? [4, 4] : [],
                            tension: this.chartType === 'line' ? 0.4 : 0,
                        },
                    ],

                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                        },
                        tooltip: {
                            intersect: false,
                        },
                        filler: {
                            propagate: false,
                        },
                    },
                    interaction: {
                        intersect: true,
                    },
                    scales: {
                        x: {
                            grid: {
                                color: "rgba(0,0,0,0.05)",
                            },
                            ticks: {
                                maxTicksLimit: 15,
                            },
                        },
                        y: {
                            ticks: {
                                stepSize: 500,
                            },
                            display: true,
                            grid: {
                                color: "rgba(0,0,0,0)",
                                borderColor: "rgba(0,0,0,0)",
                                tickColor: "#fff",
                            },
                            borderDash: [5, 5],
                        },
                    },
                },

            });
        },
    },

};
</script>
