<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    use HasFactory;

    protected $table = 'tbl_stamps';

    protected $primaryKey = 'stp_id';

    protected $fillable = [
        'stp_to',
        'stp_from',
        'stp_message',
        'stp_color',
        'stp_edit_code',
    ];

    /**
     * Get stamps with pagination for infinite scroll
     */
    public static function getStampsForWall($intPerPage = 10)
    {
        return self::orderBy('created_at', 'desc')
            ->paginate($intPerPage);
    }

    /**
     * Generate random edit code
     */
    public static function generateEditCode()
    {
        return strtoupper(substr(md5(time()), 0, 6));
    }
}
