@extends('admin.includes.admin_designv2')

@section('title') Theme Settings - {{ config('app.name', 'Laravel') }} @endsection


@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        @include('admin.includes._message')
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="POST" action="{{route('socialUpdate',$social->id)}}">
                        @csrf
                        <h4 class="page-title">Social Media Settings</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Facebook URL</label>
                                    <input class="form-control" type="url" name="facebook" value="{{$social->facebook}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Twitter URL</label>
                                    <input class="form-control" type="url" name="twitter" value="{{$social->twitter}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Google URL</label>
                                    <input class="form-control" type="url" name="google" value="{{$social->google}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>LinkedIn URL</label>
                                    <input class="form-control" type="url" name="linkedin" value="{{$social->linkedin}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Pinterest URL</label>
                                    <input class="form-control" type="url" name="pinterest" value="{{$social->pinterest}}">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save &amp; update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@endsection



@section('js')

@endsection
