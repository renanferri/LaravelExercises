<?php

namespace App\Http\Controllers\Bracket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bracket\FilterBracketRequest;
use App\Services\Brackets\BracketValidatorService;

class BracketController extends Controller
{
    public function __construct(
        public BracketValidatorService $bracketServiceValidator
    )
    {        
    }

    public function index()
    {
        return view('brackets.index');
    }

    public function runValidator(FilterBracketRequest $request)
    {
        $correct = $this->bracketServiceValidator->run($request->validated()['brackets']);

        if (!$correct)
            return redirect()->route('brackets.index')->with('warning', 'The Format of Brackets is incorrect!');    

        return redirect()->route('brackets.index')->with('success', 'Brackets is correct!');
    }
}
