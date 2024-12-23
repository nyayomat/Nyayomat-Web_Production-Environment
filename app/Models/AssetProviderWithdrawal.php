<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetProviderWithdrawal extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_acp_asset_provider_withdrawals';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
