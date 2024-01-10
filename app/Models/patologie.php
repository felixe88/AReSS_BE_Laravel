<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\tumori_colon_retto_casi;
use App\Models\comuni;
use App\Models\distretti;
use App\Models\asl;
use App\Models\classi;
use App\Models\comune_popolazione_tumori_test;
use App\Models\regioni;



class patologie extends Model
{
    protected $table = 'patologie';

    protected $primaryKey = 'IDPatologia';

    public function tumori_colon_retto_casi()
    {
        return $this->belongsTo(tumori_colon_retto_casi::class, 'IDPatologia');
    }

    public function comune_popolazione_tumori_test()
    {
        return $this->belongsTo(comune_popolazione_tumori_test::class, 'ID');
    }

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

    public function regioni()
    {
        return $this->belongsTo(regioni::class, 'IDRegione');
    }
}
