@extends('frontend.layout')
@section('page_title','Privacy Policy')
@section('content')


<div class="rules-area ptb-100">
    <div class="container mt-5">
        <h4>Home -> Favorite</h4>
        <div lass="mt-5">
            <table class="table table-bordered table-striped" id="certificate">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Click</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($favorite as $val)
                    <tr>
                        <td>{{ $val->sku }}</td>
                        <td>{{ $val->click }}</td>
                        <td>{{ $val->name }}</td>
                        <td>
                            <?php 
                                $file_type = mime_content_type('products/'.$val->image->image);
                                $file_ext = explode('/', $file_type)[1];
                            ?>
                            @if($file_ext == 'mp4')
                                <video width="60" height="50"  controls>
                                    <source src="{{URL::asset('products/'.$val->image->image)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <a target="_blank" href="{{ url('products/'.$val->image->image) }}">
                                <img style="height: 40px !important;" src="{{ url('products/'.$val->image->image) }}"/>
                                </a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('favorite/delete/'.$val->id) }}" class="btn btn-danger actbtn" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection