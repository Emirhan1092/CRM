<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Admin\Industry;
use App\Rules\MinString;
use App\Rules\MaxString;

class IndustriesController extends Controller
{
    /**
     * View Function to display list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = __('message.industries');
        $data['menu'] = 'industries';
        return view('admin.industries.list', $data);
    }

    /**
     * Function to get data for jquery datatable
     *
     * @return json
     */
    public function list(Request $request)
    {
        echo json_encode(Industry::list($request->all()));
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $industry_id
     * @return html/string
     */
    public function createOrEdit($industry_id = NULL)
    {
        $data['industry'] = objToArr(Industry::getIndustry('industry_id', $industry_id));
        echo view('admin.industries.create-or-edit', $data)->render();
    }

    /**
     * Function (for ajax) to process create or edit form request
     *
     * @return redirect
     */
    public function save(Request $request)
    {
        

        $edit = $request->input('industry_id') ? $request->input('industry_id') : false;

        $rules['title'] = ['required', new MinString(2), new MaxString(250)];

        $validator = Validator::make($request->all(), $rules, [
            'title.required' => __('validation.required'),
            'title.min' => __('validation.min_string'),
            'title.max' => __('validation.max_string'),
        ]);
        if ($validator->fails()) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('validation_errors' => $validator->messages()->toArray()))
            )));
        }

        Industry::store($request->all(), $edit);
        die(json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array(
                'success' => __('message.industries').' ' . ($edit ? __('message.updated') : __('message.created'))
        )))));
    }

    /**
     * Function (for ajax) to process change status request
     *
     * @param integer $industry_id
     * @param string $status
     * @return void
     */
    public function changeStatus($industry_id = null, $status = null)
    {
        
        Industry::changeStatus($industry_id, $status);
    }

    /**
     * Function (for ajax) to process delete request
     *
     * @param integer $industry_id
     * @return void
     */
    public function delete($industry_id)
    {
        
        Industry::remove($industry_id);
    }
}