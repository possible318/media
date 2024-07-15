<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
CREATE TABLE `media_xn` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `pid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '地址',
  `status` int NOT NULL DEFAULT '0',
  `add_tm` int NOT NULL,
  `upd_tm` int NOT NULL,
  `del_tm` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_idx_pf_pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 */

class MediaXn extends Model
{
    public $table = 'media_xn';

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
