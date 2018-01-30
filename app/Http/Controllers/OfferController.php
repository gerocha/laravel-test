<?php

namespace testeHarpio\Http\Controllers;

use testeHarpio\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
  public function index()
  {
    $offer = Offer::with('source')->get();
    return response()->json($offer);
  }
}
