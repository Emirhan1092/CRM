<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Industry extends Model
{
    protected $table = 'industries';
    protected static $tbl = 'industries';
    protected $primaryKey = 'industry_id';

    protected $fillable = [
        'industry_id',
        'title',
        'status',
        'created_at',
        'updated_at',
    ];

    public static function getIndustry($column, $value)
    {
    	$industries = Self::where($column, $value)->first();
    	return $industries ? $industries : emptyTableColumns(Self::$tbl);
    }

    public static function store($data, $edit = null)
    {
        unset($data['_token']);
        if ($edit) {
            $data['updated_at'] = date('Y-m-d G:i:s');
            Self::where('industry_id', $edit)->update($data);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $data['status'] = 1;
            Self::insert($data);
        }
    }

    public static function changeStatus($industry_id, $status)
    {
        Self::where('industry_id', $industry_id)->update(array('status' => ($status == 1 ? 0 : 1)));
    }

    public static function remove($industry_id)
    {
        Self::where(array('industry_id' => $industry_id))->delete();
    }

    public static function bulkAction($data)
    {
        $data = objToArr(json_decode($data));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                Self::whereIn('industry_id', $ids)->update(array('status' => '1'));
            break;
            case "deactivate":
                Self::whereIn('industry_id', $ids)->update(array('status' => '0'));
            break;
        }
    }

    public static function getAll($active = true, $limit = '')
    {
        $query = Self::whereNotNull('industries.industry_id');
        if ($active) {
            $query->where('status', 1);
        }
        if ($limit) {
            $query->skip(0);
            $query->take($limit);
        }
        $query->from(Self::$tbl);
        $query->orderBy('industry_id', 'DESC');
        $result = $query->get();
        return $result ? $result->toArray() : array();
    }

    public static function list($request)
    {
        $columns = array(
            'industries.title',
            'industries.created_at',
            'industries.status',
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 1 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $query = Self::whereNotNull('industries.industry_id');
        $query->select(
            'industries.*',
        );
        if ($srh) {
            $query->where(function($q) use ($srh) {
                $q->where('title', 'like', '%'.$srh.'%');
            });
        }
        if (isset($request['status']) && $request['status'] != '') {
            $query->where('industries.status', $request['status']);
        }
        $query->groupBy('industries.industry_id');
        $query->orderBy($orderColumn, $orderDirection);
        $query->skip($offset);
        $query->take($limit);
        $result = $query->get();
        $result = $result ? $result->toArray() : array();
        $result = array(
            'data' => Self::prepareDataForTable($result),
            'recordsTotal' => Self::getTotal(),
            'recordsFiltered' => Self::getTotal($srh, $request),
        );

        return $result;
    }

    public static function getTotal($srh = false, $request = '')
    {
        $query = Self::whereNotNull('industries.industry_id');
        if ($srh) {
            $query->where(function($q) use ($srh) {
                $q->where('industries.title', 'like', '%'.$srh.'%');
            });
        }
        if (isset($request['status']) && $request['status'] != '') {
            $query->where('industries.status', $request['status']);
        }
        $query->groupBy('industries.industry_id');
        return $query->get()->count();
    }

    private static function prepareDataForTable($industries)
    {
        $sorted = array();
        foreach ($industries as $u) {
            $actions = '';
            $u = objToArr($u);
            $id = $u['industry_id'];
            if ($u['status'] == 1) {
                $button_text = __('message.active');
                $button_class = 'success';
                $button_title = __('message.click_to_deactivate');
            } else {
                $button_text = __('message.inactive');
                $button_class = 'danger';
                $button_title = __('message.click_to_activate');
            }
            if (allowedTo('edit_industries')) { 
            $actions .= '
                <button type="button" class="btn btn-primary btn-xs create-or-edit-industry" data-id="'.$id.'"><i class="far fa-edit"></i></button>
            ';
            }
            if (allowedTo('delete_industries')) { 
            $actions .= '
                <button type="button" class="btn btn-danger btn-xs delete-industry" data-id="'.$id.'"><i class="far fa-trash-alt"></i></button>
            ';
            }
            $sorted[] = array(
                esc_output($u['title']),
                date('d M, Y', strtotime($u['created_at'])),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-industry-status" data-status="'.$u['status'].'" data-id="'.$id.'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
    }  
}