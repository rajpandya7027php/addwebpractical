@extends('layouts.app')

@section('content')
   
<div class="container">
    <h1>Please enter url in this form</h1>
   
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ route('generate.shorten.link.post') }}" id="form_link">
            @csrf
            <div class="row">
            <div class="col-sm-10">    
            <div class="form-group">
              <input type="text" name="link" id="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <span class="text-danger">{{ $errors->first('link') }}</span>             
            </div>
            </div>
            <div class="col-sm-2"> 
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Generate Short Link</button>
            </div>
            </div>
            </div>  
        </form>
      </div>
      <div class="card-body">
   
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
   
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                        <th>Scan Qc code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                            <td>
                                <a href="javascript:void(0);" title="View QR Code" style="display: block;" class="viewqr" data-id="{{ $row->id }}" >View QR Code</a>
                                <span class="qrspan{{$row->id}}" style="display: none;"><img src="https://chart.googleapis.com/chart?chs=300x300&amp;cht=qr&amp;chl={{ route('shorten.link', $row->code) }}" class="qr-code img-thumbnail img-responsive"><span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
   
</div>
@endsection
