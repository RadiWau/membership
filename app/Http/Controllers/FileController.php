<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
Use Exception;
use Image;
use File;
use App\Models\User;
use App\Models\Admin;
use App\Models\MemberPaket;
use Carbon\Carbon;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007\Element\Section;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{

    public function ReadAttachmentTopUp($id, $paket){


        $cekAttachment    = MemberPaket::where('user_id', $id)->where('paket_level', $paket)->first('member_paket.image_topup');
        $notfound   = storage_path('app/public/no_image.png');

        if($cekAttachment){

            $path       = storage_path('app/public/'.$cekAttachment->image_topup);

            if (!File::exists($path)) {  // jika file tidak eksis

                $file = File::get($notfound);
                $type = File::mimeType($notfound);
                $response = Response::make($file, 300);
                $response->header("Content-Type", $type);
                return $response;

            }else{ // file eksis

                $file = File::get($path);
                $type = File::mimeType($path);
                $response = Response::make($file, 300);
                $response->header("Content-Type", $type);
                return $response;
            }

        }else{ // jika user tidak ditemukan

            $file = File::get($notfound);
            $type = File::mimeType($notfound);
            $response = Response::make($file, 300);
            $response->header("Content-Type", $type);
            return $response;

        }
    }
}
