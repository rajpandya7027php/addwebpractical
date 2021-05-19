@extends('layouts.app')
@section('content')
<script src="{{asset('https://code.jquery.com/jquery-3.5.1.js')}}" defer></script>
<script src="{{asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js')}}" defer></script>
<script src="{{asset('https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js')}}" defer></script>
<link href="{{asset('https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<div class="row">
  <div class="col-sm-1"></div>
    <div class="col-sm-10">@if(\Session::has('success'))
        <div class="alert alert-success">
        {{\Session::get('success')}}
        </div>
    @endif</div>
    <div class="col-sm-1"></div>  
</div>
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10"> <a href="{{url('generate-shorten-link')}}" class="btn btn-success mb-2">Short Links</a><br/><br/></div>
<div class="col-sm-1"></div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10">
<table id='analyticTable' width='100%' border="1" style='border-collapse: collapse;'>
      <thead>
        <tr>
         <th>ID</th>
          <th>Link</th>
    			<th>User</th>
    			<th>User Agent</th>
    			<th>IP</th>
    			<th>Created at</th>
        </tr>
      </thead>
    </table>

    <!-- Script -->
    <script type="text/javascript">
    $(document).ready(function(){

      // DataTable
      $('#analyticTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('shortLink.getAnalyticdata')}}",
         columns: [
            { data: 'analytic_id' },
            { data: 'link' },
            { data: 'name' },
            { data: 'useragent' },
            { data: 'ip' },
            { data: 'created_at' },
         ]
      });
    });
    </script>
</div>
<div class="col-sm-1"></div> 
</div>
@endsection  
