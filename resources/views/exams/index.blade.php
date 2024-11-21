<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Exams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Exam List') }}</h3>
                        <a href="{{ route('exams.create') }}"
                            class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                            {{ __('Create New Exam') }}
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($exams as $exam)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $exam->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-300">
                                            {{ $exam->description }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-4">
                                        <a href="{{ route('exams.show', $exam) }}"
                                            class="text-blue-500 hover:text-blue-700">
                                            View
                                        </a>
                                        <a href="{{ route('exams.edit', $exam) }}"
                                            class="text-green-500 hover:text-green-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('exams.destroy', $exam) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700"
                                                onclick="return confirm('Are you sure you want to delete this exam?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($exams->isEmpty())
                        <p class="mt-4 text-center text-gray-500 dark:text-gray-400">
                            No exams available. <a href="{{ route('exams.create') }}"
                                class="text-blue-500 hover:underline">Create one now</a>.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
