<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Csvdata extends Model
{
    protected $table = 'csv_data';
//    public $timestamps = false;
    protected $fillable = ['csv_filename', 'csv_header', 'csv_data'];
}
