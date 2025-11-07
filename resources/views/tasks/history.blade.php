@extends("layouts.default")

@section("title", "Todoist | History")

@section("main")
    <section class="flex flex-col items-center mt-25">

        @if (session()->has("success"))
            <div id="alert-border-3"
                class="w-full flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session()->get("success") }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-border-3" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        @if (session()->has("error"))
            <div id="alert-border-2"
                class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session()->get("error") }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-border-2" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <h2 class="text-4xl font-bold">Tasks History</h2>

        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <div class="w-full max-w-6xl px-4 mx-auto lg:px-12 my-4">
                    <div class="relative overflow-hidden bg-white shadow-md rounded-lg">
                        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                            <div class="flex flex-col sm:flex-row items-center">
                                <a href="{{ route("task.view", $task->id) }}" class="mr-4">
                                    <x-lucide-eye class="size-6" />
                                </a>
                                <div>
                                    <h3 class="mr-3 text-lg font-bold">{{ $task->title }} <span class="font-semibold text-base">|
                                            {{ $task->deadline }}</span></h3>
                                    <p class="text-gray-500">{{ Str::words($task->description, 20) }}</p>
                                    <p class="text-gray-500 text-sm">Created on: <span
                                            class="font-semibold">{{ $task->created_at_formatted }}</span></p>
                                </div>
                            </div>
                            <div class="flex items-center mt-2 sm:mt-0">
                                <button type="button"
                                    class="text-white {{ $task->status === "Pending" ? "bg-yellow-400" : "bg-green-400" }}  cursor-not-allowed font-medium rounded-lg text-sm px-4 py-2 text-center"
                                    disabled>
                                    {{ $task->status }}
                                </button>

                                <a href="{{ route("tasks.update", $task->id) }}" data-tooltip-target="tooltip-left"
                                    data-tooltip-placement="left"
                                    class="ms-3 {{ $task->status === "Completed" ? "cursor-not-allowed" : "hover:bg-blue-800" }} text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center">
                                    <x-lucide-check class="size-4" />
                                </a>
                                <div id="tooltip-left" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip">
                                    Mark as complete
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <a href="{{ route("tasks.delete", $task->id) }}" data-tooltip-target="tooltip-right"
                                    data-tooltip-placement="left" type="button"
                                    class="ms-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center">
                                    <x-lucide-trash-2 class="size-4" />
                                </a>
                                <div id="tooltip-right" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip">
                                    Delete Task
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="flex items-center justify-center mt-30">
                <h4 class="text-2xl font-semibold">No tasks available</h4>
            </div>
        @endif
    </section>
@endsection