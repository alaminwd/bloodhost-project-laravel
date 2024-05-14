<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorHistory extends Model
{
    use HasFactory;

    function rel_to_donor(){
        return $this->belongsTo(Donor::class, 'donor_id');
    }
}
