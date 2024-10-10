<div class="page-heading">
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action={{ $action }} method={{ $method }}>
                                @csrf
                                {{ $slot }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
