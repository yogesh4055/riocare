<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartyMaster;

class PartyController extends Controller
{
     //
     public function __construct()
     {
         {
             $this->middleware('auth');
             $this->middleware('permission:party-master-list|party-master-add|party-master-edit|party-master-delete', ['only' => ['party_master','party_master_insert']]);
             $this->middleware('permission:party-master-add', ['only' => ['new_party_master','party_master_insert']]);
             $this->middleware('permission:party-master-edit', ['only' => ['edit_party_master','update_party_master']]);
             $this->middleware('permission:party-master-delete', ['only' => ['delete_party_master']]);
     
         }
 
 
     }
    public function party_master()
    {
        $data['party_master']=PartyMaster::all();
        return view('master.client.party_master',$data);
    }
    public function new_party_master()
    {

        return view('master.client.new_party_master');
    }
    public function party_master_insert(Request $request)
    {
        $data = [
            "company_name"=> $request['company_name'],
            "mobileno"=> $request['mobileno'],
            "address"=> $request['address'],
            "cp_name"=> $request['cp_name'],

        ];

        $result = PartyMaster::create($data);

        if ($result) {
            return redirect("party_master")->with('success', "Data created successfully");
        }
    }

    public function edit_party_master($id)

    {
      $edit_party_master=PartyMaster::where("id", $id)->first();
        return view("master.client.edit_party_master")->with(["edit_party_master" =>$edit_party_master]);
    }
    public function delete_party_master($id)
    {
        $party_master = PartyMaster::where("id", $id)->delete();
        if ($party_master) {

            return redirect("party_master")->with('danger', "Data deleted successfully");
        }
    }
    public function update_party_master(Request $request,$id)
    {
        $data = [
            "company_name"=> $request['company_name'],
            "mobileno"=> $request['mobileno'],
            "address"=> $request['address'],
            "cp_name"=> $request['cp_name'],
       ];
        $party = PartyMaster::find($id);
        $result = $party->update($data);
        if ($result) {
            return redirect("party_master")->with('update', "Data Update successfully");
        }
    }


}
