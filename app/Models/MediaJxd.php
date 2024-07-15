<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaJxd extends Model
{
    public $table = 'media';

    protected $primaryKey = 'id';

    public static function getMediaList($page, $limit = 10): array
    {
        $count = self::count();
        if ($count == 0) {
            return [0, []];
        }
        $res = self::limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();

        return [$count, $res];
    }
}
