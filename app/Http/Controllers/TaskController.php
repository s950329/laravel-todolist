<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // 獲取當前登入用戶任務清單
        $tasks = auth()->user()->tasks()->paginate();

        return new TaskCollection($tasks);
    }

    public function store(CreateTaskRequest $request)
    {
        // 獲取已經驗證欄位
        $data = $request->validated();

        // 如果有附檔則儲存
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->storePublicly('files');
        }

        // 創建任務
        $task = auth()->user()->tasks()->create($data);

        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        $this->authorize('mine', $task);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('mine', $task);

        // 獲取已經驗證欄位
        $data = $request->validated();

        // 如果有附檔則儲存
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->storePublicly('files');
        }

        // 更新任務
        $task->update($data);

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $this->authorize('mine', $task);

        // 刪除任務
        $task->delete();

        return response()->json(['code' => 200, 'message' => 'success']);
    }

    public function destroyAll()
    {
        auth()->user()->tasks()->delete();

        return response()->json(['code' => 200, 'message' => 'success']);
    }
}
