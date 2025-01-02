<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Industry;
use App\Models\Admin\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use SimpleExcel\SimpleExcel;

use App\Models\Admin\Candidate;
use App\Models\Admin\Employer;
use App\Models\Admin\Department;
use App\Models\Admin\Job;
use App\Models\Admin\JobFilter;
use App\Models\Admin\Traite;
use App\Models\Admin\Quiz;
use App\Rules\MinString;
use App\Rules\MaxString;

class JobsController extends Controller
{
    /**
     * View Function to display jobs list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = __('message.jobs');
        $data['menu'] = 'jobs';
        $data['departments'] = objToArr(Department::getAll());
        $data['job_filters'] = objToArr(JobFilter::getAll());
        $data['employers'] = objToArr(Employer::getAll2());
        return view('admin.jobs.list', $data);
    }

    public function getList()
    {
        die("no need");
        $path = public_path('sectors.json');

        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        $jsonContent = file_get_contents($path);
        $sectors = json_decode($jsonContent, true);
        if ($sectors === null) {
            return response()->json(['error' => 'Invalid JSON format'], 500);
        }
        foreach ($sectors as $sector) {
            $sector['MESLEK'] = mb_strtoupper($sector['MESLEK'], "UTF-8");
            $check = Industry::where("title", $sector['MESLEK'])->first();
            if($check === null) {
                $indutry = new Industry();
                $indutry->title = $sector['MESLEK'];
                $indutry->image = NULL;
                $indutry->save();
            } else {
                $indutry = $check;
            }
            $position = new Position();
            $position->title = $sector['İLGİLİ MESLEK GRUPLARI'];
            $position->industry_id = $indutry->industry_id;
            $position->save();
        }
        return response()->json($sectors);
    }

    public function data(Request $request)
    {
        echo json_encode(Job::jobsList($request->all()));
    }    

    public function createOrEdit($job_id = NULL)
    {
        $data['job'] = objToArr(Job::getJob('jobs.job_id', $job_id));
        $data['departments'] = objToArr(Department::getAll());
        $data['traites'] = objToArr(Traite::getAll());
        $data['fields'] = objToArr(Job::getFields($job_id));
        $data['quizes'] = objToArr(Quiz::getAll(true));
        $data['job_filters'] = objToArr(JobFilter::getAll());
        $data['employers'] = objToArr(Employer::getAll2());
        $data['page'] = __('message.job');
        $data['menu'] = 'jobs';
        return view('admin.jobs.create-or-edit', $data);
    }

    /**
     * Function (for ajax) to process job create or edit form request
     *
     * @return redirect
     */
    public function save(Request $request)
    {
        

        $edit = $request->input('job_id') ? $request->input('job_id') : false;

        $rules['employer_id'] = ['required'];
        $rules['title'] = ['required', new MinString(2), new MaxString(200)];
        $rules['slug'] = ['alpha_dash', new MinString(2), new MaxString(200)];
        $rules['description'] = ['required', new MinString(50), new MaxString(50000)];
        $rules['labels.*'] = ['required', new MaxString(200)];
        $rules['values.*'] = ['required', new MaxString(200)];

        $validator = Validator::make($request->all(), $rules, [
            'employer_id.required' => __('validation.required'),
            'title.required' => __('validation.required'),
            'title.min' => __('validation.min_string'),
            'title.max' => __('validation.max_string'),
            'slug.alpha_dash' => __('validation.alpha_dash'),
            'slug.min' => __('validation.min_string'),
            'slug.max' => __('validation.max_string'),
            'description.required' => __('validation.required'),
            'description.min' => __('validation.min_string'),
            'description.max' => __('validation.max_string'),
            'labels.max' => __('validation.max_string'),
            'values.max' => __('validation.max_string'),
        ]);
        if ($validator->fails()) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('validation_errors' => $validator->messages()->toArray()))
            )));
        }

        $data = $request->all();
        $data['description'] = sanitizeHtmlTemplates(templateInput('description'));
        $job_id = Job::storeJob($data, $edit);
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => __('message.job') . ($edit ? __('message.updated') : __('message.created')))),
            'data' => $job_id
        ));
    }

    /**
     * Function (for ajax) to process job change status request
     *
     * @param integer $job_id
     * @param string $status
     * @return void
     */
    public function changeStatus($job_id = null, $status = null)
    {
        
        Job::changeStatus($job_id, $status);
    }

    /**
     * Function (for ajax) to process job delete request
     *
     * @param integer $job_id
     * @return void
     */
    public function delete($job_id)
    {
        
        Job::remove($job_id);
    }

    /**
     * Post Function to download jobs data in excel
     *
     * @return void
     */
    public function excel(Request $request)
    {
        $data = Job::getJobsForCSV($request->input('ids'));
        $data = sortForCSV(objToArr($data));
        $excel = new SimpleExcel('csv');                    
        $excel->writer->setData($data);
        $excel->writer->saveFile('jobs'); 
        exit;
    }

    /**
     * Function (for ajax) to process news bulk action request
     *
     * @return void
     */
    public function bulkAction(Request $request)
    {
        
        Job::bulkAction($request->input('data'));
    }
}
