<?php

namespace App\Http\Controllers;

use App\Models\RestrictionAccess;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManageUserController extends Controller
{
    public function index(){
        return view('dashboard.manage-user');
    }

    protected function validateUser(Request $request, $id = null) {
        $rules = [
            'name' => 'required',
            'person' => 'required',
            'organisation' => 'required',
            'email' => 'required|unique:users,email' . ($id ? ',' . $id : ''),
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
            $this->validateUser($request);

            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt('password123');
            $data->roles = 'account_manager';
            $data->save();

            $restriction = new RestrictionAccess();
            $restriction->user_id = $data->id;
            $restriction->person = $request->person;
            $restriction->organisation = $request->organisation;

            if ($restriction->save()) {
                return json_encode(['success' => 'User saved successfully']);
            } else {
                return json_encode(['error' => 'Error while saving User Data']);
            }
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errors = $exception->validator->getMessageBag()->all();
            return json_encode(['error' => $errors]);
        }
    }

    public function edit(Request $request, $id) {
        try {
            $this->validateUser($request, $id);

            $data = User::where('id', $id)->first();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt('password123');
            $data->roles = 'account_manager';

            $restriction = RestrictionAccess::where('user_id', $id)->first();
            $restriction->person = $request->person;
            $restriction->organisation = $request->organisation;

            if ($data->update() && $restriction->update()) {
                return json_encode(['success' => 'User updated successfully']);
            } else {
                return json_encode(['error' => 'Error while updating User Data']);
            }
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errors = $exception->validator->getMessageBag()->all();
            return json_encode(['error' => $errors]);
        }
    }


    public function ajaxTable(){
        $data = User::where('roles', '!=', 'super_admin')->with('restriction');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return "
                    <a href=\"#\" class=\"btn btn-outline-success btn-sm legitRipple\" id=\"edit\" style=\"padding-bottom: 1px;\"><i class=\"fe-edit\"></i> Edit</a>
                    <a href=\"#\" class=\"btn btn-outline-danger btn-sm legitRipple\" id=\"delete\" style=\"padding-bottom: 1px;\"><i class=\"fe-trash\"></i> Delete</a>
                ";
            })
            ->make(true);
    }

    public function delete($id){
        $data = User::where('id', $id)->first();
        if($data->delete()){
            return json_encode(array("success"=>"User deleted Successfully"));
        }else{
            return json_encode(array("error"=>"Failed when deleting User"));
        }
    }
}
