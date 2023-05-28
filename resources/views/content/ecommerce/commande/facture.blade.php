
      <!-- Invoice -->
      <div class="col-xl-9 col-md-8 col-12">
        <div class="card invoice-preview-card">
          <div class="card-body invoice-padding pb-0">
            <!-- Header starts -->
            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
              <div>
                <div class="logo-wrapper">
                                    <h3 class="text-primary invoice-logo">Vuexy</h3>
                </div>
                <p class="card-text mb-25">123 Street, City, State, ZIP</p>
                <p class="card-text mb-25">Morocco, Casablanca</p>
                <p class="card-text mb-0">+1 (123) 456 7891</p>
              </div>
              <div class="mt-md-0 mt-2">
                <h4 class="invoice-title">
                  Invoice
                  <span class="invoice-number">#INV0{{$commande->id}}</span>
                </h4>
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">Date Issued:</p>
                  <p class="invoice-date">{{$commande->date}}</p>
                </div>
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">Due Date:</p>
                  <p class="invoice-date">29/08/2020</p>
                </div>
              </div>
            </div>
            <!-- Header ends -->
          </div>
  
          <hr class="invoice-spacing" />
  
          <!-- Address and Contact starts -->
          <div class="card-body invoice-padding pt-0">
            <div class="row invoice-spacing">
              <div class="col-xl-8 p-0">
                <h6 class="mb-2">Invoice To:</h6>
                <h6 class="mb-25">{{App\Models\User::find($commande->user_id)->name}}</h6>
                
                <p class="card-text mb-25">{{App\Models\ville::find(App\Models\User::find($commande->user_id)->ville_id)->name}}</p>
                <p class="card-text mb-25">{{App\Models\User::find($commande->user_id)->adress}}</p>
                <p class="card-text mb-25">{{App\Models\User::find($commande->user_id)->phone}}</p>
                <p class="card-text mb-0">{{App\Models\User::find($commande->user_id)->email}}</p>
              </div>
              <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                <h6 class="mb-2">Payment Details:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-1">Total Due:</td>
                      <td><span class="fw-bold">${{$commande->total}}</span></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Address and Contact ends -->
  
          <!-- Invoice Description starts -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="py-1">Product</th>
                  <th class="py-1">Price</th>
                  <th class="py-1">Quantity</th>
                  <th class="py-1 d-flex justify-content-end">Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach (App\Models\ligneCommande::where('commande_id',$commande->id)->join('produit','produit.id','produit_commande.produit_id')->get() as $item)
                    
                <tr>
                  <td class="py-1">
                    <div class="product-item d-flex align-items-center gap-2">
                      <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-light rounded">
                          {{-- <img src="{{asset($item->photo)}}" alt="" class="avatar-sm"> --}}
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="fs-md"><a href="" class="text-reset">{{$item->libelle}}</a></h6>
                        <p class="text-muted mb-0"><a href="#!" class="text-reset">{{App\Models\Brand::where('id',$item->brand_id)->first()->name}}</a></p>
                      </div>
                    </div>
                  </td>
                  <td class="py-1">
                    <span class="fw-bold">${{$item->price}}</span>
                  </td>
                  <td class="py-1">
                    <span class="fw-bold">{{$item->quantite}}</span>
                  </td>
                  <td class="py-1 d-flex justify-content-end ">
                    <span class="fw-bold">${{$item->price*$item->quantite}}</span>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
  
          <div class="card-body invoice-padding pb-0">
            <div class="row invoice-sales-total-wrapper">
              <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                
              </div>
              <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                <div class="invoice-total-wrapper">
                  <div class="invoice-total-item">
                    <p class="invoice-total-title">Subtotal:</p>
                    <p class="invoice-total-amount">${{$commande->total}}</p>
                  </div>
                  <div class="invoice-total-item">
                    <p class="invoice-total-title">Shipping:</p>
                    <p class="invoice-total-amount text-success">Free</p>
                  </div>
                 
                  <hr class="my-50" />
                  <div class="invoice-total-item">
                    <p class="invoice-total-title">Total:</p>
                    <p class="invoice-total-amount">${{$commande->total}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Invoice Description ends -->
  
          <hr class="invoice-spacing" />
  
          <!-- Invoice Note starts -->
          <div class="card-body invoice-padding pt-0">
            <div class="row">
              <div class="col-12">
                <span class="fw-bold">Note:</span>
                <span
                  >It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                  projects. Thank You!</span
                >
              </div>
            </div>
          </div>
          <!-- Invoice Note ends -->
        </div>
      </div>
      <!-- /Invoice -->
  
      <!-- Invoice Actions -->
      
      <!-- /Invoice Actions -->
    