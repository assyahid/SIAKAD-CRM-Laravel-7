<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTestResultRequest;
use App\Http\Requests\StoreTestResultRequest;
use App\Http\Requests\UpdateTestResultRequest;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestResultsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('test_result_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testResults = TestResult::with(['test', 'student'])->get();

        return view('admin.testResults.index', compact('testResults'));
    }

    public function create()
    {
        abort_if(Gate::denies('test_result_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tests = Test::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.testResults.create', compact('tests', 'students'));
    }

    public function store(StoreTestResultRequest $request)
    {
        $testResult = TestResult::create($request->all());

        return redirect()->route('admin.test-results.index');
    }

    public function edit(TestResult $testResult)
    {
        abort_if(Gate::denies('test_result_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tests = Test::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $testResult->load('test', 'student');

        return view('admin.testResults.edit', compact('tests', 'students', 'testResult'));
    }

    public function update(UpdateTestResultRequest $request, TestResult $testResult)
    {
        $testResult->update($request->all());

        return redirect()->route('admin.test-results.index');
    }

    public function show(TestResult $testResult)
    {
        abort_if(Gate::denies('test_result_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testResult->load('test', 'student');

        return view('admin.testResults.show', compact('testResult'));
    }

    public function destroy(TestResult $testResult)
    {
        abort_if(Gate::denies('test_result_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testResult->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestResultRequest $request)
    {
        TestResult::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
