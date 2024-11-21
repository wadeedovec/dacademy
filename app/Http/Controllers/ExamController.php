<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\Question;
use PhpParser\Node\Expr\FuncCall;

class ExamController extends Controller
{
    //
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }
    public function show(Exam $exam)
    {
        $userResponses = $exam->responses()
            ->where('user_id', auth('web')->id())
            ->pluck('answer', 'question_id');
        return view('exams.exam', compact('exam', 'userResponses'));
    }
    public function submit(Request $request, Exam $exam)
    {
        foreach ($request->answers as $questionId => $answer) {
            Response::create([
                'user_id' => auth('web')->id(),
                'question_id' => $questionId,
                'answer' => $answer,
                'exam_id' => $exam->id,
            ]);
        }
        return redirect()->route('exams.index', $exam->id)->with('success', 'Your answers have been submitted!');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $exam = Exam::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('exams.index')->with('success', 'New exam has been created!');
    }
    public function create()
    {
        return view('exams.create');
    }
    public function createQuestions(Exam $exam)
    {
        return view('exams.create-questions', compact('exam'));
    }
    public function storeQuestions(Request $request, Exam $exam)
    {
        $request->validate([
            'questions.*.content' => 'required|string|max:255',
            'questions.*.category' => 'required|string|max:100',
        ]);
        foreach ($request->questions as $question) {
            Question::create([
                'exam_id' => $exam->id,
                'content' => $question['content'],
                'category' => $question['category'],
            ]);
        }
        return redirect()->route('exams.show', $exam)->with('success', 'Questions added successfully!');
    }
    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $exam->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('exams.index')->with('success', 'Exam updated successfully!');
    }
    public function edit(Exam $exam)
    {
        return view('exams.edit', compact('exam'));
    }
}
