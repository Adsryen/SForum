@if (!core_menu_pd($key))
    @if (core_Str_menu_url('/' . request()->path()) === $value['url'])
        <li class="nav-item active">
    @else
        <li class="nav-item">
            @endif
            <a class="nav-link" id="home-menu-{{ $key }}" href="{{ $value['url'] }}">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/package -->
            @if ($value['icon'])
                {!! $value['icon'] !!}
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                </svg>
            @endif
        </span>
                <span class="nav-link-title">
            {{ __($value['name']) }}
        </span>
            </a>

        </li>
        @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button"
                   aria-expanded="false">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/package -->

                @if ($value['icon'])
                    {!! $value['icon'] !!}
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                    </svg>
                @endif
            </span>
                    <span class="nav-link-title">
                {{ __($value['name']) }}
            </span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            @foreach (core_menu_pdArr($key) as $keys => $values)
                                @if(!$values['hidden'])
                                    @if( $values['quanxian'] instanceof \Closure)
                                        @if(call_user_func($values['quanxian'])===true)
                                            @if (core_Str_menu_url('/' . request()->path()) === $values['url'])
                                                <a class="dropdown-item active" menu="active" id="home-menu-{{ $keys }}"
                                                   href="{{ $values['url'] }}">
                                                    @else
                                                        <a class="dropdown-item" id="home-menu-{{ $keys }}"
                                                           href="{{ $values['url'] }}">
                                                            @endif
                                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                            @if ($values['icon'])
                                                                    {!! $values['icon'] !!}
                                                                @else
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-circle"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="2" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                </svg>
                                                                @endif
                        </span>{{ __($values['name']) }}
                                                        </a>
                                                    @endif
                                                    @else
                                                        @if (core_Str_menu_url('/' . request()->path()) === $values['url'])
                                                            <a class="dropdown-item active" menu="active"
                                                               id="home-menu-{{ $keys }}"
                                                               href="{{ $values['url'] }}">
                                                                @else
                                                                    <a class="dropdown-item" id="home-menu-{{ $keys }}"
                                                                       href="{{ $values['url'] }}">
                                                                        @endif
                                                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                            @if ($values['icon'])
                                                                                {!! $values['icon'] !!}
                                                                            @else
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     class="icon icon-tabler icon-tabler-circle"
                                                                                     width="24" height="24"
                                                                                     viewBox="0 0 24 24"
                                                                                     stroke-width="2"
                                                                                     stroke="currentColor"
                                                                                     fill="none" stroke-linecap="round"
                                                                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                </svg>
                                                                            @endif
                        </span>{{ __($values['name']) }}
                                                                    </a>

                                            @endif
                                        @endif
                                        @endforeach
                        </div>
                    </div>
                </div>
            </li>
        @endif
