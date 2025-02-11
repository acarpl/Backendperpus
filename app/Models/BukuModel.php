<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class bukuModel extends Model
{
    //
    use HasApiTokens;

    protected $table = 'buku';
    protected $primarykey = 'id_buku';
    public $timestamps = false;
    protected $fillable = ['judul_buku','pengarang','penerbit'];  
}
