<?php

namespace App\Http\Controllers;

use App\Mail\SuccessMail;
use App\Models\Todo;
use Illuminate\Http\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class todoController extends Controller
{
    /**
//     * @return JsonResponse
     */
    public function index()
    {
        $todos = auth()->user()->todos;
        if(request()->wantsJson())
            return response()->json([
                'success' => true,
                'data' => $todos
            ]);
      return view('home',compact('todos'));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $todo = auth()->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $todo->toArray()
        ], 400);
    }

    /**
     * @param Request $request
//     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
//        dd($request->getContent());
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status'=> 'required',
             'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->status = $request->status;

        $file = $request->file('image');
        $ext = $file->getClientOriginalName();
        $filename = time().'.'.$ext;

        $path = Storage::putFileAs('photos', new File($file), $filename);
//        Storage::putFileAs('image', new File($file), $filename);
        $todo->image = $path;

        if (auth()->user()->todos()->save($todo))

            if(request()->wantsJson())
                return response()->json([
                    'success' => true,
                    'data' => $todo->toArray()
                ]);

            else{
                Mail::to('johndoe@gmail.com')->send(new SuccessMail());
                return redirect()->route('home.index');
            }

        else

            return response()->json([
                'success' => false,
                'message' => 'Todo not added'
            ], 500);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $todo = auth()->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found'
            ], 400);
        }

        $updated = $todo->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Todo can not be updated'
            ], 500);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $todo = auth()->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found'
            ], 400);
        }

        if ($todo->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Todo can not be deleted'
            ], 500);
        }
    }
}
