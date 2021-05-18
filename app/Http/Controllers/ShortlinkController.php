<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\ShortLink;
use App\Anylyticdata;
use Illuminate\Support\Str;
use Auth;

  
class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();
   
        return view('shortenLink', compact('shortLinks'));
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'link' => 'required|url'
        ]);
   
        $input['link'] = $request->link;
       // $input['code'] = str_random(6);
        $input['code'] =  Str::random(6);
   
        ShortLink::create($input);
  
        return redirect('generate-shorten-link')
             ->with('success', 'Shorten Link Generated Successfully!');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();
        $input['link_id'] = $find->id;
        $input['userAgent'] = request()->userAgent();
        $input['user_id'] = Auth::user()->id;
        $input['ip'] = request()->ip();
        Anylyticdata::create($input);
        return redirect($find->link);
    }
}
