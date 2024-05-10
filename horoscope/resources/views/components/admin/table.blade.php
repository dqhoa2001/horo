<section class="section">

    <div class="row" id="table-hover-row">
        <div class="col-12">          
            <div>                                               
                <table id="myTable" class="display cell-border">
                    <thead class="card-header">
                        {{ $header }}
                    </thead>
                    <tbody class="card-body">
                        {{ $body }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{ $paginate }}
</section>
