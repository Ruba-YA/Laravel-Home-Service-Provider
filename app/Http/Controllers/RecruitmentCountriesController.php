<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentCountries;
use Illuminate\Http\Request;

class RecruitmentCountriesController extends Controller
{
    // show all countries

    public function index()
    {
     return response([
         'countries' => RecruitmentCountries::orderBy('created_at', 'desc')
            
             ->get()
     ], 200);
    }

     // get single country

   public function show($id){
    return response([
        'country' => RecruitmentCountries::where('id' , $id)->get()
    ],200);
   }
    // create new country 


    public function store(Request $request)
    {
     $attributes = $request->validate([
         'name' => 'required|string',
     ]);
     $image = $this->saveImage($request->image , 'countries');

     // create woker 
 
     $country = RecruitmentCountries::create($attributes);
 
     return response([
         'message' => "Recruitment Countries Created." , 
         'country' => $country,
         'image' =>$image
     ],200);
    }
 
    // update RecruitmentCountries
    
    public function update(Request $request, $id)
   {
    $country = RecruitmentCountries::find($id);
    if(!$country)
    {
        return response([
            'message'=>"RecruitmentCountries Not Found . "
        ],403);
    }
    $attributes = $request->validate([
        'name' => 'required|string',
       
      
    ]);

    

    // update woker 

  $country->update($attributes);

    return response([
        'message' => "Recruitment Countries Updated." , 
        'country' => $country
    ],200);
   }


   public function destroy($id){

    $country = RecruitmentCountries::find($id);
    if(!$country)
    {
        return response([
            'message'=>"Recruitment Countries Not Found . "
        ],403);
    }
    
    $country->delete();
    
    return response([
        'message' => "Recruitment Countries Deleted." 
    ],200);
    
   }


}
