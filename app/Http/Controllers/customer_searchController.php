<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HomeRequest;
use Validator;
use DB;

class customer_searchController extends Controller
{




//searchall
   public function search(Request $req){
       
         $pro = DB::table('property')
                       ->join('property_picture', 'property.property_id', '=', 'property_picture.property_id')

                       ->where('status', 'allowed')
                       ->orderby('no_of_clicks', 'desc')
                        ->get();
if ($req->titles!="") {
  

 $propertys = DB::table('property')
                       ->join('property_picture', 'property.property_id', '=', 'property_picture.property_id')

                       ->where('status', 'allowed')
                       
                       ->where('title','like','%'.$req->titles.'%')
                      
                        ->paginate(3);

      return view('website.index')
                ->with('propertys',$propertys)
                ->with('pro',$pro);
}
else
{

   $propertys = DB::table('property')
                       ->join('property_picture', 'property.property_id', '=', 'property_picture.property_id')

                       ->where('status', 'allowed')
                       
                       ->where('title','like','%'.$req->titles.'%')
                     ->where('property_area','like','%'.$req->areas.'%')
                     ->where('p_type','like','%'.$req->p_type.'%')
                     ->where('bed','like','%'.$req->bed.'%')
                     ->where('bath','like','%'.$req->bath.'%')
                     ->where('feet','like','%'.$req->feets.'%')
                      ->where('property_price','like','%'.$req->prices.'%')
                      
                        ->paginate(3);


      return view('website.index')
                ->with('propertys',$propertys)
                ->with('pro',$pro);


}
        
  }



}
