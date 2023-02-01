<div>
  <div class="header bg-white py-4">
      <div class="container-fluid">
          <div class="header-body">
              <div class="align-items-center mt-4 py-3">





                <div class="d-flex justify-content-between">
                  <h2 class="mb-4 h1">Contacts</h2>
              </div>
              
              
              <div class="row justify-content-between align-items-center">
                                      
                <div class="col-lg-4 form-group position-relative mb-0">
                    <input wire:model="search" class="form-control form-control-sm form-control-muted border-0"
                        placeholder="Recherche..." type="text"><i
                        class="fas fa-search text-primary position-absolute" style="right: 25px;top:25%;"></i>
                </div>
              
              
                <div class="col-lg-6 mt-3 mt-lg-0 d-flex justify-content-between justify-content-lg-end">
              
                    <div class="row">
              
                        <div class="col-6">
                            <div class="form-group mb-2">
                                {{-- <span>Date de:</span> --}}
                                <input type="date" class="form-control form-control-muted form-control-sm border-0"
                                    wire:model="fromDate">
                            </div>
                        </div>
              
              
                        <div class="col-6">
                            <div class="form-group mb-2">
                                {{-- <span>à:</span> --}}
                                <input type="date" class="form-control form-control-muted form-control-sm border-0"
                                    wire:model="toDate">
                            </div>
                        </div>
              
                    </div>
              
                </div>
              
              
                <div class="bg-dander col-lg-2 text-right">
                    <div class="badge badge-lg badge-primary m-0">{{$contacts->count()}} contacts</div>
                </div>
              </div>
              

              </div>
          </div>
      </div>
  </div>
</div>







