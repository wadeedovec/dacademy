<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Questions to Exam: ') . $exam->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('exams.questions.store', $exam) }}" method="POST">
                        @csrf
                        <div id="questions-container">
                            <div class="question-item mb-4">
                                <label class="block text-sm font-medium text-gray-700">Question Text</label>
                                <input type="text" name="questions[0][content]"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <label class="block text-sm font-medium text-gray-700 mt-4">Category</label>
                                <input type="text" name="questions[0][category]"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                        </div>
                        <button type="button" id="add-question"
                            class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Add Another Question</button>
                        <button type="submit" class="mt-4 px-4 py-2 bg-green-500 text-white rounded">Submit
                            Questions</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let questionIndex = 1;
        document.getElementById('add-question').addEventListener('click', function() {
            const container = document.getElementById('questions-container');
            const newQuestion = `
                <div class="question-item mb-4">
                    <label class="block text-sm font-medium text-gray-700">Question Text</label>
                    <input type="text" name="questions[${questionIndex}][content]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <label class="block text-sm font-medium text-gray-700 mt-4">Category</label>
                    <input type="text" name="questions[${questionIndex}][category]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newQuestion);
            questionIndex++;
        });
    </script>
</x-app-layout>
