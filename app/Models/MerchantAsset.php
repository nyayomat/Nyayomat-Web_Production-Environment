<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantAsset extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_acp_merchant_assets';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
