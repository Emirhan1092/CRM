@extends('front.beta.layouts.master')

@section('breadcrumb')
@include('front.beta.partials.breadcrumb')
@endsection

@section('content')

@if($faqs)
<!-- Section FAQS Starts -->
<div class="section-faqs-alpha">
    <div class="container">
        @if($faqs)
            @foreach($faqs as $category => $items)
                @if(setting('display_faq_categories') == 'yes')
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="section-heading-style-alpha">
                            <div class="section-heading">
                                <h2>{{ $category }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @foreach($items as $key => $faq)
                        <div class="section-faqs-alpha-item">
                            <div class="accordion simple-shadow">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button shadow-none border-none collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{$faq['faqs_id']}}" aria-expanded="false">
                                        {{$faq['question']}}
                                        </button>
                                    </h2>
                                    <div id="collapse{{$faq['faqs_id']}}" class="accordion-collapse collapse hide">
                                        <div class="accordion-body">
                                            {{$faq['answer']}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
<!-- Section FAQS Ends -->
@endif

@endsection

