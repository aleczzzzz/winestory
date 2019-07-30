<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{isset($product) ? $product->name : null}}">
</div>

<div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{isset($product) ? $product->price : null}}" min="0" step="any">
</div>

<button type="submit" class="btn btn-primary">Submit</button>