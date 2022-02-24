<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageType;
use App\Models\LandingPages;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller
{
    public function index()
    {
       
        $params = array('btn_name' => 'CMS Pages', 'btn_fn_param' => '', 'btn_href' => route('pages.add') );

        return view('crm.cms.index', $params);
    }

    public function add(Request $request, $id = '' ) {
        $params['id'] = $id;
        $params['pagetype'] = PageType::where('status', 1)->get();
        return view('crm.cms.add', $params);
    }

    public function save(Request $request, $type=null)
    {
        // return dd($request->all());
        $page_validator = [
            'page_type'     =>  [ 'required', 'string', 'max:255'],
            'page_title'    =>  [ 'required', 'string','max:255'] 
        ];
         
        $validator  =   Validator::make( $request->all(), $page_validator );
        
        if($validator->passes()) {
            if( $request->hasFile( 'page_logo' ) ) {
                $file               =   $request->file('page_logo')->store( 'LandingPages/Logos', 'public' );
            }
            $result = LandingPages::create([
                'page_title'    => $request->page_title,
                'page_type'     => $request->page_type,
                'page_logo'     => $file
            ]);
             
            foreach($request->media_type as $i => $media){
                $result->LandingPageSocialMedias()->create([
                    'name'      => $request->media_type[$i] ,
                    'link'      => $request->link[$i],
                    'icon'      =>  "-",
                ]); 
            }
            foreach($request->banner_title as $i => $banner){
                 
                $image  = $request->file('banner_image')[$i];
                // dd($image);
                $file               =    $image->store( 'LandingPages/Banners', 'public' );
                // dd($file);
                $result->LandingPageBannerSliders()->create([
                    'title'     =>  $request->banner_title[$i] ,
                    'sub_title' =>  $request->sub_banner_title[$i],
                    'image'    =>  $file,
                    'content'   =>  $request->banner_content[$i],
                ]); 
            }
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }
}