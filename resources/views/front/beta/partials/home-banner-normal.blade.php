<!-- Home Banner Section Starts -->
<div class="banner-normal-section">
    <div class="container">
        <div class="row align-items-center h-100">
            <div class="col-md-6">
                <div class="banner-normal-section-left">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12">
                            <div class="banner-normal-section-left-top slide-down">
                                {!! translating(setting('home_banner_text')) !!}
                            </div>
                        </div>
                        @if(setting('home_banner_filters_display') == 'yes')
                            <div class="col-md-12 p-0">
                                <div class="banner-normal-section-left-bottom slide-up">
                                    <div class="banner-normal-search">
                                        <div class="row">
                                            <div class="col banner-normal-search-input">
                                                <div class="sinput-box border-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                         viewBox="0 0 14 14" fill="none">
                                                        <g clip-path="url(#clip0_30_1080)">
                                                            <path d="M2.00005 3.99998C0.897217 3.99998 0 3.10298 0 2.00005C0 0.897003 0.897217 0 2.00005 0C3.10277 0 3.99998 0.897003 3.99998 2.00005C3.99998 3.10298 3.10277 3.99998 2.00005 3.99998ZM2.00005 0.999969C1.44847 0.999969 0.999969 1.44879 0.999969 2.00005C0.999969 2.5513 1.44847 3.00002 2.00005 3.00002C2.55151 3.00002 3.00002 2.5513 3.00002 2.00005C3.00002 1.44879 2.55151 0.999969 2.00005 0.999969Z"
                                                                  fill="#A0ABB8"/>
                                                            <path d="M7.00002 3.99998C5.89719 3.99998 4.99997 3.10298 4.99997 2.00005C4.99997 0.897003 5.89719 0 7.00002 0C8.10284 0 9.00006 0.897003 9.00006 2.00005C9.00006 3.10298 8.10284 3.99998 7.00002 3.99998ZM7.00002 0.999969C6.44855 0.999969 6.00005 1.44879 6.00005 2.00005C6.00005 2.5513 6.44855 3.00002 7.00002 3.00002C7.55148 3.00002 7.99998 2.5513 7.99998 2.00005C7.99998 1.44879 7.55148 0.999969 7.00002 0.999969Z"
                                                                  fill="#A0ABB8"/>
                                                            <path d="M12 3.99998C10.8972 3.99998 10 3.10298 10 2.00005C10 0.897003 10.8972 0 12 0C13.1028 0 14 0.897003 14 2.00005C14 3.10298 13.1028 3.99998 12 3.99998ZM12 0.999969C11.4485 0.999969 11 1.44879 11 2.00005C11 2.5513 11.4485 3.00002 12 3.00002C12.5515 3.00002 13 2.5513 13 2.00005C13 1.44879 12.5515 0.999969 12 0.999969Z"
                                                                  fill="#A0ABB8"/>
                                                            <path d="M2.00005 9.00005C0.897217 9.00005 0 8.10304 0 7C0 5.89696 0.897217 4.99995 2.00005 4.99995C3.10277 4.99995 3.99998 5.89696 3.99998 7C3.99998 8.10304 3.10277 9.00005 2.00005 9.00005ZM2.00005 6.00003C1.44847 6.00003 0.999969 6.44875 0.999969 7C0.999969 7.55125 1.44847 7.99997 2.00005 7.99997C2.55151 7.99997 3.00002 7.55125 3.00002 7C3.00002 6.44875 2.55151 6.00003 2.00005 6.00003Z"
                                                                  fill="#A0ABB8"/>
                                                            <path d="M7.00002 9.00005C5.89719 9.00005 4.99997 8.10304 4.99997 7C4.99997 5.89696 5.89719 4.99995 7.00002 4.99995C8.10284 4.99995 9.00006 5.89696 9.00006 7C9.00006 8.10304 8.10284 9.00005 7.00002 9.00005ZM7.00002 6.00003C6.44855 6.00003 6.00005 6.44875 6.00005 7C6.00005 7.55125 6.44855 7.99997 7.00002 7.99997C7.55148 7.99997 7.99998 7.55125 7.99998 7C7.99998 6.44875 7.55148 6.00003 7.00002 6.00003Z"
                                                                  fill="#A0ABB8"/>
                                                            <path d="M12 9.00005C10.8972 9.00005 10 8.10304 10 7C10 5.89696 10.8972 4.99995 12 4.99995C13.1028 4.99995 14 5.89696 14 7C14 8.10304 13.1028 9.00005 12 9.00005ZM12 6.00003C11.4485 6.00003 11 6.44875 11 7C11 7.55125 11.4485 7.99997 12 7.99997C12.5515 7.99997 13 7.55125 13 7C13 6.44875 12.5515 6.00003 12 6.00003Z"
                                                                  fill="#A0ABB8"/>
                                                            <path d="M2.00005 14C0.897217 14 0 13.103 0 12C0 10.897 0.897217 10 2.00005 10C3.10277 10 3.99998 10.897 3.99998 12C3.99998 13.103 3.10277 14 2.00005 14ZM2.00005 11C1.44847 11 0.999969 11.4487 0.999969 12C0.999969 12.5512 1.44847 13 2.00005 13C2.55151 13 3.00002 12.5512 3.00002 12C3.00002 11.4487 2.55151 11 2.00005 11Z"
                                                                  fill="#A0ABB8"/>
                                                            <path d="M7.00002 14C5.89719 14 4.99997 13.103 4.99997 12C4.99997 10.897 5.89719 10 7.00002 10C8.10284 10 9.00006 10.897 9.00006 12C9.00006 13.103 8.10284 14 7.00002 14ZM7.00002 11C6.44855 11 6.00005 11.4487 6.00005 12C6.00005 12.5512 6.44855 13 7.00002 13C7.55148 13 7.99998 12.5512 7.99998 12C7.99998 11.4487 7.55148 11 7.00002 11Z"
                                                                  fill="#A0ABB8"/>
                                                            <path d="M12 14C10.8972 14 10 13.103 10 12C10 10.897 10.8972 10 12 10C13.1028 10 14 10.897 14 12C14 13.103 13.1028 14 12 14ZM12 11C11.4485 11 11 11.4487 11 12C11 12.5512 11.4485 13 12 13C12.5515 13 13 12.5512 13 12C13 11.4487 12.5515 11 12 11Z"
                                                                  fill="#A0ABB8"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_30_1080">
                                                                <rect width="14" height="14" fill="white"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <input type="text" class="form-control job-search-value"
                                                           placeholder="{{__('message.keywords')}}">
                                                </div>
                                            </div>
                                            <div class="col banner-normal-search-select">
                                                <div class="sinput-box">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                         viewBox="0 0 18 18" fill="none">
                                                        <path d="M8.99551 12.858V10.765" stroke="#A0ABB8"
                                                              stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M14.1062 3.49745C15.5004 3.49745 16.6224 4.6277 16.6224 6.02195V8.85995C14.5929 10.048 11.9117 10.7657 8.99116 10.7657C6.07066 10.7657 3.39766 10.048 1.36816 8.85995V6.0137C1.36816 4.61945 2.49841 3.49745 3.89266 3.49745H14.1062Z"
                                                              stroke="#A0ABB8" stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                        <path d="M11.8834 3.4937V3.19175C11.8834 2.18525 11.0666 1.3685 10.0601 1.3685H7.93165C6.92515 1.3685 6.1084 2.18525 6.1084 3.19175V3.4937"
                                                              stroke="#A0ABB8" stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                        <path d="M1.38867 11.8737L1.5446 13.9436C1.6502 15.3387 2.81262 16.417 4.211 16.417H13.7802C15.1785 16.417 16.341 15.3387 16.4466 13.9436L16.6025 11.8737"
                                                              stroke="#A0ABB8" stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                    <select class="form-control select2" id="job-department-home">
                                                        <option value="" disabled
                                                                selected>{{__('message.department')}}</option>
                                                        @if($departments_banner)
                                                            @foreach($departments_banner as $db)
                                                                <option value="{{encode($db['department_id'])}}"
                                                                        class="sel-opt">{{$db['title']}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn job-search-btn" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if($search_logs && setting('home_banner_filters_display') == 'yes')
                    <div class="row align-items-center h-100">
                        <div class="col-md-12 p-0">
                            <div class="banner-normal-section-left-tags-container slide-up">
                                <p>{{__('message.most_searched')}}</p>
                                @foreach($search_logs as $sl)
                                    <a href="#" class="keyword-history-search" data-value="{{$sl['title']}}">
                                        <div class="banner-normal-section-left-tag-item item">
                                            <div class="banner-normal-section-left-tag-item-dot"><i
                                                        class="fa-icon-tag fa-solid fa-tag"></i></div>
                                            {{$sl['title']}}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="banner-normal-section-right-top pop-up">
                    <img class="banner-normal" src="{{ setting('site_banner') }}"
                         onerror="this.src='{{url('/cdn-general').'/essentials/images/banner-default.png'}}'"/>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Home Banner Section Ends -->