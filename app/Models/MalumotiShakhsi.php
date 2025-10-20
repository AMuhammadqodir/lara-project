<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MalumotiShakhsi extends Model
{
    protected $table = 'malumoti_shakhsi';
    protected $primaryKey = 'uid';
    public $timestamps = false;

    protected $fillable = [
        'login', 'parol', 'nom', 'nasab', 'nomi_padar', 
        'nomu_nasab', 'nomu_nasab_lotini', 'shahr_nohiya', 
        'suroga1', 'suroga2', 'jins', 'raqami_telefon1', 
        'raqami_telefon2', 'maqom_id', 'aktiv', 'tashrifi_okhiron'
    ];

    public static function ilova_istifodabar($data)
    {
        $uid = DB::table('malumoti_shakhsi')->max('uid') + 1;
        $prefix = ($data['maqom_id'] == 4) ? 'd00' : 'm0';
        $login = $prefix . $uid;
        $nomu_nasab = $data['nasab'] . ' ' . $data['nom'] . ' ' . $data['nomi_padar'];
        $nomu_nasab_lotini = self::toLatin($nomu_nasab);

        $hashedPassword = Hash::make($data['parol']);
    
        return self::create([
            'login' => $login,
            'parol' => $hashedPassword,
            'nom' => $data['nom'],
            'nasab' => $data['nasab'],
            'nomi_padar' => $data['nomi_padar'],
            'nomu_nasab' => $nomu_nasab,
            'nomu_nasab_lotini' => $nomu_nasab_lotini,
            'shahr_nohiya' => $data['shahr_nohiya'],
            'jins' => $data['jins'],
            'maqom_id' => $data['maqom_id'],
            'aktiv' => 1,
            'tashrifi_okhiron' => now(),
        ]);
    }

    private static function toLatin($text)
    {
        $cyr = [
            'А','Б','В','Г','Ғ','Д','Е','Ё','Ж','З','И','Ӣ','Й','К','Қ','Л','М','Н','О','П',
            'Р','С','Т','У','Ў','Ф','Х','Ҳ','Ц','Ч','Ҷ','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я',
            'а','б','в','г','ғ','д','е','ё','ж','з','и','ӣ','й','к','қ','л','м','н','о','п',
            'р','с','т','у','ў','ф','х','ҳ','ц','ч', 'ҷ','ш','щ','ъ','ы','ь','э','ю','я'
        ];

        $lat = [
            'A','B','V','G','Gh','D','E','Yo','J','Z','I','Iy','Y','K','Q','L','M','N','O','P',
            'R','S','T','U','O`','F','Kh','H','Ts','Ch','J','Sh','Shch','`','I','','E','Yu','Ya',
            'a','b','v','g','g`','d','e','yo','j','z','i','iy','y','k','q','l','m','n','o','p',
            'r','s','t','u','o`','f','x','h','ts','ch', 'j','sh','shch','`','i','','e','yu','ya'
        ];

        return str_replace($cyr, $lat, $text);
    }

    public static function justani_istifodabar($login, $parol)
    {
        $user = self::where('login', $login)->first();

        if ($user && Hash::check($parol, $user->parol)) {
            return $user;
        }

        return null;
    }

    public static function taf_istifodabar($uid)
    {
        return DB::table('malumoti_shakhsi as m')
            ->join('shahr_nohiya as s', 'm.shahr_nohiya', '=', 's.sn_id')
            ->join('maqom as q', 'm.maqom_id', '=', 'q.maqom_id')
            ->join('malumotho as mm', 'q.namudi_maqom', '=', 'mm.id')
            ->select(
                'm.*',
                's.shahr_nohiya as nomi_shahr',
                'mm.tojiki as nomi_maqom'
            )
            ->where('m.uid', $uid)
            ->first();
    }

    public static function hama()
    {
        return DB::table('malumoti_shakhsi as m')
            ->join('shahr_nohiya as s', 'm.shahr_nohiya', '=', 's.sn_id')
            ->join('maqom as q', 'm.maqom_id', '=', 'q.maqom_id')
            ->join('malumotho as mm', 'q.namudi_maqom', '=', 'mm.id')
            ->select(
                'm.*',
                's.shahr_nohiya as nomi_shahr',
                'mm.tojiki as nomi_maqom'
            )
            ->orderBy('m.uid', 'desc')
            ->get();
    }
}
