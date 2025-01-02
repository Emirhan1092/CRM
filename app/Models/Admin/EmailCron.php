<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailCron extends Model
{
    protected $table = 'emails';
    protected static $tbl = 'emails';
    protected $primaryKey = 'email_id';

    const UPDATED_AT = null;

    protected $fillable = array(
        "to",
        "subject",
        "message",
        "status",
        "created_at",
        "sent_at",
    );    
}