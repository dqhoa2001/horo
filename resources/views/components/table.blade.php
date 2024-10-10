<section class="section">

    <div class="row" id="table-hover-row">
        <div class="col-12">          
            <div>     
                <div class="row justify-content-end">                                   
                    <div class="col-5">
                        <div class="input-group">
                            <input type="text" id="customSearchInput" class="form-control" placeholder="キーワードを入力してください。"> 
                            <button class="btn btn-primary"  id="customSearchButton" type="button">検索</button>
                        </div>                       
                    </div>                  
                </div>                                 
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
    {{-- {{ $paginate }} --}}
</section>
