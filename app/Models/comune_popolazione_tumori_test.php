<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\comuni;
use App\Models\distretti;
use App\Models\asl;
use App\Models\classi;

class comune_popolazione_tumori_test extends Model
{
    protected $table = 'comune_popolazione_tumori_test';

    protected $primaryKey = 'ID';

    public function comuni()
    {
        return $this->belongsTo(comuni::class, 'IDComune');
    }

    public function distretti()
    {
        return $this->belongsTo(distretti::class, 'IDDistretto');
    }

    public function asl()
    {
        return $this->belongsTo(asl::class, 'IDAsl');
    }

    public function classi()
    {
        return $this->belongsTo(classi::class, 'IDClasse');
    }
}
