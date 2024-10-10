<div id="flash_message">
    @if(Session::has('flash_alert'))
        <div @click="hide=true" :class="{'d-none':hide}" class="alert alert-danger m-0 text-center" style="margin-bottom:30px; width: 100%; opacity: 0.8; color:#2569bf;">
            {{ Session::get('flash_alert') }}
        </div>
    @endif

    @if (session('status'))
        <div @click="hide=true" :class="{'d-none':hide}" class="alert alert-success m-0 text-center" style="margin-bottom:30px; width: 100%; opacity: 0.8; color:#2569bf;">
            {{ session('status') }}
            {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> --}}
        </div>
    @endif
</div>


@section('flash_message_script')
<script>
    Vue.createApp({
        el: '#flash_message',
        data() {
            return {
                hide: false
            }
        }
    }).mount('#flash_message');
</script>
@endsection

