<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ship_division;
use App\Models\ship_district;
use App\Models\ship_state;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function AllDivision(){
        $division = ship_division::latest()->get();
       return view('backend.ship.division.division_all',compact('division'));
    } // End Method

    public function AddDivision(){
        return view('backend.ship.division.division_add');
    }// End Method

    public function StoreDivision(Request $request){

        ship_division::insert([
            'division_name' => $request->division_name,
        ]);
        $notification = array(
            'message' => 'ShipDivision Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }// End Method

    public function EditDivision($id){

        $division = ship_division::findOrFail($id);
        return view('backend.ship.division.division_edit',compact('division'));

    }// End Method

    public function UpdateDivision(Request $request){

        $division_id = $request->id;

        ship_division::findorFail($division_id)->update([
            'division_name' => $request->division_name,
        ]);


       $notification = array(
            'message' => 'ShipDivision Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);


    }// End Method

    public function DeleteDivision($id){

        ship_division::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipDivision Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method

    /////////////  Ship District //////////////////////


    public function AllDistrict(){
        $district = ship_district::latest()->get();
       return view('backend.ship.district.district_all',compact('district'));
    } // End Method

    public function AddDistrict(){
        $divisions = ship_division::orderBy('division_name','ASC')->get();
        return view('backend.ship.district.district_add',compact('divisions'));
    }// End Method

    public function StoreDistrict(Request $request){

        ship_district::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);
        $notification = array(
            'message' => 'ShipDivision Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);
    }// End Method

    public function EditDistrict($id){
        $divisions = ship_division::orderBy('division_name','ASC')->get();
        $district = ship_district::findOrFail($id);
        return view('backend.ship.district.district_edit',compact('district','divisions'));

    }// End Method

    public function UpdateDistrict(Request $request){

        $district_id = $request->id;

        ship_district::findorFail($district_id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);


       $notification = array(
            'message' => 'ShipDistrict Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);


    }// End Method

    public function DeleteDistrict($id){

        ship_district::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipDistrict Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method

    //////////  Ship State start ///////////////////////

    public function AllState(){
        $state = ship_state::latest()->get();
       return view('backend.ship.state.state_all',compact('state'));
    } // End Method

    public function AddState(){
        $divisions = ship_division::orderBy('division_name','ASC')->get();
        $district = ship_district::orderBy('district_name','ASC')->get();

        return view('backend.ship.state.state_add',compact('divisions','district'));
    }// End Method

    public function StoreState(Request $request){

        ship_state::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);
        $notification = array(
            'message' => 'ShipState Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    }// End Method

    public function EditState($id){
        $divisions = ship_division::orderBy('division_name','ASC')->get();
        $district = ship_district::orderBy('district_name','ASC')->get();
        $state = ship_state::findOrFail($id);
        return view('backend.ship.state.state_edit',compact('district','divisions','state'));

    }// End Method

    public function UpdateState(Request $request){

        $state_id = $request->id;

        ship_state::findorFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);


       $notification = array(
            'message' => 'ShipState Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);


    }// End Method

    public function DeleteState($id){

        ship_state::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipState Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method



}
