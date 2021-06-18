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
                        <p class="text-center">
                            @dump($minutes)
                        </p>
                    </div>

                    <div class="col-span-2 lg:col-span-1 p-4 bg-gray-800 rounded-md shadow-md text-gray-300 space-y-1">
                        <p class="text-center">
                            @dump($hours)
                        </p>
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

</body>

</html>
