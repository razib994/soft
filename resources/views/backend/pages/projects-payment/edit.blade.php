@extends('backend.layouts.master')
@section('title')
    Project Expernditure Update - {{ $projects->project_name }}
@endsection
@section('content')
    <div class="container-fluid">
        @if (Session::has('message'))
            <div class="alert alert-success">
                <div>
                    <p>{{ Session::get('message') }}</p>
                </div>
            </div>
    @endif
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Edit  Project Expernditure</h1>
            <a href="{{ route('projects.payments', $projects->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Project Expernditure </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Project  Expernditure - {{ $projects->project_name }} </h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('projects.payments.update', ['id' => $projects->id, 'paymented_id' => $projectpayments->id])}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">

                        <div class="col-sm-6">
                            <input type="hidden" value="{{ $projects->id }}" class="form-control" id="project_id" name="project_id" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-3 col-form-label"> Category Name </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="0" disabled selected> Select Your Category </option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($projectpayments->category_id == $category->id) selected @endif>  {{  $category->category_name }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="item_name" class="col-sm-3 col-form-label"> Item Name </label>
                        <div class="col-sm-6">
                            <select name="item_name" class="form-control" id="item_name">
                                <option value="0" disabled selected> Select Your Items </option>
                                @foreach($categories as $category)
                                    <optgroup label="{{ $category->category_name }}">
                                        @php
                                            $items = \App\Item::where('category_id',$category->id)->get();
                                        @endphp
                                        @foreach($items as $item)
                                            <option value="{{ $item->id}}" @if($projectpayments->item_name == $item->id) selected @endif>  {{  $item->items_name }}  </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            {{--                            <input type="text" name="item_name" id="item_name" class="form-control">--}}
                            {{--                            <select class="form-control" name="item_name" id="item_name"></select>--}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="bank_id" name="bank_id">
                                <option value="0"  > Select Your Bank </option>
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}" @if($bank->id == $projectpayments->bank_id) selected @endif>  {{  $bank->bank_name }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_no" class="col-sm-3 col-form-label">Cheque NO</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$projectpayments->check_no}}" class="form-control" id="check_no" name="check_no" placeholder="Enter Your Cheque NO"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" value="{{$projectpayments->date}}" id="date" name="date" placeholder="Enter Your Date"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$projectpayments->amount}}" id="amount" name="amount" placeholder="Enter Your Amount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-3 col-form-label"> Payment Method </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option selected disabled> Select Your Payment Method </option>
                                <option value="cash" @if($projectpayments->payment_method =='cash') selected @endif> Cash </option>
                                <option value="check" @if($projectpayments->payment_method =='check') selected @endif> Cheque </option>
                                <option value="open" @if($projectpayments->payment_method =='open') selected @endif> Opening Balance </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_file" class="col-sm-3 col-form-label"> Check Image </label>
                        <div class="col-sm-6">
                            <input type="file" value="{{ $projectpayments->check_file }}"  class="form-control" id="check_file" name="check_file" />
                        </div>
                        <div>
                            <img src="{{ asset($projectpayments->check_file) }}" width="40px" height="40px" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note" class="col-sm-3 col-form-label"> Note </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="note" name="note" > {{$projectpayments->note}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="submits" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-success" id="submits" name="submit" value="Update"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#item_name').select2();
        });
    </script>
@endsection


