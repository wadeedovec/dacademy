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
        $exam = Exam::where('id', 1)->firstOrFail();

        $categories = $exam->questions->pluck('category')->unique();

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

        return view('dashboard', [
            'categories' => $categories->values(), 
            'categoryScores' => $categoryScores->values() 
        ]);
        
    }
}
