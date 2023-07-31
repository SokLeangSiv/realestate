<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\amerties;
use Illuminate\Http\Request;
use App\Models\PropertyType;


class PropertyController extends Controller
{
   
    public function Alltype(){

        $types = PropertyType::latest()->get();
        return view("backend.property.alltype",compact('types'));
    }

    public function Addtype(){

        return view("backend.property.addtype");
    }

    public function Storetype(Request $request){

       

        $property = new PropertyType();

        $property->type_name = $request->type_name;
        $property->type_icon = $request->type_icon;

        $property->save();

        $notification = array(
            'message' => 'Property Type Inserted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('all.type')->with($notification);
    }


    public function Edittype($id){
            
            $type = PropertyType::find($id);
    
            return view("backend.property.edittype",compact('type'));
    }

    public function UpdateType(Request $request,$id){

        $request->validate([
            'type_name' => 'required|unique:property_types,type_name,',
            'type_icon' => 'required|unique:property_types,type_icon,',
        ]);

        $property = PropertyType::find($id);

        $property->type_name = $request->type_name;
        $property->type_icon = $request->type_icon;

        $property->save();

        $notification = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);

    }


    public function Deletetype($id){

        PropertyType::find($id)->delete();

        return redirect()->route('all.type')->with('success','Property Type Deleted Successfully');
    }


    ////amaties???


    public function allameties(){

        $amerties = amerties::latest()->get();
        return view("backend.amerties.allamerties",compact('amerties'));
    }

    public function addamenties(){

        return view("backend.amerties.addamarties");
       
    }


    public function storeamenties(Request $request){

        $request->validate([
            'amarties_name' => 'required|unique:amerties,amarties_name,',
        ]);

        $amerties = new amerties();

        $amerties->amarties_name = $request->amarties_name;

        $amerties->save();

        $notification = array(
            'message' => 'Property Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('amerties.all')->with($notification);
    }

    public function Editammentie($id){

        $amerties = amerties::find($id);

        return view("backend.amerties.editamerties",compact('amerties'));

    }

    public function Updateamentie(Request $request,$id){

        $request->validate([
            'amarties_name' => 'required|unique:amerties,amarties_name,',
        ]);

        $amerties = amerties::find($id);

        $amerties->amarties_name = $request->amarties_name;

        $amerties->save();

        $notification = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('amerties.all')->with($notification);

    }

    public  function Deleteamentie($id){

        amerties::find($id)->delete();

        return redirect()->route('amerties.all')->with('success','Property Type Deleted Successfully');
    }

}
