<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageType;
use Illuminate\Support\Str;

use App\Models\LandingPages;
use App\Models\LandingPageSocialMedias;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller
{
    public function index()
    {
        $companyCode = request()->segment(1);
        $params = array('btn_name' => 'CMS Pages', 'btn_fn_param' => '', 'btn_href' => route('pages.add', $companyCode));
        $result = LandingPages::where('status', '=', 1)->get();

        return view('crm.cms.index', $params, compact('result'));
    }

    public function add(Request $request, $companyCode = '', $id = '')
    {
        $params['id'] = $id;
        $params['pagetype'] = PageType::where('status', 1)->get();
        return view('crm.cms.add', $params);
    }

    public function edit(Request $equest, $companyCode = null, $id = null)
    {
        $params['id'] = $id;
        $params['pagetype'] = PageType::where('status', 1)->get();
        $result = LandingPages::where('id', $id)->firstOrFail();
        return view('crm.cms.edit', $params, compact('result'));
    }

    public function save(Request $request, $companyCode = null, $type = null)
    {

        $page_validator = [
            'page_type'     =>  ['required', 'string', 'max:255'],
            'page_title'    =>  ['required', 'string', 'max:255'],
        ];

        $validator  =   Validator::make($request->all(), $page_validator);

        if ($validator->passes()) {
            if ($request->is_default_landing_page) {
                LandingPages::query()->update(['is_default_landing_page' => 0]);
            }
            // dd( $request->all() );
            // if( $request->hasFile('page_logo')){
            //     $page_logo = Input::file('page_logo');

            // }
            // $path = public_path('storage/invoice');

            // if(!File::isDirectory($path)){
            //     File::makeDirectory($path, 0777, true, true);
            // } 
            $ins = [
                'page_title'    => $request->page_title,
                'page_type'     => $request->page_type,
                'page_logo'     => Image::make($request->file('page_logo'))->encode('data-url'),
                'permalink'     => Str::slug($request->page_type),
                'mail_us'       => $request->mail_us,
                'call_us'       => $request->call_us,
                'contact_us'    => $request->contact_us,
                'iframe_tags'   => $request->iframe_tags,
                'other_tags'    => $request->other_tags,
                'about_title'   => $request->about_title,
                'file_about'    => Image::make($request->file('about_image'))->encode('data-url'),
                'about_content' => $request->about_content,
                'primary_color' => $request->primary_color,
                'secondary_color' => $request->secondary_color,
                'is_default_landing_page' => $request->is_default_landing_page ?? 0
            ];
            // dd( $ins );
            $result = LandingPages::create($ins);


            foreach ($request->media_type as $i => $media) {
                if (isset($request->media_type[$i]) && !empty($request->media_type[$i])) {
                    $media_arr = [
                        'name'      => $request->media_type[$i],
                        'link'      => $request->link[$i],
                        'icon'      =>  "-",
                    ];
                    $result->LandingPageSocialMedias()->create($media_arr);
                }
            }
            foreach ($request->form_input_type as $i => $form) {
                if (isset($request->form_input_type[$i]) && !empty($request->form_input_type[$i])) {
                    $input_arr = [
                        'input_type'        =>  $request->form_input_type[$i],
                        'input_required'    =>  $request->form_input_required[$i],
                    ];
                    $result->LandingPageFormInputs()->create($input_arr);
                }
            }

            foreach ($request->banner_title as $i => $banner) {
                if (isset($request->banner_title[$i]) && !empty($request->banner_title[$i])) {
                    $slider_arr = [
                        'title'     =>  $request->banner_title[$i],
                        'sub_title' =>  $request->sub_banner_title[$i],
                        'image'     =>  Image::make($request->file('banner_image')[$i])->encode('data-url'),
                        'content'   =>  $request->banner_content[$i],
                        // 'tags'   =>  $request->tags[$i],
                    ];
                    $result->LandingPageBannerSliders()->create($slider_arr);
                }
            }

            foreach ($request->feature_icon as $i => $row) {
                if (isset($request->feature_title[$i]) && !empty($request->feature_title[$i])) {

                    $result->LandingPageFeatures()->create([
                        'title'     =>  $request->feature_title[$i],
                        'icon'      =>  Image::make($request->file('feature_icon')[$i])->encode('data-url'),
                        'content'   =>  $request->feature_content[$i],
                    ]);
                }
            }

            foreach ($request->meta_name as $i => $media) {
                if (isset($request->meta_name[$i]) && !empty($request->meta_name[$i])) {
                    $meta_arr = [
                        'name'      => $request->meta_name[$i],
                        'description'      => $request->meta_description[$i],
                    ];
                    $result->LandingPageMetaDetail()->create($meta_arr);
                }
            }
            return response()->json(['success' => "Landing page to be created successfully !"]);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }
    public function update(Request $request, $companyCode, $id)
    {
        
        if ($request->is_default_landing_page) {
            LandingPages::query()->update(['is_default_landing_page' => 0]);
        }
        $update = LandingPages::find($id);

        if ($request->file('page_logo')) {
            $page_logo = Image::make($request->file('page_logo'))->encode('data-url');
        }

        if ($request->file('about_image')) {
            $about_image = Image::make($request->file('about_image'))->encode('data-url');
        }

        $update->update([
            'page_title'        => $request->page_title,
            'page_type'         => $request->page_type,
            'page_logo'         => $page_logo ?? $request->page_logo_data_url,
            'permalink'         => Str::slug($request->page_type),
            'mail_us'           => $request->mail_us,
            'call_us'           => $request->call_us,
            'contact_us'        => $request->contact_us,
            'iframe_tags'       => $request->iframe_tags,
            'other_tags'        => $request->other_tags,
            'about_title'       => $request->about_title,
            'file_about'        => $about_image ?? $request->about_image_data_url,
            'about_content'     => $request->about_content,
            'primary_color'     => $request->primary_color,
            'secondary_color'   => $request->secondary_color,
            'is_default_landing_page' => $request->is_default_landing_page ?? 0,
            'meta_title'        => $request->meta_title ?? null,
            'meta_description'  => $request->meta_description ?? null,
        ]);

        //=========== Banner Sliders ========== 
        $update->LandingPageBannerSliders()->delete();

        foreach ($request->banner_title as $i => $banner) {

            if (isset($request->file('banner_image')[$i])) {
                $banner_image = Image::make($request->file('banner_image')[$i])->encode('data-url');
            }
            $update->LandingPageBannerSliders()->create([
                'title'     =>  $request->banner_title[$i],
                'sub_title' =>  $request->sub_banner_title[$i],
                'image'     =>  $banner_image ?? $request->banner_image_data_url[$i],
                'content'   =>  $request->banner_content[$i],
                'tags'   =>  $request->tags[$i],
            ]);
        }

        // ========== Feature Section ==========
        $update->LandingPageFeatures()->delete();
        if ($request->feature_title) {
            foreach ($request->feature_title as $i => $row) {
                if (isset($request->file('feature_icon')[$i])) {
                    $feature_icon = Image::make($request->file('feature_icon')[$i])->encode('data-url');
                }
                $update->LandingPageFeatures()->create([
                    'title'     =>  $request->feature_title[$i],
                    'icon'      =>  $feature_icon ?? $request->feature_icon_data_url[$i],
                    'content'   =>  $request->feature_content[$i],
                ]);
            }
        } else {
            $update->LandingPageFeatures()->delete();
        }

        $update->LandingPageFormInputs()->delete();
        if ($request->form_input_type) {
            foreach ($request->form_input_type as $i => $form) {
                if (isset($request->form_input_type[$i]) && !empty($request->form_input_type[$i])) {
                    $input_arr = [
                        'input_type'        =>  $request->form_input_type[$i],
                        'input_required'    =>  $request->form_input_required[$i],
                    ];
                    $update->LandingPageFormInputs()->create($input_arr);
                }
            }
        } else {
            $update->LandingPageFormInputs()->delete();
        }

        $update->LandingPageSocialMedias()->delete();
        if ($request->media_type) {
            foreach ($request->media_type as $i => $media) {
                if (isset($request->media_type[$i]) && !empty($request->media_type[$i])) {
                    $media_arr = [
                        'name'      => $request->media_type[$i],
                        'link'      => $request->link[$i],
                        'icon'      =>  "-",
                    ];
                    $update->LandingPageSocialMedias()->create($media_arr);
                }
            }
        }

        $update->LandingPageMetaDetail()->delete();
        if ($request->meta_name) {
            foreach ($request->meta_name as $i => $media) {
                if (isset($request->meta_name[$i]) && !empty($request->meta_name[$i])) {
                    $meta_arr = [
                        'name'      => $request->meta_name[$i],
                        'description'      => $request->meta_description[$i],
                    ];
                    $update->LandingPageMetaDetail()->create($meta_arr);
                }
            }
        }

        return response()->json(['success' => "Landing page to be updated successfully !"]);
    }
}