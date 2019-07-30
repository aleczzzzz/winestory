<div class="form-group label-floating is-empty">
    <label for="name" class="control-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{isset($product) ? $product->name : null}}">
    <span class="material-input"></span>
</div>

<div class="form-group label-floating is-empty">
    <label for="price" class="control-label">Price</label>
    <input type="number" class="form-control" id="price" name="price" value="{{isset($product) ? $product->price : null}}" min="0" step="any">
    <span class="material-input"></span>
</div>

<button type="submit" class="btn btn-fill btn-rose">Submit<div class="ripple-container"></div></button>
<a href="{{route('dashboard.products.index')}}" class="btn btn-default">Back</a>