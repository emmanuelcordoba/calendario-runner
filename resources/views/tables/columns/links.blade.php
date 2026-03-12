<div>
    @if(!$getState() && is_array($getState()))
        @foreach($getState() as $link)
            <a href="{{ $link['url'] }}" class="me-1" title="{{ $link['type'] }}" target="_blank">
                @switch($link['type'])
                    @case('Instagram')
                        <i class="fa-brands fa-instagram"></i>
                        @break
                    @case('Facebook')
                        <i class="fa-brands fa-facebook"></i>
                        @break
                    @case('Web')
                        <i class="fa-solid fa-globe"></i>
                @endswitch
            </a>
        @endforeach
    @endif
</div>
