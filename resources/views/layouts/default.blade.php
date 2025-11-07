<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "Todoist | Home")</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="h-screen">
        <div class="flex flex-col items-center justify-center">
            <div class="w-full space-y-6">
                @include("components.header")
                @yield("main")
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>