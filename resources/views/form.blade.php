<x-layout>
    <div class="container">
        <h1>CT Test</h1>
        <div class="row">

          {{-- Alert --}}
          <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" id="alertToast">
            <div class="d-flex">
              <div class="toast-body" id="toastBody"></div>
              <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
          
            <div class="col-6">

                <form action="" method="">
                    <div class="mb-3">
                      <label for="productName" class="form-label">Product name</label>
                      <input type="text" name="productName" id="productName" class="form-control @error('productName') is-invalid @enderror" placeholder="Product name" aria-describedby="productNameHelp" required>
                      @error('productName') <div class="alert alert-danger">{{ $message }}</div> @enderror
                      <small id="productNameHelp" class="text-muted">Enter the product name</small>
                    </div>
                    <div class="mb-3">
                      <label for="productQuantity" class="form-label">Quantity in stock</label>
                      <input type="number" name="productQuantity" id="productQuantity" class="form-control @error('productQuantity') is-invalid @enderror" placeholder="Product Quantity" aria-describedby="productQuantityHelp" required>
                      @error('productQuantity') <div class="alert alert-danger">{{ $message }}</div> @enderror
                      <small id="productQuantityHelp" class="text-muted">Enter the product quantity</small>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Price per item</label>
                      <input type="number" name="productPrice" id="productPrice" class="form-control @error('productPrice') is-invalid @enderror" placeholder="Price per item" aria-describedby="productPriceHelp" required>
                      @error('productPrice') <div class="alert alert-danger">{{ $message }}</div> @enderror
                      <small id="productPriceHelp" class="text-muted">Enter the product price</small>
                    </div>

                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary" id="saveProduct">Save</button>
                    </div>
                </form>

                <hr class="my-3">

                <div class="table-responsive">
                  <table class="table table-hover" id="productsTable">
                    <thead>
                      <tr>
                        <th scope="col">Product name</th>
                        <th scope="col">Quantity in stock</th>
                        <th scope="col">Price per item</th>
                        <th scope="col">Datetime submitted</th>
                        <th scope="col">Total value number</th>
                      </tr>
                    </thead>
                    <tbody id="productsTableBody">
                      @foreach ($products as $product)
                        <tr class="" onclick="editRow({{ $loop->index }})" id="{{ $loop->index }}">
                          <td scope="row">{{ $product->name }}</td>
                          <td>{{ $product->quantity }}</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->createdAt }}</td>
                          <td>{{ $product->totalValue }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <td scope="row"></td>
                      <td></td>
                      <td></td>
                      <td>Total</td>
                      <td id="total">{{ $products->pluck('totalValue')->sum() }}</td>
                    </tfoot>
                  </table>
                </div>
                
            </div>

        </div>
    </div>
</x-layout>