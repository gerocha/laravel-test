<?php

namespace testeHarpio\Http\Controllers;

use Illuminate\Support\Facades\Log;
use testeHarpio\SourceFile;
use testeHarpio\Offer;
use Illuminate\Http\Request;
use Illuminate\Filesystem\File;

class SourceFileController extends Controller
{
  public function index()
  {
    $files = SourceFile::all();
    return response()->json($files);
  }

  public function store(Request $request)
  {
    $sourceFile = new SourceFile();
    $sourceFile->fill($request->all());
    $file = $request->file->store('storage');
    Log::debug($file);
    $filename = base_path('/storage/app/' . $file);
    $fileToRead = fopen($filename, "r");
    $all_data = array();
    $sourceFile->save();
    $count = 0;
    while ( ($data = fgetcsv($fileToRead, 1000, ",")) !==FALSE) {
      if($count > 0) {
        $offer = new Offer();
        $newOffer = array(
          'source_file_id' => $sourceFile->id,
          'title' => $data[1],
          'description' => $data[2],
          'begin_date' => $data[3],
          'end_date' => $data[4],
          'regulation' => $data[5],
          'likes_count' => $data[6],
          'purchase_url' => $data[7],
          'public_description' => $data[8],
        );
        Log::debug($newOffer);
        $offer->fill($newOffer);
        $offer->save();
      }
      $count++;
    }

    return response()->json($sourceFile, 201);
  }
}
