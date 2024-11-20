<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\Middleware;
class ExamController extends Controller
{
    //
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'role_or_permission:manager|edit articles',
            new Middleware('role:author', only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except: ['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete records,api'), only: ['destroy']),
        ];
    }
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }
    public function show(Exam $exam)
    {
        return view('exams.exam', compact('exam'));
    }
    public function create() {}
}
