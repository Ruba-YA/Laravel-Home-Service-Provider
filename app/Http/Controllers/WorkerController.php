<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
   // show all workers 

   public function index()
   {
    return response([
        'workers' => Worker::orderBy('created_at', 'desc')
            ->with('appointments:id')
            ->get()
    ], 200);
    
   }

   // get single worker

   public function show($id){
    return response([
        'worker' => Worker::where('id' , $id)->get()
    ],200);
   }
   
   // create worker 

   public function store(Request $request)
   {
    $attributes = $request->validate([
        'name' => 'required|string',
        'nationality' => 'required|string',
        'age' => 'required|string',
        'civilStatus' => 'required|string',
        'hasKids' => 'required|',
        'religon' => 'required|string',
        'LanguageSpoken' => 'required|string',
    ]);
    $image = $this->saveImage($request->image , 'countries');


    // create woker 

    $worker = Worker::create($attributes);

    return response([
        'message' => "Worker Created." , 
        'worker' => $worker,
        'image' =>$image
    ],200);
   }


   public function update(Request $request, $id)
   {
    $worker = Worker::find($id);
    if(!$worker)
    {
        return response([
            'message'=>"Worker Not Found . "
        ],403);
    }
    $attributes = $request->validate([
        'name' => 'required|string',
        'nationality' => 'required|string',
        'age' => 'required|string',
        'civilStatus' => 'required|string',
        'hasKids' => 'required|',
        'religon' => 'required|string',
        'LanguageSpoken' => 'required|string',
    ]);

    // update woker 

  $worker->update($attributes);

    return response([
        'message' => "Worker Updated." , 
        'worker' => $worker
    ],200);
   }

   // delete worker

   public function destroy($id){

    $worker = Worker::find($id);
    if(!$worker)
    {
        return response([
            'message'=>"Worker Not Found . "
        ],403);
    }
    $worker->appointments()->delete();
    $worker->delete();
    
    return response([
        'message' => "Worker Deleted." 
    ],200);
    
   }
}
