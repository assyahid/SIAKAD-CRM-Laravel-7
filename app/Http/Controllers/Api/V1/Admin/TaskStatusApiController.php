<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Resources\Admin\TaskStatusResource;
use App\Models\TaskStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskStatusResource(TaskStatus::all());
    }

    public function store(StoreTaskStatusRequest $request)
    {
        $taskStatus = TaskStatus::create($request->all());

        return (new TaskStatusResource($taskStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TaskStatus $taskStatus)
    {
        abort_if(Gate::denies('task_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskStatusResource($taskStatus);
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $taskStatus->update($request->all());

        return (new TaskStatusResource($taskStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TaskStatus $taskStatus)
    {
        abort_if(Gate::denies('task_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
