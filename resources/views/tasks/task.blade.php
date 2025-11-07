@extends("layouts.default")

@section("title", "Todoist")

@section("main")
    <div class="h-screen">
        <div class="container mx-auto pt-25">
            <div class="flex flex-col items-center p-6">
                @foreach ($data as $task)
                    <div class="max-w-3xl p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div>
                            <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">
                                {{ $task->title }}
                                <span class="{{ $task->status === "Pending" ? "bg-yellow-100 text-yellow-800" : "bg-green-100 text-green-800" }} text-xs font-medium
                                                                    ml-2 mb-4 px-2.5 py-0.5 rounded-full ">
                                    {{ $task->status }}
                                </span>
                            </h5>
                        </div>
                        <p class=" mb-4 font-normal text-gray-700 ">
                            {{ $task->description }}
                        </p>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center mb-4">
                            <p class="font-semibold text-gray-500">
                                <span
                                    class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm ">Created
                                    on
                                </span> {{ $task->created_at_formatted }}
                            </p>
                            <p class="sm:ml-5 font-semibold text-gray-500">
                                <span
                                    class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm ">Deadline
                                </span> {{ $task->deadline }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route("tasks.update", $task->id) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700
                                                            rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <x-lucide-check class="size-6" />
                            </a>
                            <a href="{{ route("tasks.delete", $task->id) }}"
                                class="ml-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700
                                                            rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                <x-lucide-trash-2 class="size-6" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection