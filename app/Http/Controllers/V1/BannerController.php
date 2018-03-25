<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function getBanner($id)
    {
        $validator = \Validator::make(['id' => $id], [
            'id' => 'required|numeric|min:1|max:10',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            dd($errors->first('id'));
        }
    }
}
