<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    //

    public function mostrarQuizes()
    {
        $this->logVisitor();

        return view('quizzes.index');
    }

    public function quiz($slug)
    {
        $this->logVisitor();

        return view("quizzes.$slug.index");
    }
}
