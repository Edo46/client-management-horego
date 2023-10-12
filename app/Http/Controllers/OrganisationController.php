<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrganisationController extends Controller
{
    public function index(){
        if (\Auth::user()->restriction->organisation === 0){
            return view('layouts.404');
        }
        return view('dashboard.manage-organisation');
    }

    protected function validateOrganisation(Request $request, $id = null) {
        $rules = [
            'name' => 'required',
            'phone' => 'required|unique:organisation,phone' . ($id ? ',' . $id : ''),
            'email' => 'required|unique:organisation,email' . ($id ? ',' . $id : ''),
            'website' => 'required',
            'logo' => $id ? 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pic' => 'required',
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
            $this->validateOrganisation($request);

            $data = new Organisation();
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->website = $request->website;
            $data->pic = json_encode($request->pic);

            $data->logo = $request->name . '-' . rand(0, 99) . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('logo'), $data->logo);

            if ($data->save()) {
                return json_encode(['success' => 'Organisation saved successfully']);
            } else {
                return json_encode(['error' => 'Error while saving Organisation Data']);
            }
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errors = $exception->validator->getMessageBag()->all();
            return json_encode(['error' => $errors]);
        }
    }

    public function edit(Request $request, $id) {
        try {
            $this->validateOrganisation($request, $id);

            $data = Organisation::where('id', $id)->first();
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->website = $request->website;
            $data->pic = json_encode($request->pic);

            if ($request->hasFile('logo')) {
                $data->logo = $request->name . '-' . rand(0, 99) . '.' . $request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('logo'), $data->logo);
            }

            if ($data->update()) {
                return json_encode(['success' => 'Organisation updated successfully']);
            } else {
                return json_encode(['error' => 'Error while updating Organisation Data']);
            }
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errors = $exception->validator->getMessageBag()->all();
            return json_encode(['error' => $errors]);
        }
    }


    public function ajaxTable(){
        $data = Organisation::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return "
                    <a href=\"#\" class=\"btn btn-outline-info btn-sm legitRipple\" id=\"details\" style=\"padding-bottom: 1px;\"><i class=\"fe-eye\"></i> Details</a>
                    <a href=\"#\" class=\"btn btn-outline-success btn-sm legitRipple\" id=\"edit\" style=\"padding-bottom: 1px;\"><i class=\"fe-edit\"></i> Edit</a>
                    <a href=\"#\" class=\"btn btn-outline-danger btn-sm legitRipple\" id=\"delete\" style=\"padding-bottom: 1px;\"><i class=\"fe-trash\"></i> Delete</a>
                ";
            })
            ->addColumn('logo_organisation', function ($data){
                $url= asset('logo/'.$data->logo);
                return '<img src="'.$url.'" border="0" width="40" height="40" class="rounded-circle" align="center" />';
            })
            ->rawColumns(['logo_organisation', 'action'])->make(true);
    }

    public function delete($id){
        $data = Organisation::where('id', $id)->first();
        if($data->delete()){
            return json_encode(array("success"=>"Organisation deleted Successfully"));
        }else{
            return json_encode(array("error"=>"Failed when deleting Organisation"));
        }
    }
}
