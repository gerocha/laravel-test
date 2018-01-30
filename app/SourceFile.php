<?php

namespace testeHarpio;

use Illuminate\Database\Eloquent\Model;

class SourceFile extends Model
{
  protected $fillable = ['name'];
  protected $dates = ['deleted_at'];
  protected $table = 'source_file';

  public function offer()
  {
    return $this->hasMany('testeHarpio\Offer');
  }
}
