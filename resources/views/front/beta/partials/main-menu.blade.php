@foreach($items as $item)
    @if($item['childs'])
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-bs-toggle="dropdown">{{__($item['title'])}} <i class="fas fa-chevron-down"></i></a>
            <ul class="dropdown-menu shadow">
            @php $btns = array('register_button', 'login_button', 'dark_mode_button'); @endphp
            @foreach($item['childs'] as $child)
                @if($child['childs'])
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">{{__('message.general')}} <i class="fas fa-chevron-right"></i></a>
                    <ul class="dropdown-menu slide-up-fast">
                    @foreach($child['childs'] as $c)
                        @if (!in_array($c['type'], $btns))
                        <li>
                            <a class="dropdown-item {{homeLink($c['type'])}}" href="{{$c['link']}}">
                                {{ __($c['title']) }}
                            </a>
                        </li>
                        @endif
                    @endforeach
                    </ul>
                </li>
                @elseif (!in_array($child['type'], $btns))
                <li>
                    <a class="dropdown-item {{homeLink($child['type'])}}" href="{{$child['link']}}">{{__($child['title'])}}</a>
                </li>
                @else
                @endif
            @endforeach
            </ul>
        </li>                    
    @else
        @if ($item['type'] == 'login_button' && ((candidateSession() && setting('front_login_type') != 'only_employers') || (employerSession() && setting('front_login_type') != 'only_candidates')))
            @php 
                $type = setting('front_login_type') == 'only_employers' ? 'employer' : 'candidate';
                $img = candidateOrEmployerThumb($type); 
            @endphp
            <li class="nav-item dropdown">
                <a class="nav-link user-dropdown" href="#" data-bs-toggle="dropdown">
                    <img class="menu-avatar" src="{{$img['image']}}" onerror="this.src='{{$img['error']}}'" alt="Employer" />
                </a>
                <ul class="dropdown-menu shadow user-dropdown-list">
                    @if (candidateSession() && setting('front_login_type') != 'only_employers')
                    <li>
                        <a class="dropdown-item" href="{{route('front-profile')}}">
                            <i class="fa-solid fa-user"></i> {{__('message.profile')}}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('front-password')}}">
                            <i class="fa-solid fa-key"></i> {{__('message.password')}}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('front-logout')}}">
                            <i class="fa-solid fa-sign-out"></i> {{__('message.logout')}}
                        </a>
                    </li>
                    @else
                    <li><a class="dropdown-item" href="{{route('employer-dashboard')}}">{{__('message.dashboard')}}</a></li>
                    <li><a class="dropdown-item" href="{{route('employer-logout')}}">{{__('message.logout')}}</a></li>
                    @endif
                </ul>
            </li>                        
        @elseif ($item['type'] == 'register_button' && (candidateSession() || employerSession()))

        @elseif ($item['type'] == 'language_button')
            {!! activeLanguages() !!}
        @else
            @if($item['type'] == 'login_button')
            <li class="nav-item">
                <a class="nav-link {{homeLink($item['type'])}}" href="{{$item['link']}}">
                    <i class="fa fa-sign-in"></i> {{__($item['title'])}}
                </a>
            </li>
            @elseif($item['type'] == 'all_candidates_page' && (setting('enable_only_employer_to_view_candidates') == 'yes' && !employerSession()))
            @else
            <li class="nav-item">
                <a class="nav-link {{homeLink($item['type'])}}" href="{{$item['link']}}">
                    {{__($item['title'])}}
                </a>
            </li>
            @endif
        @endif
    @endif
@endforeach 