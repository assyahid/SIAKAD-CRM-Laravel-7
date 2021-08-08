<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLessonRequest;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LessonsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::with(['course', 'media'])->get();

        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessons.create', compact('courses'));
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->all());

        foreach ($request->input('thumbnail', []) as $file) {
            $lesson->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('thumbnail');
        }

        if ($request->input('video', false)) {
            $lesson->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lesson->id]);
        }

        return redirect()->route('admin.lessons.index');
    }

    public function edit(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lesson->load('course');

        return view('admin.lessons.edit', compact('courses', 'lesson'));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->all());

        if (count($lesson->thumbnail) > 0) {
            foreach ($lesson->thumbnail as $media) {
                if (!in_array($media->file_name, $request->input('thumbnail', []))) {
                    $media->delete();
                }
            }
        }
        $media = $lesson->thumbnail->pluck('file_name')->toArray();
        foreach ($request->input('thumbnail', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lesson->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('thumbnail');
            }
        }

        if ($request->input('video', false)) {
            if (!$lesson->video || $request->input('video') !== $lesson->video->file_name) {
                if ($lesson->video) {
                    $lesson->video->delete();
                }
                $lesson->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($lesson->video) {
            $lesson->video->delete();
        }

        return redirect()->route('admin.lessons.index');
    }

    public function show(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->load('course');

        return view('admin.lessons.show', compact('lesson'));
    }

    public function destroy(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonRequest $request)
    {
        Lesson::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lesson_create') && Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Lesson();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
