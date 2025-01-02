<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;

    protected $table = 'user_documents';
    protected static $tbl = 'user_documents';
    protected $primaryKey = 'id';

    const DOCUMENT_TYPES = [
        0  => 'Pasaport',
        1  => 'Fotoğraf',
        2  => 'Kimlik Sureti',
        3  => 'Nüfus Kayıt Örneği',
        4  => 'Aile Kayıt Örneği',
        5  => 'İkametgâh Belgesi',
        6  => 'Sağlık Sigortasına İlişkin Evraklar',
        7  => 'Diploma',
        8  => 'İş Sözleşmesi',
        9  => 'İş Teklifi Alınan Verin Davet Mektubu',
        10 => 'Almanya Çalışma İzni Başvuru Formu',
        11 => 'Telc, Gothe ve OSD Sınav Sonucu',
        12 => 'Staj Belgesi',
        13 => 'Transkript',
        14 => 'Barkodlu SSK Dökümü'
    ];
}
