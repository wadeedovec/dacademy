<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function chart()
    {
        // Get the specific exam by name
        $exam = Exam::where('name', 'Personality Test')->firstOrFail();

        // Get unique categories of the questions
        $categories = $exam->questions->pluck('category')->unique();

        // Calculate scores for each category based on user responses
        $categoryScores = $categories->mapWithKeys(function ($category) use ($exam) {
            $score = $exam->questions
                ->where('category', $category)
                ->pluck('id')
                ->reduce(function ($carry, $questionId) {
                    $response = Response::where('question_id', $questionId)
                        ->where('user_id', auth('web')->id())
                        ->first();
                    return $carry + ($response->answer ?? 0);
                }, 0);
            return [$category => $score];
        });

        return view('dashboard', compact('categories', 'categoryScores'));
    }
}
