<?php
namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Response;
use Illuminate\Http\Request;
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
}
