<script>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        $.toptip('{!! $error !!}', 'error');
    @endforeach
@elseif (session()->get('flash_success'))
    @if(is_array(json_decode(session()->get('flash_success'), true)))
        $.toptip('{!! implode('', session()->get('flash_success')->all(':message<br/>')) !!}', 'success');
    @else
        $.toptip('{!! session()->get('flash_success') !!}, 'success');
    @endif
@elseif (session()->get('flash_warning'))
    @if(is_array(json_decode(session()->get('flash_warning'), true)))
        $.toptip('{!! implode('', session()->get('flash_warning')->all(':message<br/>')) !!}', 'warning');
    @else
        $.toptip('{!! session()->get('flash_warning') !!}', 'warning');
    @endif
@elseif (session()->get('flash_info'))
    @if(is_array(json_decode(session()->get('flash_info'), true)))
        $.toptip('{!! implode('', session()->get('flash_info')->all(':message<br/>')) !!}', 'warning');
    @else
        $.toptip('{!! session()->get('flash_info') !!}', 'warning');
    @endif
@elseif (session()->get('flash_danger'))
    @if(is_array(json_decode(session()->get('flash_danger'), true)))
        $.toptip('{!! implode('', session()->get('flash_danger')->all(':message<br/>')) !!}', 'warning');
    @else
        $.toptip('{!! session()->get('flash_danger') !!}', 'warning');
@endif
@elseif (session()->get('flash_message'))
    @if(is_array(json_decode(session()->get('flash_message'), true)))
        $.toptip('{!! implode('', session()->get('flash_message')->all(':message<br/>')) !!}', 'warning');
    @else
        $.toptip('{!! session()->get('flash_message') !!}', 'warning');
    @endif
@elseif (session()->get('flash_notification.message'))
    $("body").append('<div class="flashMessage chenggong ok" style="display: none;"><p><img src="/image/gou.png" alt=""></p><span>{!! session()->get("flash_notification.message") !!}</span></div>');
    $(".flashMessage").show().fadeOut(1000);
    //$.toptip('{!! session()->get('flash_notification.message') !!}', 'success');
@elseif (session()->get('flash_notification.error'))
    $.toptip('{!! session()->get('flash_notification.error') !!}', 'error');
@endif
</script>
