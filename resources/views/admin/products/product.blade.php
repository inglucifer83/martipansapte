<x-admin>
    <x-slot:back>{{ route('admin.products') }}</x-slot>
    <x-slot:title>Product</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="accordion mb-3" id="accordion-h3FwF" style="flex: 1;">
            <div class=\accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collpase-group-one" aria-expanded="true" aria-controls="collapse-group-one">
                        Group One
                    </button>
                </h2>
                <div id="collapse-h3FwF" class="accordion-collapse collapse show" data-bs-parent="#accordion-h3FwF">
                    <div class="accordion-body flex-column justify-content-start align-items-start"><input
                            type="text" class="form-control detail-input" id="product-id" name="id"
                            value="{{ isset($product) && $product ? $product->id : '' }}" readonly>
                        <div class="input-group mb-3" style="width: initial">
                            <span class="input-group-text">Category Id</span>
                            <select class="form-select" name="category_id" aria-label="category_id">
                                @foreach (App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" @selected(isset($product) && $product->category_id == $category->id)>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Name</span>
                            <input type="text" name="name" placeholder="Name" class="form-control detail-input"
                                id="product-name" placeholder="Name"
                                value="{{ isset($product) && $product ? $product->name : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Slug</span>
                            <input type="text" name="slug" placeholder="Slug" class="form-control detail-input"
                                id="product-slug" placeholder="Slug"
                                value="{{ isset($product) && $product ? $product->slug : '' }}">
                        </div>
                        <div class="mb-3" style="align-self: stretch;">
                            <ul class="nav nav-pills mb-1" id="short_description-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link nav-lang active" id="pills-short_description-en_US-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-short_description-en-us"
                                        type="button" role="tab" aria-controls="pills-short_description-en_US"
                                        aria-selected="true">{{ emojiFlag('US') }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link nav-lang" id="pills-short_description-it_IT-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-short_description-it-it"
                                        type="button" role="tab" aria-controls="pills-short_description-it_IT"
                                        aria-selected="false">{{ emojiFlag('IT') }}</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="short_description-pills-tab-content">
                                <div class="tab-pane show active" id="pills-short_description-en-us" role="tabpanel"
                                    aria-labelledby="pills-short_description-en-us-tab" tabindex="0">
                                    <div class="form-floating">
                                        <textarea class="form-control detail-input" placeholder="Short Description" id="product-short_description-en-us"
                                            name="short_description[en_US]" style="height: 100px;">{{ isset($product) && $product ? $product->short_description_en_US : '' }}</textarea>
                                        <label for="product-short_description-en-us">Short Description</label>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pills-short_description-it-it" role="tabpanel"
                                    aria-labelledby="pills-short_description-it-it-tab" tabindex="1">
                                    <div class="form-floating">
                                        <textarea class="form-control detail-input" placeholder="Short Description" id="product-short_description-it-it"
                                            name="short_description[it_IT]" style="height: 100px;">{{ isset($product) && $product ? $product->short_description_it_IT : '' }}</textarea>
                                        <label for="product-short_description-it-it">Short Description</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3" style="align-self: stretch;">
                            <textarea class="form-control detail-input" placeholder="Long Description" id="product-long_description"
                                name="long_description" style="height: 100px;">{{ isset($product) && $product ? $product->long_description : '' }}</textarea>
                            <label for="product-long_description">Long Description</label>
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Sku</span>
                            <input type="text" name="sku" placeholder="Sku" class="form-control detail-input"
                                id="product-sku" placeholder="Sku"
                                value="{{ isset($product) && $product ? $product->sku : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Price</span>
                            <input type="number" name="price" placeholder="Price"
                                class="form-control detail-input" id="product-price" placeholder="Price"
                                value="{{ isset($product) && $product ? $product->price : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Sale Price</span>
                            <input type="number" name="sale_price" placeholder="Sale Price"
                                class="form-control detail-input" id="product-sale_price" placeholder="Sale Price"
                                value="{{ isset($product) && $product ? $product->sale_price : '' }}">
                        </div>

                    </div>
                </div>
            </div>
            <div class=\accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collpase-h3FwF-1" aria-expanded="false" aria-controls="collapse-h3FwF-1">

                    </button>
                </h2>
                <div id="collapse-h3FwF" class="accordion-collapse" data-bs-parent="#accordion-h3FwF">
                    <div class="accordion-body flex-column justify-content-start align-items-start">
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Inventory Quantity</span>
                            <input type="number" name="inventory_quantity" placeholder="Inventory Quantity"
                                class="form-control detail-input" id="product-inventory_quantity"
                                placeholder="Inventory Quantity"
                                value="{{ isset($product) && $product ? $product->inventory_quantity : '' }}">
                        </div>

                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <img src="{{ Str::startsWith($product->featured_image, 'http') ? $product->featured_image : asset('storage/' . $product->featured_image) }}"
                                width="60" height="60" id="product-featured_image-preview" />

                            <div class="input-group mb-3" style="margin-top: 0.5vw; width: initial;"><span
                                    class="input-group-text">Featured Image</span><input name="featured_image"
                                    id="product-featured_image" type="file" class="form-control"
                                    accept=".png,.jpg,.gif,.jpeg,.webp" /></div>
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Seo Title</span>
                            <button class="btn lang-dropdown dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ emojiFlag('US') }}</button>
                            <ul class="dropdown-menu lang-menu" role="tablist">
                                <li><a class="dropdown-item active" id="pills-seo_title-en-us-tab"
                                        data-bs-toggle="pill" role="tab" data-bs-target="#pills-seo_title-en-us"
                                        aria-controls="pills-seo_title-en-us"
                                        aria-selected="true"><span>{{ emojiFlag('US') }}</span> English</a></li>
                                <li><a class="dropdown-item" id="pills-seo_title-it-it-tab" data-bs-toggle="pill"
                                        role="tab" data-bs-target="#pills-seo_title-it-it"
                                        aria-controls="pills-seo_title-it-it"
                                        aria-selected="true"><span>{{ emojiFlag('IT') }}</span> Italian</a></li>
                            </ul>
                            <div class="tab-content lang-tab" id="seo_title-pills-tab-content">
                                <div class="tab-pane show active" id="pills-seo_title-en-us" role="tabpanel"
                                    aria-labelledby="pills-seo_title-en-us-tab">
                                    <input type="text" name="seo_title[en_US]" class="form-control detail-input"
                                        id="product-seo_title" placeholder="Seo Title"
                                        value="{{ isset($product) && $product ? $product->seo_title_en_US : '' }}">
                                </div>
                                <div class="tab-pane" id="pills-seo_title-it-it" role="tabpanel"
                                    aria-labelledby="pills-seo_title-it-it-tab">
                                    <input type="text" name="seo_title[it_IT]" class="form-control detail-input"
                                        id="product-seo_title" placeholder="Seo Title"
                                        value="{{ isset($product) && $product ? $product->seo_title_it_IT : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3" style="align-self: stretch;">
                            <textarea class="form-control detail-input" placeholder="Seo Description" id="product-seo_description"
                                name="seo_description" style="height: 100px;">{{ isset($product) && $product ? $product->seo_description : '' }}</textarea>
                            <label for="product-seo_description">Seo Description</label>
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Weight</span>
                            <input type="number" name="weight" placeholder="Weight"
                                class="form-control detail-input" id="product-weight" placeholder="Weight"
                                value="{{ isset($product) && $product ? $product->weight : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Dimensions</span>
                            <input type="text" name="dimensions" placeholder="Dimensions"
                                class="form-control detail-input" id="product-dimensions" placeholder="Dimensions"
                                value="{{ isset($product) && $product ? $product->dimensions : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Shipping Class</span>
                            <input type="text" name="shipping_class" placeholder="Shipping Class"
                                class="form-control detail-input" id="product-shipping_class"
                                placeholder="Shipping Class"
                                value="{{ isset($product) && $product ? $product->shipping_class : '' }}">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" name="featured_flag" value="1"
                                @checked(isset($product) && $product ? $product->featured_flag : false) type="checkbox" role="switch"
                                id="product-featured_flag">
                            <label class="form-check-label" for="product-featured_flag">Featured Flag</label>
                        </div>
                        <div class="input-group mb-3" style="width: initial">
                            <span class="input-group-text">Status</span>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="draft" @selected($product && $product->status == 'draft')>draft</option>
                                <option value="active" @selected($product && $product->status == 'active')>active</option>
                                <option value="inactive" @selected($product && $product->status == 'inactive')>inactive</option>
                                <option value="archived" @selected($product && $product->status == 'archived')>archived</option>
                            </select>
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Created At</span>
                            <input type="datetime-local" name="created_at" placeholder="Created At"
                                class="form-control detail-input" id="product-created_at" placeholder="Created At"
                                value="{{ isset($product) && $product ? $product->created_at : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Updated At</span>
                            <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                class="form-control detail-input" id="product-updated_at" placeholder="Updated At"
                                value="{{ isset($product) && $product ? $product->updated_at : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Deleted At</span>
                            <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                                class="form-control detail-input" id="product-deleted_at" placeholder="Deleted At"
                                value="{{ isset($product) && $product ? $product->deleted_at : '' }}">
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-admin>
