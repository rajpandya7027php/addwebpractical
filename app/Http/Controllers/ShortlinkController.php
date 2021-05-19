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
        $shortLinks = ShortLink::orderBy('id', 'ASC')->latest()->get();
   
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
        if(!empty($find)){
        $input['link_id'] = $find->id;
        $input['userAgent'] = request()->userAgent();
        $input['user_id'] = Auth::user()->id;
        $input['ip'] = request()->ip();
        Anylyticdata::create($input);
        return redirect($find->link);
        }
        
    }
    public function analyticdata(){
        //echo 'test';exit;
        //
        $data['anylyticdata'] = Anylyticdata::with('shortlink')->orderBy('analytic_id','desc')->paginate(10);
        return view('list', compact('anylyticdata'));
        //return view('list',$data);
    }
    public function analyticdatarecords()
    {
        $data['anylyticdata'] = Anylyticdata::with('shortLink')->orderBy('analytic_id', 'ASC')->paginate(10);
       return view('list',$data);
    }
     /*
   AJAX request
   */
   public function getAnalyticdata(Request $request){

     ## Read value
     $draw = $request->get('draw');
     $start = $request->get("start");
     $rowperpage = $request->get("length"); // Rows display per page

     $columnIndex_arr = $request->get('order');
     $columnName_arr = $request->get('columns');
     $order_arr = $request->get('order');
     $search_arr = $request->get('search');

     $columnIndex = $columnIndex_arr[0]['column']; // Column index
     $columnName = $columnName_arr[$columnIndex]['data']; // Column name
     $columnSortOrder = $order_arr[0]['dir']; // asc or desc
     $searchValue = $search_arr['value']; // Search value

     // Total records
     $totalRecords = Anylyticdata::select('count(*) as allcount')->count();
     //$totalRecordswithFilter = Anylyticdata::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();
     $totalRecordswithFilter = $totalRecords;
     // Fetch records
     $records = Anylyticdata::with('shortLink')->orderBy($columnName,$columnSortOrder)
       ->select('anylyticdatas.*')
       ->skip($start)
       ->take($rowperpage)
       ->get();

     $data_arr = array();
     //echo '<pre>';print_r($records);exit;
     foreach($records as $record){
        $analytic_id = $record->analytic_id;
        $link = $record->ShortLink->link;
        $useragent = $record->userAgent;
        $name = $record->user->name;
        $ip = $record->ip;
        $created_date =date('Y-m-d',strtotime($record->created_at));
       
        $data_arr[] = array(
          "analytic_id"=> $analytic_id,
          "link" => $link,
           "name" => $name,
          "useragent" => $useragent,        
          "ip"=>$ip,
          "created_at" => $created_date,
        );
     }
   //  echo '<pre>';print_r($data_arr);exit;

     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "aaData" => $data_arr
     );

     echo json_encode($response);
     exit;
   }
}
