@if (session()->has('status') && session()->has('message'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true"
            style="transition: all 0.5s cubic-bezier(0.68, -0.55, 0.25, 1.35);">
            <div class="toast-header">
                <img src="https://hoshinomai.jp/wp/wp-content/themes/hosinomai/img/common/page_logo.svg"
                    style="width: 35px" class="rounded me-2" alt="..." />
                <strong class="me-auto">Horoscope</strong>
                {{-- <small>11 mins ago</small> --}}
                <button type="button" id="toats-btn-close" class="btn-close" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
            <div class="toast-body {{ session('status') ? 'bg-success' : 'bg-danger' }}" style="color: white">
                {{ session('message') }}
            </div>
        </div>
    </div>

    <script>
        const myTimeout = setTimeout(myGreeting, 5000);

        function myGreeting() {
            document.getElementById('toats-btn-close').click();
        }
    </script>
@endif
