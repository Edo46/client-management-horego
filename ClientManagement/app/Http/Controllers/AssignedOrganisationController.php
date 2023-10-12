<?php

namespace App\Http\Controllers;

use App\Models\AssignedOrganisation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AssignedOrganisationController extends Controller
{
    protected function validateAssigned(Request $request, $id = null) {
        $rules = [
            'user_id' => 'required',
            'organisation_id' => 'required',
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
            $this->validateAssigned($request);

            $conditions = [
                'user_id' => $request->user_id,
                'organisation_id' => $request->organisation_id,
            ];

            $data = AssignedOrganisation::firstOrNew($conditions);
            $data->user_id = $request->user_id;
            $data->organisation_id = $request->organisation_id;

            if ($data->save()) {
                return json_encode(['success' => 'Assigned Permission saved successfully']);
            } else {
                return json_encode(['error' => 'Error while saving Assigned Permission Data']);
            }
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errors = $exception->validator->getMessageBag()->all();
            return json_encode(['error' => $errors]);
        }
    }

    public function ajaxTable(Request $request){
        $data = AssignedOrganisation::where('user_id', $request->user_id)->with('organisation')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return "
                    <a href=\"#\" class=\"btn btn-outline-danger btn-sm legitRipple\" id=\"delete\" style=\"padding-bottom: 1px;\"><i class=\"fe-trash\"></i> Delete</a>
                ";
            })
            ->make(true);
    }

    public function delete($id){
        $data = AssignedOrganisation::where('id', $id)->first();
        if($data->delete()){
            return json_encode(array("success"=>"Assigned Permission deleted Successfully"));
        }else{
            return json_encode(array("error"=>"Failed when deleting Assigned Permission"));
        }
    }
}
