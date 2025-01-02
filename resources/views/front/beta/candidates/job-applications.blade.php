@extends('front'.viewPrfx().'layouts.master')

@section('breadcrumb')
@include('front'.viewPrfx().'partials.breadcrumb')
@endsection

@section('content')

<!-- Account Section Starts -->
<div class="section-account-alpha-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="section-account-alpha-navigation">
                    @include('front'.viewPrfx().'partials.account-sidebar')
                </div>
            </div>
            <div class="col-md-9">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <!-- Resume List Table Starts -->
                        <div class="table-responsive">
                            <table class="table section-account-alpha-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{__('message.job')}}</th>
                                        <th scope="col">{{__('message.department')}}</th>
                                        <th scope="col">{{__('message.employer')}}</th>
                                        <th scope="col">{{__('message.status')}}</th>
                                        <th scope="col">{{__('message.applied_on')}} </th>
                                        <th scope="col">{{__('message.details')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($jobs)
                                    @foreach ($jobs as $key => $job)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td title="{{$job['title']}}">{{trimString($job['title'], 20)}}</td>
                                        @php $dept = $job['department'] ? $job['department'] : '---'; @endphp
                                        <td title="{{$dept}}">{{trimString($dept, 20)}}</td>
                                        <td title="{{$job['company']}}">{{trimString($job['company'], 20)}}</td>
                                        <td>{{$job['job_status']}}</td>
                                        <td>{{date('d M, Y', strtotime($job['applied_on']))}}</td>
                                        <td>
                                            <a href="{{route('front-jobs-detail', $job['slug'])}}"
                                                target="_blank" class="view-btn">
                                                <i class="fa fa-eye"></i>
                                            </a> 
                                            @if(setting('enable_delete_application_feature_for_candidate') == 'yes')| 
                                            <a href="{{route('front-acc-job-app-delete', encode($job['job_application_id']))}}" class="view-btn delete-job-application">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7">{{__('message.no_record_found')}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- Resume List Table Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section Ends -->

@endsection
