@props(['active', 'notify'])

<span class="w-1 h-1 ml-1 mb-2 bg-pink-500  rounded-full hidden" id="{{ $notify }}"></span>
@push('event')   
    @if ($active == true)
    <script>
        window.localStorage.removeItem('{{ $notify }}');
    </script>    
    @else
    <script>
        (window.localStorage.getItem('{{ $notify }}') == 1) ? $("#{{ $notify }}").removeClass('hidden') : null;
    </script>
    @endif
@endpush