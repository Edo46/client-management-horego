<?php

namespace App\Http\Controllers;

use App\Models\PersonInCharge;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PersonInChargeController extends Controller
{
    public function index(){
        return view('dashboard.manage-pic');
    }

    protected function validatePersonInCharge(Request $request, $id = null) {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:person_in_charge,email' . ($id ? ',' . $id : ''),
            'phone' => 'required|unique:person_in_charge,phone' . ($id ? ',' . $id : ''),
            'avatar' => $id ? 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
            'required' => ':attribute Cannot be Empty',
            'unique' => ':attribute Cannot be Same',
            'mimetypes' => 'The :attribute field must be a valid image file (e.g., PNG, JPEG, SVG).',
        ];

        return $request->validate($rules, $messages);
    }

    public function input(Request $request) {
        try {
            $this->validatePersonInCharge($request);

            $data = new PersonInCharge();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->avatar = $request->name . '-' . rand(0, 99) . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatar'), $data->avatar);

            if ($data->save()) {
                return json_encode(['success' => 'Person In Charge saved successfully']);
            } else {
                return json_encode(['error' => 'Error while saving Person In Charge Data']);
            }
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errors = $exception->validator->getMessageBag()->all();
            return json_encode(['error' => $errors]);
        }
    }

    public function edit(Request $request, $id) {
        try {
            $this->validatePersonInCharge($request, $id);

            $data = PersonInCharge::where('id', $id)->first();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;

            if ($request->hasFile('avatar')) {
                $data->avatar = $request->name . '-' . rand(0, 99) . '.' . $request->avatar->getClientOriginalExtension();
                $request->avatar->move(public_path('avatar'), $data->avatar);
            }

            if ($data->update()) {
                return json_encode(['success' => 'Person In Charge updated successfully']);
            } else {
                return json_encode(['error' => 'Error while updating Person In Charge Data']);
            }
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errors = $exception->validator->getMessageBag()->all();
            return json_encode(['error' => $errors]);
        }
    }


    public function ajaxTable(Request $request){
        $data = PersonInCharge::query();
        if ($request->pic){
            $data->whereIn('id', $request->pic);
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return "
                    <a href=\"#\" class=\"btn btn-outline-success btn-sm legitRipple\" id=\"edit\" style=\"padding-bottom: 1px;\"><i class=\"fe-edit\"></i> Edit</a>
                    <a href=\"#\" class=\"btn btn-outline-danger btn-sm legitRipple\" id=\"delete\" style=\"padding-bottom: 1px;\"><i class=\"fe-trash\"></i> Delete</a>
                ";
            })
            ->editColumn('avatar', function ($data){
                $url= asset('avatar/'.$data->avatar);
                return '<img src="'.$url.'" border="0" width="40" height="40" class="rounded-circle" align="center" />';
            })
            ->rawColumns(['avatar', 'action'])->make(true);
    }

    public function delete($id){
        $data = PersonInCharge::where('id', $id)->first();
        if($data->delete()){
            return json_encode(array("success"=>"Person In Charge deleted Successfully"));
        }else{
            return json_encode(array("error"=>"Failed when deleting Person In Charge"));
        }
    }

    public function list(){
        $data = PersonInCharge::all();
        return response()->json($data);
    }
}
