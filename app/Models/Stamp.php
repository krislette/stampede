<?php
/* ======================================================================
SYSTEM NAME: STAMPede
PURPOSE: Controller for stamp creation, display, and management
PROGRAMMER: Acelle Krislette L. Rosales
COPYRIGHT: © 2025 ITD. All rights reserved.
====================================================================== */

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
     *
     * @param int $intPerPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getStampsForWall($intPerPage = 10)
    {
        return self::orderBy('created_at', 'desc')
            ->paginate($intPerPage);
    }

    /**
     * Generate random edit code
     *
     * @return string
     */
    public static function generateEditCode()
    {
        return strtoupper(substr(md5(time()), 0, 6));
    }
}
