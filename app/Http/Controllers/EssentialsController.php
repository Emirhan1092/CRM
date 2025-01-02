<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Response;

use App\Rules\MaxFile;

use App\Models\Admin\Membership;
use App\Models\Admin\Language;
use App\Models\Admin\EmailCron;
use App\Models\Employer\Job;
use App\Models\Employer\Employer As Team;
use App\Models\Employer\JobFilter;
use App\Models\Employer\Quiz;
use App\Models\Employer\Interview;
use App\Models\Employer\Traite;

class EssentialsController extends Controller
{

    public function setFrontLanguage(Request $request, $id = null)
    {
        $lang = Language::getLanguage('languages.language_id', decode($id));
        setSession('front_selected_language_flag', $lang->flag);
        setSession('front_selected_language_title', $lang->title);
        setSession('front_selected_language_slug', $lang->slug);
        setSession('front_selected_language_direction', $lang->direction);
    }

    public function setCandidateLanguage(Request $request, $slug = null, $id = null)
    {
        $lang = Language::getLanguage('languages.language_id', decode($id));
        setSession('front_selected_language_flag', $lang->flag);
        setSession('front_selected_language_title', $lang->title);
        setSession('front_selected_language_slug', $lang->slug);
        setSession('front_selected_language_direction', $lang->direction);
    }

    public function setEmployerLanguage(Request $request, $id = null)
    {
        $lang = Language::getLanguage('languages.language_id', decode($id));
        setSession('employer_selected_language_flag', $lang->flag);
        setSession('employer_selected_language_title', $lang->title);
        setSession('employer_selected_language_slug', $lang->slug);
        setSession('employer_selected_language_direction', $lang->direction);
    }

    public function refreshMemberships()
    {
        if (!allowedTo('refresh_memberships')) {
            die(__('message.not_allowed'));
        }
        
        $changes = '';
        $memberships = Membership::getAll();

        foreach ($memberships as $membership) {
            $employer_id = $membership['employer_id'];
            $details = objToArr(json_decode($membership['details']));
            $condition = array('employer_id' => $employer_id, 'status' => 1);
            $update = array('status' => 0);
            $changes .= '---------------<br />Employer Id : '.$employer_id.'<br />';
            $total = 0;

            //Refreshing active jobs
            $jobs_count = Job::where($condition)->count();
            if ($jobs_count > issetVal($details, 'active_jobs')) {
                $diff = (int)$jobs_count - (int)issetVal($details, 'active_jobs');
                $changes .= $diff.' Job(s) Deactivated<br />';
                $total = $total + $diff;
                Job::where($condition)->orderBy('created_at', 'ASC')->take($diff)->update($update);
            }

            //Refreshing Team
            $team_condition = array('type' => 'team', 'parent_id' => $employer_id, 'status' => 1);
            $team_count = Team::where($team_condition)->count();
            if ($team_count > issetVal($details, 'active_users')) {
                $diff = (int)$team_count - (int)issetVal($details, 'active_users');
                $changes .= $diff.' Team(s) Deactivated<br />';
                $total = $total + $diff;
                Team::where($team_condition)->orderBy('created_at', 'ASC')->take($diff)->update($update);
            }

            //Refreshing filters
            $filters_count = JobFilter::where($condition)->count();
            if ($filters_count > issetVal($details, 'active_custom_filters')) {
                $diff = (int)$filters_count - (int)issetVal($details, 'active_custom_filters');
                $changes .= $diff.' Custom Filter(s) Deactivated<br />';
                $total = $total + $diff;
                JobFilter::where($condition)->orderBy('created_at', 'ASC')->take($diff)->update($update);
            }

            //Refreshing quizes
            $quizes_count = Quiz::where($condition)->count();
            if ($quizes_count > issetVal($details, 'active_quizes')) {
                $diff = (int)$filters_count - (int)issetVal($details, 'active_quizes');
                $changes .= $diff.' Quize(s) Deactivated<br />';
                $total = $total + $diff;
                Quiz::where($condition)->orderBy('created_at', 'ASC')->take($diff)->update($update);
            }

            //Refreshing interviews
            $interviews_count = Interview::where($condition)->count();
            if ($interviews_count > issetVal($details, 'active_interviews')) {
                $diff = (int)$interviews_count - (int)issetVal($details, 'active_interviews');
                $changes .= $diff.' Interview(s) Deactivated<br />';
                $total = $total + $diff;
                Interview::where($condition)->orderBy('created_at', 'ASC')->take($diff)->update($update);
            }

            $traites_count = Traite::where($condition)->count();
            if ($traites_count > issetVal($details, 'active_traites')) {
                $diff = (int)$traites_count - (int)issetVal($details, 'active_traites');
                $changes .= $diff.' Traite(s) Deactivated<br />';
                $total = $total + $diff;
                Traite::where($condition)->orderBy('created_at', 'ASC')->take($diff)->update($update);
            }

            if ($total == 0) {
                $changes .= 'Nothing deactivated<br />';
            }
        }

        die($changes);
    }

    public function uploadCkEditorImage(Request $request)
    {
        if (isset($_FILES['upload']['name'])) {
            $fileUpload = $this->uploadPublicFile(
                $request, 'upload', config('constants.upload_dirs.ckeditor'), 
                array('upload' => ['image', 'mimes:jpeg,png,jpg,gif,svg', new MaxFile(generalFileUploadLimit())]),
                array('upload.image' => __('validation.image'))
            );
            $funcNum = $request->input('CKEditorFuncNum');
            $url = route('uploads-view', $fileUpload['message']);
            die(json_encode(array(
                'uploaded' => 'true',
                'url' => $url,
            )));
        }
    }

    public function uploadsView(Request $request, $seg1 = '', $seg2 = '', $seg3 = '', $seg4 = '')
    {
        $storagePath  = Storage::disk(config('constants.upload_dirs.main'))->getDriver()->getAdapter()->getPathPrefix();
        $seg2 = $seg2 ? '/'.$seg2 : '';
        $seg3 = $seg3 ? '/'.$seg3 : '';
        $seg4 = $seg4 ? '/'.$seg4 : '';
        $path = $storagePath . $seg1.$seg2.$seg3.$seg4;
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }    

    public function emailsCron()
    {
        $email_ids = array();
        $emails = EmailCron::where('status', 0)->get();
        $emails = $emails ? $emails->toArray() : array();
        if ($emails) {
            foreach ($emails as $email) {
                $email_ids[] = $email['email_id'];
                $message = $email['message'];
                $this->sendEmail($email['subject'], $email['to'], $email['subject'], $email['employer_id'], 'no');
            }
        }

        //Updating cron notification count
        if ($email_ids) {
            EmailCron::whereIn('email_id', $email_ids)->update(array('status' => 1, 'sent_at' => date('Y-m-d G:i:s')));
        }
    }
}
    