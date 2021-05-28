<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $country_list = Country::get();
        $country_id = $request['country_id'];
        $user_list = User::with(["company"]);
        if (!empty($request["user_name"])) {
            $user_list = $user_list->where("name", "LIKE", "%" . $request["user_name"] . "%");
        }
        $user_list = $user_list->get();
        return view("welcome", [
            "user_list" => $user_list,
            "country_list" => $country_list,
            "request" => $request,
        ]);
    }

    public function pdf_index()
    {
        return view("index");
    }
    private static function getFileName($file_name)
    {
        return public_path() . "\\" . $file_name;
    }

    public function uploadPdf(Request $request)
    {

        $file = $request->file('pdf_file');
        $file_name = $file->getClientOriginalName();
        $storage = Storage::disk('local-public');


        $file_path = $storage->putFileAs('pdf-file', $file, $file_name);
        $size = $storage->size($file_path);
        if ($storage->exists("pdf-file\\" . $file_name) && $file->getSize() == $size) {
            return response('File already exist ', 422);
        }

        $file_path = static::getFileName($file_path);

        if ($file_path) {
            return response('Uploaded Successfully' . 'Proposal', 200);
        }
        return response('File does not have string ' . 'Proposal', 422);
    }
}
