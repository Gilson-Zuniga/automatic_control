<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            html{line-height:1.15;-webkit-text-size-adjust:100%}
            body{margin:0}
            a{background-color:transparent}
            [hidden]{display:none}
            html{font-family:'Nunito', sans-serif;line-height:1.6}
            body{font-family:'Nunito', sans-serif}
            .antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
            .relative{position:relative}
            .flex{display:flex}
            .items-top{align-items:flex-start}
            .justify-center{justify-content:center}
            .min-h-screen{min-height:100vh}
            .bg-gray-100{background-color:#f7fafc}
            .dark .bg-gray-900{background-color:#1a202c}
            .sm\:items-center{align-items:center}
            .sm\:pt-0{padding-top:0}
            .fixed{position:fixed}
            .top-0{top:0}
            .right-0{right:0}
            .px-6{padding-left:1.5rem;padding-right:1.5rem}
            .py-4{padding-top:1rem;padding-bottom:1rem}
            .text-sm{font-size:.875rem}
            .text-gray-700{color:#4a5568}
            .dark .text-gray-500{color:#a0aec0}
            .underline{text-decoration:underline}
            .ml-4{margin-left:1rem}
            .mt-2{margin-top:.5rem}
            .text-gray-600{color:#718096}
            .dark .text-gray-400{color:#cbd5e0}
            .text-center{text-align:center}
        </style>
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="text-center mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    Laravel {{ Illuminate\Foundation\Application::VERSION }} (PHP {{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </body>
</html>
