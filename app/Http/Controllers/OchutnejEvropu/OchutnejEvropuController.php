<?php

namespace App\Http\Controllers\OchutnejEvropu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OchutnejEvropuController extends Controller
{
    public function index()
    {
        return view('ochutnej-evropu.index');
    }

    public function evaluate()
    {
        $answers = request()->validate([
            'answer1' => ['required', 'regex:/[a-d]/'],
            'answer2' => ['required', 'regex:/[a-d]/'],
            'answer3' => ['required', 'regex:/[a-d]/'],
            'answer4' => ['required', 'regex:/[a-d]/'],
        ]);

        $answers = [
            'answer1' => [
                'expected' => 'a',
                'answered' => $answers['answer1'],
            ],
            'answer2' => [
                'expected' => 'd',
                'answered' => $answers['answer2'],
            ],
            'answer3' => [
                'expected' => 'c',
                'answered' => $answers['answer3'],
            ],
            'answer4' => [
                'expected' => 'd',
                'answered' => $answers['answer4'],
            ],
        ];

        $answers['answer1']['correct'] = $answers['answer1']['expected'] === $answers['answer1']['answered'];
        $answers['answer2']['correct'] = $answers['answer2']['expected'] === $answers['answer2']['answered'];
        $answers['answer3']['correct'] = $answers['answer3']['expected'] === $answers['answer3']['answered'];
        $answers['answer4']['correct'] = $answers['answer4']['expected'] === $answers['answer4']['answered'];

        if (!$answers['answer3']['correct']) {
            return redirect(route('ochutnej-evropu.result'))->with([
                'success' => false,
                'answers' => $answers,
            ]);
        }

        return redirect(route('ochutnej-evropu.result'))->with([
            'success' => true,
            'answers' => $answers,
        ]);
    }

    public function result()
    {
        $answers = session('answers');

        return view('ochutnej-evropu.result', compact('answers'));
    }
}
