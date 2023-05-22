<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entries;
use Validator;
use Carbon\Carbon;
define('base',env("BASE_URL"));
class ShortnerController extends Controller
{
    public function createEntry(Request $request){
        try{
            if(!$request->unique_name || !$request->url){
                return [
                    'message' => 'A required parameter is missen',
                    'status' => 400
                ];
            }
            $check = Entries::where('unique_name',$request->unique_name)->first();
            if($check){
                return [
                    'message' => 'Your chosen unique name is not available',
                    'status' => 400
                ];
            }
            $new_url = $this->shortenUrl($request->unique_name);
            Entries::create([ 
                'unique_name' => $request->unique_name,
                'original_url' => $request->url,
                'expiration' => Carbon::now()->addDays(60)->timestamp,
                'short_url' =>$new_url
            ]);
            return [
                'message' => 'URL succesfully shortened',
                'new_url' => $new_url,
                'status' => 200
            ];
        }catch(Exception $e){
            return [
                'message' => 'URL could not be shortened, please try again later',
                'status' => 500
            ];
        }

    }
    
    public function createRedirection(Request $request,$name){
        $entry = Entries::where('unique_name',$name)->first();
        if(!$entry){
            return [
                'message' => 'Oops, unique name does not exist in our system',
                'status' => 404
            ];
        }
        return [
            'message' => 'Original URL successfully retrieved',
            'original_url' => $entry->original_url,
            'status' => 200
        ];

    }

    protected function shortenUrl($name){
        $new_url = Constant('base').$name;
        return $new_url;
    }
}
