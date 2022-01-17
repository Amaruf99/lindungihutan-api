<?php

namespace App\Http\Controllers;

use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class FileUploadController extends Controller {
    public function index(Request $request)
    {
        if (!$request->hasFile('file')) {
            throw new BadRequestException();
        }
        
        if (!$request->file('file')->isValid()) {
            throw new BadRequestException();
        }

        $file = $request->file('file')->getRealPath();
        $file_id = $request->input('id');
        
        $uploadResult = (new UploadApi())->upload($file, [
            'public_id' => $file_id,
            'folder' => '/'.$request->segment(2),
            // 'use_filename' => true,
            // 'unique_filename' => true,
            'discard_original_filename' => true,
        ]);

        return response()->json([
            'is_success' => true,
            'data' => $uploadResult,
        ], 200); 
    }
}

?>