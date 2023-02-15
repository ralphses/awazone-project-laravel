<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserKycDocRequest;
use App\Models\UserKycDoc;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserKycDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $sortBy = $request->sort ?? 'document_type';
        $orderBy = $request->order ?? 'asc';

        $docs = UserKycDoc::orderBy($sortBy, $orderBy)->paginate(12);
        return view('dashboard.user.kyc.view-all-kyc-doc', ['docs' => $docs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('dashboard.user.kyc.new-user-kyc-doc', ['doc_type' => Utility::KYC_DOC_TYPE]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(NewUserKycDocRequest $request)
    {

        $size = $request->files->get('image')->getSize();

        $request->validated($request->all());

        UserKycDoc::create([
            'document_type' => $request->get('doc-type'),
            'image_path' => $this->storeImage($request),
            'size' => $size,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/account')->with('kyc_success', "KYC document submitted!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function actions(Request $request, int $id)
    {
        $doc = UserKycDoc::where('id', $id)->get()->first();


        if($request->method() === 'PATCH') {

            $doc->status = Utility::KYC_STATUS['active'];
            $doc->verified_at =  date("y-m-d h:m:s");

            $doc->save();

        }

        if($request->method() === 'DELETE') {
            UserKycDoc::destroy($id);
        }

        if($request->method() === 'PUT') {

            $doc->status = Utility::KYC_STATUS['rejected'];
            $doc->save();

        }

        if($request->method() === "GET") {
            return view('dashboard.user.kyc.view-one-kyc-doc', ['doc' => $doc]);
        }

        return redirect('/user/kyc');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function updatePassword()
    {
        return view("dashboard.user.user.change-password");
    }


    private function storeImage(Request $request) {

        $name = str_replace(' ', '', $request->user()->name);
        $newImage = uniqid() . '-' . $name . '.' . $request->image->extension();

        $move = $request->image->move(public_path('assets/images/profile/kyc'), $newImage, true);
        $move = str_replace("\assets", '/assets', $move);

        return str_replace('C:\Users\Ralph\Desktop\workspace\awazone-project\public', '', $move);

    }
}
