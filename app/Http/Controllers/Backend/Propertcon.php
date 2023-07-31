<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\amerties;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use  Carbon\Carbon;
use App\Models\facility;
use App\Models\facilities;


class Propertcon extends Controller
{
    
    public function Allproperty(){
        $property = Property::latest()->get();

        return view('backend.proty.all_property', compact('property'));
    }

    public function Addproperty(){

        $propertyType = PropertyType::latest()->get();
        $amentities = amerties::latest()->get();
        $userAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.proty.add_proty',compact('propertyType','amentities','userAgent'));

    }

    public  function Storeproperty(Request $request){
     
        // this for amenities

        $amen= $request->amenities_id;
        $amenties = implode(",", $amen);

        

        // this for amenities

        
        // this for property code

        $pcode = IdGenerator::generate(['table'=>'properties','field'=>'property_code','prefix'=>'PC','length'=>6 ]);

        // this for property code

        // this if for thumnail image
        $image = $request->property_thumbnail;
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thumnail/'.$name_gen);
        $save_url = 'upload/property/thumnail/'.$name_gen;
         // this if for thumnail image

        $property_id = Propertcon::insertGetId([

        

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $request->$amenties,
            'property_name' => $request->property_name,
            'property_slug' => $request->str_replace(' ', '-', $request->property_name),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_description' => $request->shortdes,
            'long_description' => $request->longdes,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thumbnail	' => $save_url,
            'created_at' => Carbon::now(),


        ]);

        //multi image

        $images = $request->file('multiimg');

        foreach($images as $img){
        $imgname = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(770,520)->save('upload/property/multi_img/'.$imgname);
        $imgpath = 'upload/property/thumnail/'.$imgname;

        MultiImage::insert([
            'property_id' => $property_id,
            'multi_img' => $imgpath,
            'created_at' => Carbon::now(),
        ]);

        }

        //multi image




        // facilities

        $facilities = Count($request->facilities_id);

        if($facilities != NULL){
            for($i=0; $i < $facilities; $i++){
                
                $fcount = new facility();
                $fcount->property_id = $property_id;
                $fcount->facilities_id = $request->facilities_id[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }

            // $notification = array(
            //     'message' => 'Property Inserted Successfully',
            //     'alert-type' => 'success'
            // );
        }
         // facilities


            return redirect()->route('property.all');

       
    } 
    //end method
}
