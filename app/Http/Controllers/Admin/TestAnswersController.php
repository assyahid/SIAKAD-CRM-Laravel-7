<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTestAnswerRequest;
use App\Http\Requests\StoreTestAnswerRequest;
use App\Http\Requests\UpdateTestAnswerRequest;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\TestAnswer;
use App\Models\TestResult;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestAnswersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('test_answer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testAnswers = TestAnswer::with(['test_result', 'question', 'option'])->get();

        return view('admin.testAnswers.index', compact('testAnswers'));
    }

    public function create()
    {
        abort_if(Gate::denies('test_answer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $test_results = TestResult::all()->pluck('score', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questions = Question::all()->pluck('question_text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $options = QuestionOption::all()->pluck('option_text', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.testAnswers.create', compact('test_results', 'questions', 'options'));
    }

    public function store(StoreTestAnswerRequest $request)
    {
        $testAnswer = TestAnswer::create($request->all());

        return redirect()->route('admin.test-answers.index');
    }

    public function edit(TestAnswer $testAnswer)
    {
        abort_if(Gate::denies('test_answer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $test_results = TestResult::all()->pluck('score', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questions = Question::all()->pluck('question_text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $options = QuestionOption::all()->pluck('option_text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $testAnswer->load('test_result', 'question', 'option');

        return view('admin.testAnswers.edit', compact('test_results', 'questions', 'options', 'testAnswer'));
    }

    public function update(UpdateTestAnswerRequest $request, TestAnswer $testAnswer)
    {
        $testAnswer->update($request->all());

        return redirect()->route('admin.test-answers.index');
    }

    public function show(TestAnswer $testAnswer)
    {
        abort_if(Gate::denies('test_answer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testAnswer->load('test_result', 'question', 'option');

        return view('admin.testAnswers.show', compact('testAnswer'));
    }

    public function destroy(TestAnswer $testAnswer)
    {
        abort_if(Gate::denies('test_answer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testAnswer->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestAnswerRequest $request)
    {
        TestAnswer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
