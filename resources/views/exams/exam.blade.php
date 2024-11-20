<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Exam') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Questions for: {{ $exam->name }}</h3>

                    <form action="{{ route('exam.submit', $exam->id) }}" method="POST">
                        @csrf

                        <ul>
                            @foreach ($exam->questions as $question)
                                <li class="mb-4">
                                    <strong>Question:</strong> {{ $question->content }} <br>
                                    <strong>Category:</strong> {{ $question->category }} <br>
                                    <label>
                                        <input type="radio" name="answers[{{ $question->id }}]" value="1"
                                        @if (isset($userResponses[$question->id]) && $userResponses[$question->id] == 1) checked @endif required>
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="answers[{{ $question->id }}]" value="0"
                                        @if (isset($userResponses[$question->id]) && $userResponses[$question->id] == 0) checked @endif>
                                        No
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{route('exams.index')}}">Go Back</a>
                        @if ($userResponses->isEmpty())
                            <button type="submit" class="bg-blue-500 px-4 py-2 rounded">Submit Answers</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
