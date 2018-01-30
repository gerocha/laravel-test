<?php

namespace testeHarpio;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
  protected $fillable = [ 'title', 'description', 'begin_date', 'end_date', 'regulation', 'likes_count', 'purchase_url', 'public_description'];

  protected $dates = ['deleted_at'];
  protected $table = 'offer';

  public function source()
  {
    return $this->belongsTo('testeHarpio\SourceFile');
  }
}
