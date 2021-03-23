<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     public function outputResponse($is_success = false, $error=[], $data=[]) {
        if( $is_success ) {
            $output = ['success' => 1];
            if(count($data) > 0) {
                $output['data'] = $data;
            }
        } else {
            $output = [
                'success' => 0,
                'errors' => $error
            ];
        }
        return $this->array_filter_recursive_r($output);
    }

       public function array_filter_recursive_r($array, $callback = null) {
        return $array;
        foreach ($array as $key => & $value) {
            if (is_array($value)) {
                $value = $this->array_filter_recursive_r($value, $callback);
            }
            else {
                if ( ! is_null($callback)) {
                    if ( ! $callback($value)) {
                        $array[$key] = '';
                    }
                }
                else {
                    if ( ! (bool) $value) {
                        $array[$key] = '';
                    }
                }
            }
        }
        unset($value);
        return $array;
    }


}
