<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hypixel Facade Status</title>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body class="font-sans antialiased bg-gray-900 text-gray-100">

    <div class="container mx-auto px-4">
        <div>
            <section class="py-12 px-4 text-center">
                <div class="w-full max-w-3xl mx-auto">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl mt-2 mb-6 leading-tight font-extrabold font-heading">
                        Hypixel <span class="text-indigo-500 underline">Facade</span> Stats
                    </h2>
                    <p class="mb-8 text-gray-500 text-lg font-medium leading-relaxed">
                        Displays stats over time for the
                        <a href="https://hypixel-api.senither.com/" target="_blank" class="text-indigo-400 hover:text-indigo-500">
                            senither/hypixel-skyblock-facade
                        </a>
                        project.
                    </p>
                </div>
            </section>

            <section class="mx-auto max-w-full">
                <div class="grid py-6 grid-cols-2 gap-5">
                    <div class="col-span-2 lg:col-span-1 p-4 bg-gray-800 rounded-md shadow-md text-gray-300 space-y-1">
                        <h3 class="text-xl text-center">Every minute (Last 3 hours)</h3>
                        <div id="chart-minutes"></div>
                    </div>

                    <div class="col-span-2 lg:col-span-1 p-4 bg-gray-800 rounded-md shadow-md text-gray-300 space-y-1">
                        <h3 class="text-xl text-center">Every 30 minutes (Last 7 days)</h3>
                        <div id="chart-hours"></div>
                    </div>
                </div>
            </section>

        </div>
    </div>


    <footer class="p-12 text-gray-500 text-center">
        <p>
            Created by
            <a href="https://senither.com/" class="text-indigo-500 hover:text-indigo-400 hover:underline">Alexis Tan</a>,
            powered by
            <a href="https://lumen.laravel.com/" class="text-indigo-500 hover:text-indigo-400 hover:underline">Lumen</a>,
            <a href="https://tailwindcss.com/" class="text-indigo-500 hover:text-indigo-400 hover:underline">TailwindCSS</a>, and
            <a href="https://apexcharts.com/" class="text-indigo-500 hover:text-indigo-400 hover:underline">ApexCharts</a>.
        </p>
        <p>
            Get the
            <a href="https://github.com/Senither/hypixel-skyblock-facade"
               class="text-indigo-500 hover:text-indigo-400 hover:underline">source code</a>
            on GitHub.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.27.1/dist/apexcharts.min.js"></script>
    @foreach (['minutes', 'hours'] as $collection)
        <script>
            (new ApexCharts(document.querySelector('#chart-{{ $collection }}'), {
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false,
                    },
                    animations: {
                        enabled: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                colors: ['#818CF8'],
                series: [{
                    name: 'Requests in the last {{ mb_substr($collection, 0, mb_strlen($collection) - 1) }}',
                    data: {!! json_encode($stats[$collection]->values()) !!},
                }],
                stroke: {
                    width: 3,
                    curve: 'straight',
                },
                xaxis: {
                    categories: {!! json_encode($stats[$collection]->keys()) !!},
                    tickAmount: 10,
                    labels: {
                        show: true,
                        style: {
                            colors: {!! json_encode($stats[$collection]->map(fn() => '#5D7280')->values()) !!},
                        },
                    },
                },
                yaxis: [{
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: true,
                        color: '#818CF8',
                    },
                    labels: {
                        style: {
                            colors: '#818CF8',
                        }
                    },
                    title: {
                        text: '{{ ucfirst($collection) }}',
                        style: {
                            color: '#818CF8',
                        },
                    },
                }],
                tooltip: {
                    theme: 'dark',
                    z: {
                        title: 'Requests'
                    },
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 40,
                }
            })).render()

        </script>
    @endforeach
</body>

</html>
