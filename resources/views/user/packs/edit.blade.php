@extends('layouts.app')

@section('page-title') Edit Pack @endsection

@section('content')

    <span class="badge saved-badge badge-success">Saved</span>

    @guest
        <div  class="alert alert-warning" role="alert">
            Your pack will be stored in your browser session until you are ready to create an account.
        </div>
    @else
        <div id="pack-is-hidden-alert" class="alert alert-danger" role="alert" @if ($pack->is_visible) style="display: none;" @endif>
            This pack is marked <b>private</b> and will not be listed on our site until you mark it <b>visible</b>.
        </div>
    @endguest

    <input type="hidden" id="id" name="id" value="{{$pack->id}}" />
    <div class="row">
        <div class="col-12 text-right">
            @guest
                <div class="btn-group btn-group-lg pb-2" role="group">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Create Account</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button>
                </div>
            @else
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePackModal">
                    Delete Pack
                </button>
            @endguest
            <div class="d-flex d-md-none" style="margin-bottom: 10px;"></div>
        </div>
    </div>

    <div class="modal" id="deletePackModal" tabindex="-1" role="dialog" aria-labelledby="deletePackModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Delete Pack</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure you would like to delete this pack?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No Cancel</button>
                    <button id="confirmDeletePackBtn" type="button" class="btn btn-danger" data-dismiss="modal">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row view-pack-heading-row">

        <div class="col-12 col-md-2">
            <div id="packImageContent" class="image-content">
                @if ($pack->image)
                    <img src="{{Storage::url ($pack->image)}}?v=@php echo rand (0,100000000); @endphp" />
                @else
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(8.932696708362196) translate(0.21500003337860107 -0.9419994354248047)">
                            <g xmlns="http://www.w3.org/2000/svg">
                                <path d="M31.639,20.609c-0.644-4.262-4.346-10.375-6.43-11.631l-0.512-0.306H21.34c-1.775-2.437-3.688-3.637-5.761-3.561   c-2.797,0.102-4.783,2.602-5.445,3.561h-2.8L6.608,9.123c-2.116,1.524-5.59,7.369-6.213,11.486   c-0.61,4.029,1.006,5.716,2.027,6.361c0.705,0.446,1.54,0.67,2.42,0.668c0.577,0,1.174-0.096,1.766-0.283   c0,1.082,0.877,1.959,1.958,1.959H23.25c1.081,0,1.958-0.877,1.958-1.959v-0.073c0.662,0.237,1.335,0.356,1.981,0.356   c0.881,0,1.718-0.223,2.42-0.668C30.63,26.325,32.25,24.639,31.639,20.609z M15.661,7.176c0.993-0.024,1.991,0.474,2.991,1.496   h-5.846C13.519,7.95,14.519,7.214,15.661,7.176z M4.083,24.355c-0.64-0.406-0.872-1.633-0.622-3.283   c0.406-2.691,1.893-5.371,3.147-7.215v10.091C5.69,24.552,4.657,24.719,4.083,24.355z M22.604,26.369   c0.035,0.152,0,0.312-0.098,0.436c-0.098,0.122-0.244,0.193-0.402,0.193h-0.578c-0.144,0-0.28-0.064-0.375-0.175   c-0.092-0.111-0.131-0.259-0.104-0.4l0.269-1.483c-0.477-0.166-0.82-0.625-0.82-1.16c0-0.459,0.219-0.86,0.627-1.07v-9.471H10.696   V23.68c0,0.285-0.226,0.518-0.511,0.518s-0.512-0.231-0.512-0.518V12.713c0-0.286,0.237-0.5,0.523-0.5h11.439   c0.286,0,0.508,0.215,0.508,0.5v9.914c0.479,0.174,0.799,0.622,0.799,1.146c0,0.482-0.274,0.906-0.683,1.106L22.604,26.369z    M27.95,24.355c-0.579,0.367-1.63,0.192-2.552-0.424c-0.063-0.041-0.125-0.078-0.191-0.109v-10.28   c1.295,1.843,2.936,4.681,3.365,7.53C28.823,22.723,28.591,23.948,27.95,24.355z"></path>
                            </g>
                        </g></svg>
                @endif
            </div>
            <div class="text-center">
                <div class="upload-btn-wrapper"><br />
                    <button class="btn btn-primary btn-sm">Upload</button>
                    <input id="uploadPackImageBtn" type="file" name="image" />
                    <input type="hidden" name="pack-asset-image" id="pack-asset-image" value="" />
                </div>

                <div id="uploadPackImageProgressBar" class="progress" style="display: none;margin-top: 10px;">
                    <div class="progress-bar progress-bar-animated progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">

            <div class="form-group">
                <label for="title">Name</label>
                <input name="name" id="name" class="form-control" value="{{$pack->name}}">
            </div>

            @auth
            <div class="form-group">
                <label for="visible">Visible On Site</label>
                <select class="form-control" name="visible" id="visible">
                    <option value="1" @if ($pack->is_visible) selected @endif>Yes (Visible On Site)</option>
                    <option value="0" @if (!$pack->is_visible) selected @endif>No (Keep Private)</option>
                </select>
            </div>
            @endauth

            <div class="form-group">
                <label for="season">Season</label>
                <select class="form-control" name="season_id" id="season_id">
                    <option value="0">N/A</option>
                    @if ($pack_seasons)
                        @foreach ($pack_seasons as $season)
                            <option value="{{$season->id}}" @if ($pack->season_id == $season->id) selected @endif>{{$season->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="d-none d-md-flex" style="height: 30px;"></div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">Pack Overview</h5>
                        </div>
                        @auth
                            <div class="col text-right">
                                <a href="{{route ('packs.show', ['pack' => $pack])}}" class="btn btn-sm btn-primary">view on site</a>
                            </div>
                        @endauth
                    </div>


                    <p class="card-text">
                        <svg class=more-info-svg-badge data-content="Everything except Consumable & Worn." data-placement=bottom data-toggle=popover data-trigger=hover enable-background="new 0 0 300 300"version=1.1 viewBox="0 0 300 300"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g transform="translate(5 5) scale(0.6472593483814157) translate(-31.98046875 -31.978515625)"><g xmlns=http://www.w3.org/2000/svg><path d="M480,253C478.3,129.3,376.7,30.4,253,32S30.4,135.3,32,259c1.7,123.7,103.3,222.6,227,221C382.7,478.3,481.7,376.7,480,253   z M256,111.9c17.7,0,32,14.3,32,32s-14.3,32-32,32c-17.7,0-32-14.3-32-32S238.3,111.9,256,111.9z M300,395h-88v-11h22V224h-22v-12   h66v172h22V395z"></path></g></g></svg>
                        Base Weight: <span id="pack_base_weight_ounces_display">{{$pack->small_desired_weight_format ($pack_weight_units)}}</span> (<span id="pack_base_weight_pretty_display" class="convertOunces">{{$pack->visible_ounces  ?? '0'}}</span>)<br />
                        <svg class=more-info-svg-badge data-content="Everything except Worn." data-placement=bottom data-toggle=popover data-trigger=hover enable-background="new 0 0 300 300"version=1.1 viewBox="0 0 300 300"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g transform="translate(5 5) scale(0.6472593483814157) translate(-31.98046875 -31.978515625)"><g xmlns=http://www.w3.org/2000/svg><path d="M480,253C478.3,129.3,376.7,30.4,253,32S30.4,135.3,32,259c1.7,123.7,103.3,222.6,227,221C382.7,478.3,481.7,376.7,480,253   z M256,111.9c17.7,0,32,14.3,32,32s-14.3,32-32,32c-17.7,0-32-14.3-32-32S238.3,111.9,256,111.9z M300,395h-88v-11h22V224h-22v-12   h66v172h22V395z"></path></g></g></svg>
                        Total Pack Weight: <span id="pack_total_weight_ounces_display">{{$pack->small_desired_weight_format ($pack_weight_units)}}</span> (<span id="pack_total_weight_pretty_display" class="convertOunces">{{$pack->visible_ounces  ?? '0'}}</span>)<br />
                        <svg class=more-info-svg-badge data-content="Everything."data-placement=bottom data-toggle=popover data-trigger=hover enable-background="new 0 0 300 300"version=1.1 viewBox="0 0 300 300"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g transform="translate(5 5) scale(0.6472593483814157) translate(-31.98046875 -31.978515625)"><g xmlns=http://www.w3.org/2000/svg><path d="M480,253C478.3,129.3,376.7,30.4,253,32S30.4,135.3,32,259c1.7,123.7,103.3,222.6,227,221C382.7,478.3,481.7,376.7,480,253   z M256,111.9c17.7,0,32,14.3,32,32s-14.3,32-32,32c-17.7,0-32-14.3-32-32S238.3,111.9,256,111.9z M300,395h-88v-11h22V224h-22v-12   h66v172h22V395z"></path></g></g></svg>
                        Skin Out Weight: <span id="pack_skin_out_weight_ounces_display">{{$pack->small_desired_weight_format ($pack_weight_units)}}</span> (<span id="pack_skin_out_weight_pretty_display" class="convertOunces">{{$pack->visible_ounces  ?? '0'}}</span>)<br />
                        Cost: $<span id="pack_cost_display">{{ number_format ($pack->visible_cost, 2) }}</span><br />
                        Item Count: <span id="pack_item_count_display">{{$pack->visible_item_count ?? '0'}}</span><br />
                        Likes: {{$pack->heart_count ?? '0' }}<br />

                    </p>

                </div>
            </div>
        </div>
    </div><br />

    @if ($pack->categories)
        @foreach ($pack->categories as $category)
            <div id="category-{{$category->id}}" class="card category-card">
                <input type="hidden" id="category_items_cost" value="{{$category->total_cost}}">
                <input type="hidden" id="category_items_weight" value="{{$category->total_ounces}}">
                <input type="hidden" id="category_include_in_base_weight" value="{{$category->include_in_base_weight}}">
                <input type="hidden" id="category_include_in_pack_weight" value="{{$category->include_in_pack_weight}}">
                <div class="card-header text-white bg-primary">
                    <div class="row">
                        <div class="col-12 col-md-8">

                            <h3>{{$category->name}}</h3>
                        </div>

                        <div class="col-12 col-md-4 text-md-right">
                            <span class="categoryOunces">{{$category->small_desired_weight_format ($pack_weight_units)}}</span> (<span class="convertOunces">{{$category->total_ounces}}</span>)<br />
                            $<span class="categoryCost">{{number_format ($category->total_cost, 2)}}</span>
                        </div>
                    </div>
                </div>
                <div id="sortable-{{$category->id}}" class="card-body sortable">
                    <div class="row">
                        <div class="col-12 text-right">
                            <button id="{{$category->id}}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addItemModal">Add Item</button>
                        </div>
                    </div>

                    <div class="row d-none d-md-flex">
                        <div class="col-1">

                        </div>
                        <div class="col-3">

                        </div>
                        <div class="col-2 text-center">
                            <p><b>Price</b> <i>(each)</i></p>
                        </div>
                        <div class="col-2 text-center">
                            <p><b>Weight</b> (each)</p>
                        </div>
                        <div class="col-1 text-center">
                            <p><b>Qty.</b></p>
                        </div>
                        <div class="col-3 text-center">

                        </div>
                    </div>
                    @if (count($category['items']) > 0)
                        @foreach ($category['items'] as $item)
                            <div id="item-{{$item->id}}" class="row view-pack-row sortableItem">
                                <input type="hidden" id="itemId" value="{{$item->id}}" />
                                <input type="hidden" id="itemCategoryId" value="{{$item->category_id}}" />
                                <input type="hidden" id="itemName" value="{{$item->name}}" />
                                <input type="hidden" id="itemDescription" value="{{$item->description}}" />
                                @if ($item->image)
                                    <input type="hidden" id="itemImage" value="{{Storage::url($item->image)}}?v=@php echo rand (0,100000000); @endphp" />
                                @else
                                    <input type="hidden" id="itemImage" value="" />
                                @endif
                                <input type="hidden" id="itemCost" value="{{$item->cost_each}}" />
                                <input type="hidden" id="itemWeight" value="{{$item->ounces_each}}" />
                                <input type="hidden" id="itemQuantity" value="{{$item->quantity}}" />

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-12 col-md-1 text-center">
                                    <div class="image-content">
                                        @if ($item->image)
                                            <img src="{{Storage::url ($item->image)}}?v=@php echo rand (0,100000000); @endphp" />
                                        @else
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(3.7815069787135234) translate(0 2.334503173828125)">
                                                    <path xmlns="http://www.w3.org/2000/svg" d="M64.571,0H12.118L0,19.388V72.02h76.689V19.387L64.571,0z M74.667,69.999H2.02V19.968L13.237,2.023h24.096v16.646H5.677  v2.021H71.01v-2.021H39.355V2.021H63.45l11.218,17.946L74.667,69.999L74.667,69.999z M24.344,37.333h28v2.021h-28V37.333z"></path>
                                                </g></svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <h3 class="display_name">{{$item->name}}</h3>
                                    <p class="display_description">{{substr($item->description, 0, 100)}} @if (strlen($item->description) > 100)... @endif </p>
                                </div>
                                <div class="col-12 col-md-2 text-left text-md-center">
                                    <p>$<span class="display_cost">{{number_format ($item->cost_each, 2)}}</span> <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></p>

                                </div>
                                <div class="col-12 col-md-2 text-left text-md-center">
                                    <p><span class="display_weight"> {{$item->small_desired_weight_format ($pack_weight_units)}}</span> <i>(<span class="convertOunces">{{$item->ounces_each ?? "0"}}</span>) <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></i></p>
                                </div>
                                <div class="col-12 col-md-1 text-left text-md-center">
                                    <p>x <span class="display_quantity">{{$item->quantity ?? "0"}}</span> <span class="d-inline-flex d-md-none font-weight-bold">(quantity)</span></p>
                                </div>
                                <div class="col-12 col-md-3 text-left text-md-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a id="editItemBtn-{{$item->id}}" href="#" class="btn btn-sm btn-primary editItemBtn" data-toggle="modal" data-target="#editItemModal">Edit</a>
                                        <a id="sortItemBtn-{{$item->id}}" href="#" class="btn btn-sm btn-primary sortableHandle">Move &#8597;</a>
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteItem-{{$item->id}}">Delete</a>
                                    </div>
                                </div>

                                <div class="modal" id="deleteItem-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteItem-{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Delete Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>Are you sure you would like to delete <b>{{$item->name}}</b>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No Cancel</button>
                                                <button id="confirmDeleteItemBtn-{{$item->id}}" type="button" class="btn btn-danger confirmDeleteItemBtn" data-dismiss="modal">Yes Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div><br />
        @endforeach
    @endif

    <div class="modal fade addItemModal" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="addItemPurchaseLink" value="" />
                    <div class="form-group">
                        <div id="addItemAutoCompleteWrapper">
                            <div class="ui-widget">
                                <label for="addItemName">Name</label>
                                <input name="addItemName" id="addItemName" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label><br />
                        <div class="upload-btn-wrapper">
                            <button class="btn btn-primary btn-sm">Upload</button>
                            <input id="addItemUploadImageBtn" type="file" name="image" />
                        </div>
                        <div id="uploadAddItemImageProgressBar" class="progress" style="display: none;margin-top: 10px;">
                            <div class="progress-bar progress-bar-animated progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <input type="hidden" name="add-item-asset-image" id="add-item-asset-image" value="" />
                        <div class="image-content">
                            <img src="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="addItemCategory">Category</label>
                        <select class="form-control" name="addItemCategory" id="addItemCategory">
                            @if ($pack->categories)
                                @foreach ($pack->categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="addItemPrice">Price</label>
                        <input type="number" step="any" name="addItemPrice" id="addItemPrice" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="addItemQuantity">Quantity</label>
                        <input type="tel" name="addItemQuantity" id="addItemQuantity" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="addItemWeight">Weight (in ounces)</label>
                        <input type="number" step="any" name="addItemWeight" id="addItemWeight" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="addItemDescription">Description</label>
                        <textarea name="addItemDescription" id="addItemDescription" class="form-control" rows="7"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <p id="addItemErrorMessage" class="text-danger d-none">Name is required.</p>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button id="addItemBtn" type="button" class="btn btn-primary">Save</button>
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade editItemModal" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModal" aria-hidden="true">
        <input type="hidden" id="edit_item_id" value="">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editItemName">Name</label>
                        <input name="editItemName" id="editItemName" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label><br />
                        <div class="upload-btn-wrapper">
                            <button class="btn btn-primary btn-sm">Upload</button>
                            <input id="editItemUploadImageBtn" type="file" name="image" />
                        </div>
                        <div id="uploadEditItemImageProgressBar" class="progress" style="display: none;margin-top: 10px;">

                            <div class="progress-bar progress-bar-animated progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <input type="hidden" name="edit-item-asset-image" id="edit-item-asset-image" value="" />
                        <div class="image-content">
                            <img src="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editItemCategory">Category</label>
                        <select class="form-control" name="editItemCategory" id="editItemCategory">
                            @if ($pack->categories)
                                @foreach ($pack->categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editItemPrice">Price</label>
                        <input type="number" step="any" name="editItemPrice" id="editItemPrice" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="editItemQuantity">Quantity</label>
                        <input type="tel" name="editItemQuantity" id="editItemQuantity" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="editItemWeight">Weight (in ounces)</label>
                        <input type="number" step="any" name="editItemWeight" id="editItemWeight" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="editItemDescription">Description</label>
                        <textarea name="editItemDescription" id="editItemDescription" class="form-control" rows="7"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <p id="addItemErrorMessage" class="text-danger d-none">Name is required.</p>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button id="editItemSaveBtn" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    @guest
        <div class="modal fade loginModal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="loginEmail">Email</label>
                            <input type="text" id="loginEmail" name="loginEmail" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" name="loginPassword" id="loginPassword" class="form-control" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p id="loginErrorMessage" class="text-danger d-none">Invalid login.</p>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button id="loginBtn" type="button" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade registerModal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Create Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="loginEmail">Trail Name</label>
                            <input type="text" id="registerName" name="registerName" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="loginEmail">Email</label>
                            <input type="text" id="registerEmail" name="registerEmail" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" name="registerPassword" id="registerPassword" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" name="registerPasswordConfirmation" id="registerPasswordConfirmation" class="form-control" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p id="registerErrorMessage" class="text-danger d-none"></p>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button id="registerBtn" type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection
@section('script')

    <script src="/js/ui.js"></script>
    <script>
        var xhr = false;

        window.onload = function () {

            $('[data-toggle="popover"]').popover();

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            $('#addItemName').autocomplete({
                appendTo: "#addItemAutoCompleteWrapper",
                source: '{{route ('api.user.pack_auto_completes.index')}}',
                select: function( event, ui ) {

                    var url = '{{route ('api.user.pack_auto_completes.show', ['id' => 123])}}';
                    url = url.replace ('123', ui.item.id);

                    $.get (url, function (data) {

                        obj = eval('(' + data + ')');
                        $('#addItemPrice').val (parseFloat (obj.price).toFixed(2));
                        $('#addItemWeight').val (obj.ounces);
                        $('#addItemQuantity').val ('1');
                        $('#addItemDescription').val (obj.description);
                        $('#addItemPurchaseLink').val (obj.purchase_link);

                        if (obj.image)
                        {
                            $('#add-item-asset-image').val (obj.image_asset);
                            $('#addItemUploadImageBtn').parent ().parent ().find ('.image-content').html ('<img src="'+obj.image+'" />');
                            $('#addItemUploadImageBtn').parent ().parent ().find ('.image-content').show ();
                        }
                        else
                        {
                            $('#add-item-asset-image').val ('');
                            $('#addItemUploadImageBtn').parent ().parent ().find ('.image-content').html ('<img src="" />');
                            $('#addItemUploadImageBtn').parent ().parent ().find ('.image-content').hide ();
                        }

                    });
                }
            });

            ouncesConvertToPretty ('{{$pack_weight_units}}');

            $('.sortable').sortable({
                connectWith: ".sortable",
                handle: ".sortableHandle",
                items: '.sortableItem',
                stop: function( event, ui ) {

                    let categories = [];
                    let items = [];

                    let split_id = false;
                    let category_id = false;
                    let item_id = false;


                    $('.category-card').each (function () {
                        split_id =  $(this).attr ('id').split ('-');
                        category_id = split_id[1];

                        items = [];
                        $(this).find('.view-pack-row').each (function () {
                            split_id =  $(this).attr ('id').split ('-');
                            item_id = split_id[1];
                            items.push (item_id);
                        });

                        categories[category_id] = items;
                    });

                    $.post ('{{route ('api.user.pack_items_sort.store')}}', {
                        'pack_id': $('#id').val (),
                        'categories': categories
                    });

                    updateWeightDisplay ();

                },
                receive: function( event, ui ) {
                    let split_id = false;
                    let category_id = false;
                    let item_id = false;

                    split_id = $(event.target).attr ('id').split ('-');
                    category_id = split_id[1];

                    split_id = $(ui.item).attr ('id').split ('-');
                    item_id = split_id[1];

                    $('#item-'+item_id + ' #itemCategoryId').val (category_id);

                    updateWeightDisplay ();
                }
            }).disableSelection();

            $('#addItemModal').on('show.bs.modal', function (e) {

                $('#addItemName').val ('');
                $('#addItemPrice').val ('');
                $('#addItemQuantity').val ('');
                $('#addItemWeight').val ('');
                $('#addItemDescription').val ('');
                $('#addItemModal .image-content').hide ();
                $('#addItemModal .image-content img').attr ('src', '');
                $('#addItemPurchaseLink').val ('');
                $('#add-item-asset-image').val ('');

                let buttonCategoryId = $(e.relatedTarget).attr ('id');

                $("#addItemCategory > option").each(function() {
                    if (buttonCategoryId == this.value)
                        $(this).prop("selected","selected").change();
                    else
                        $(this).prop("selected",false);
                });

            });

            $('#addItemBtn').click (function () {

                let pack_id = $('#id').val ();
                let name = $('#addItemName').val ();
                let categoryid = $('#addItemCategory').val ();
                let price = $('#addItemPrice').val ();
                let quantity = $('#addItemQuantity').val ();
                let weight = $('#addItemWeight').val ();
                let description = $('#addItemDescription').val ();
                let purchase_link = $('#addItemPurchaseLink').val ();
                let image = $('#add-item-asset-image').val ();

                if (!name)
                {
                   $('#addItemErrorMessage').removeClass('d-none');
                   return;
                }

                $.post ('{{route ('api.user.pack_items.store')}}', {
                    'pack_id': pack_id,
                    'name' : name,
                    'category_id': categoryid,
                    'cost_each': price,
                    'quantity': quantity,
                    'ounces_each': weight,
                    'description': description,
                    'image': image,
                    'purchase_link': purchase_link
                }, function (data) {

                    obj = eval('(' + data + ')');

                    var itemId = obj.id;
                    var image_url = obj.image;

                    if (!quantity)
                        quantity = '1';
                    if (!weight)
                        weight = '0';
                    if (!price)
                        price = '0';

                    if (image)
                    {
                        image = image_url;
                    }

                    price = parseFloat (price).toFixed(2);

                    var html = '<div id="item-'+itemId+'" class="row view-pack-row sortableItem">\n' +
                        '                                <input type="hidden" id="itemId" value="'+itemId+'" />\n' +
                        '                                <input type="hidden" id="itemCategoryId" value="'+categoryid+'" />\n' +
                        '                                <input type="hidden" id="itemName" value="'+name+'" />\n' +
                        '                                <input type="hidden" id="itemDescription" value="'+description+'" />\n' +
                        '                                <input type="hidden" id="itemImage" value="'+image+'" />\n' +
                        '                                <input type="hidden" id="itemCost" value="'+price+'" />\n' +
                        '                                <input type="hidden" id="itemWeight" value="'+weight+'" />\n' +
                        '                                <input type="hidden" id="itemQuantity" value="'+quantity+'" />\n' +
                        '\n' +
                        '                                <div class="col-12">\n' +
                        '                                    <hr />\n' +
                        '                                </div>\n' +
                        '\n' +
                        '                                <div class="col-12 col-md-1 text-center">\n' +
                        '                                    <div class="image-content">\n';
                    if (image)
                        html += '<img src="'+image+'" />\n';
                    else
                        html += '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(3.7815069787135234) translate(0 2.334503173828125)">\n' +
                            '<path xmlns="http://www.w3.org/2000/svg" d="M64.571,0H12.118L0,19.388V72.02h76.689V19.387L64.571,0z M74.667,69.999H2.02V19.968L13.237,2.023h24.096v16.646H5.677  v2.021H71.01v-2.021H39.355V2.021H63.45l11.218,17.946L74.667,69.999L74.667,69.999z M24.344,37.333h28v2.021h-28V37.333z"></path>\n' +
                            '</g></svg>\n';

                    html += '</div>\n' +
                        '                                </div>\n' +
                        '                                <div class="col-12 col-md-3">\n' +
                        '                                    <h3 class="display_name">'+name+'</h3>\n' +
                        '                                    <p class="display_description">'+description+'</p>\n' +
                        '                                </div>\n' +
                        '                                <div class="col-12 col-md-2 text-left text-md-center">\n' +
                        '                                    <p>$<span class="display_cost">'+parseFloat(price).toFixed(2)+'</span> <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></p>\n' +
                        '\n' +
                        '                                </div>\n' +
                        '                                <div class="col-12 col-md-2 text-left text-md-center">\n' +
                        '                                    <p><span class="display_weight"> '+getSmallConvertToPretty(weight)+'</span> oz. <i>(<span class="convertOunces">'+weight+'</span>) <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></i></p>\n' +
                        '                                </div>\n' +
                        '                                <div class="col-12 col-md-1 text-left text-md-center">\n' +
                        '                                    <p>x <span class="display_quantity">'+quantity+'</span> <span class="d-inline-flex d-md-none font-weight-bold">(quantity)</span></p>\n' +
                        '                                </div>\n' +
                        '                                <div class="col-12 col-md-3 text-left text-md-right">\n' +
                        '                                    <div class="btn-group" role="group" aria-label="Basic example">\n' +
                        '                                        <a id="editItemBtn-'+itemId+'" href="#" class="btn btn-sm btn-primary editItemBtn" data-toggle="modal" data-target="#editItemModal">Edit</a>\n' +
                        '                                        <a id="sortItemBtn-'+itemId+'" href="#" class="btn btn-sm btn-primary sortableHandle">Move &#8597;</a>\n' +
                        '                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteItem-'+itemId+'">Delete</a>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '\n' +
                        '                                <div class="modal" id="deleteItem-'+itemId+'" tabindex="-1" role="dialog" aria-labelledby="deleteItem-'+itemId+'" aria-hidden="true">\n' +
                        '                                    <div class="modal-dialog modal-dialog-scrollable" role="document">\n' +
                        '                                        <div class="modal-content">\n' +
                        '                                            <div class="modal-header bg-primary text-white">\n' +
                        '                                                <h5 class="modal-title">Delete Item</h5>\n' +
                        '                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +
                        '                                                    <span aria-hidden="true">&times;</span>\n' +
                        '                                                </button>\n' +
                        '                                            </div>\n' +
                        '                                            <div class="modal-body text-center">\n' +
                        '                                                <p>Are you sure you would like to delete <b>'+name+'</b>?</p>\n' +
                        '                                            </div>\n' +
                        '                                            <div class="modal-footer">\n' +
                        '                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No Cancel</button>\n' +
                        '                                                <button id="confirmDeleteItemBtn-'+itemId+'" type="button" class="btn btn-danger confirmDeleteItemBtn" data-dismiss="modal">Yes Delete</button>\n' +
                        '                                            </div>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>';

                    $('#category-'+categoryid+ ' .card-body').append (html);
                    setItemsFunctions ();
                    updateWeightDisplay ();

                    ouncesConvertToPretty ('{{$pack_weight_units}}');
                });

                $('#addItemModal').modal('hide');
                $('#addItemErrorMessage').addClass('d-none');

            });

            $('#editItemSaveBtn').click (function () {

                let item_id = $('#edit_item_id').val ();
                let pack_id = $('#id').val ();
                let name = $('#editItemName').val ();
                let categoryid = $('#editItemCategory').val ();
                let price = $('#editItemPrice').val ();
                let quantity = $('#editItemQuantity').val ();
                let weight = $('#editItemWeight').val ();
                let description = $('#editItemDescription').val ();
                let image = $('#edit-item-asset-image').val ();

                if (!name)
                {
                    $('#editItemErrorMessage').removeClass('d-none');
                    return;
                }

                var url = '{{route ('api.user.pack_items.update', ['id' => 123])}}';
                url = url.replace ('123', item_id);

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {
                        'item_id': item_id,
                        'pack_id': pack_id,
                        'name' : name,
                        'category_id': categoryid,
                        'cost_each': price,
                        'quantity': quantity,
                        'ounces_each': weight,
                        'description': description,
                        'image': image
                    },
                    success: function(data) {
                        obj = eval('(' + data + ')');

                        var itemId = obj.id;
                        var image_url = obj.image;

                        if (categoryid != $('#item-'+itemId + ' #itemCategoryId').val ())
                        {
                            copiedItem = $('#item-'+itemId).clone();
                            $('#item-'+itemId).remove();
                            $("#sortable-"+categoryid).append(copiedItem);
                        }

                        $('#item-'+itemId + ' #itemName').val (name);
                        $('#item-'+itemId + ' #itemDescription').val (description);
                        $('#item-'+itemId + ' #itemCost').val (price);
                        $('#item-'+itemId + ' #itemWeight').val (weight);
                        $('#item-'+itemId + ' #itemQuantity').val (quantity);
                        //$('#item-'+itemId + ' #itemImage').val ('');
                        $('#item-'+itemId + ' #itemCategoryId').val (categoryid);

                        $('#item-'+itemId + ' .display_name').html (name);
                        $('#item-'+itemId + ' .display_cost').html (parseFloat (price).toFixed(2));
                        $('#item-'+itemId + ' .display_weight').html (getSmallConvertToPretty(weight));
                        $('#item-'+itemId + ' .convertOunces').html (weight);
                        $('#item-'+itemId + ' .display_quantity').html (quantity);
                        $('#item-'+itemId + ' .display_description').html (description);

                        if (image)
                        {
                            image = image_url;

                            $('#item-'+itemId + ' .image-content').html ('<img src="'+image + '?v=' + Math.random() + '" />');
                            $('#item-'+itemId + ' #itemImage').val (image + '?v=' + Math.random());
                        }

                        updateWeightDisplay ();

                        ouncesConvertToPretty ('{{$pack_weight_units}}');
                    }
                });

                $('#editItemModal').modal('hide');
                $('#editItemErrorMessage').addClass('d-none');


            });

            $('#addItemUploadImageBtn').fileupload({
                url: '{{route ('api.public.image.store')}}',
                dataType: 'json',
                add: function (e, data) {
                    var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
                    if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                        alert('File type not supported');
                        return;
                    }
                    data.submit();
                },
                done: function (e, data) {

                    let image = data.result.image;

                    $('#uploadAddItemImageProgressBar').hide ();
                    $(this).parent ().parent ().parent ().find ('.image-content').html ('<img src="'+image.url+'?v=' + Math.random()+'" />');
                    $(this).parent ().parent ().parent ().find ('.image-content').show ();

                    $('#add-item-asset-image').val (image.asset_name);
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#uploadAddItemImageProgressBar').show ();
                    $('#uploadAddItemImageProgressBar .progress-bar').css ('width', progress+'%');
                }
            });

            $('#editItemUploadImageBtn').fileupload({
                url: '{{route ('api.public.image.store')}}',
                dataType: 'json',
                add: function (e, data) {
                    var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
                    if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                        alert('File type not supported');
                        return;
                    }
                    data.submit();
                },
                done: function (e, data) {

                    let image = data.result.image;

                    $('#uploadEditItemImageProgressBar').hide ();
                    $(this).parent ().parent ().parent ().find ('.image-content').html ('<img src="'+image.url+'" />');
                    $(this).parent ().parent ().parent ().find ('.image-content').show ();

                    $('#edit-item-asset-image').val (image.asset_name);
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#uploadEditItemImageProgressBar').show ();
                    $('#uploadEditItemImageProgressBar .progress-bar').css ('width', progress+'%');
                }
            });

            $('#uploadPackImageBtn').fileupload({
                url: '{{route ('api.public.image.store')}}',
                dataType: 'json',
                add: function (e, data) {
                    console.log ('dsf');
                    var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
                    if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                        alert('File type not supported');
                        return;
                    }
                    data.submit();
                },
                done: function (e, data) {
                    console.log ('dsf');
                    let image = data.result.image;

                    $(this).parent ().parent ().parent ().find ('.image-content').html ('<img src="'+image.url + '?v=' + Math.random() + '" />');

                    $('#uploadPackImageProgressBar').hide ();

                    $('#pack-asset-image').val (image.asset_name);

                    updateGeneralData ();
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#uploadPackImageProgressBar').show ();
                    $('#uploadPackImageProgressBar .progress-bar').css ('width', progress+'%');
                }
            });

            $('#visible').change (function () {
                updateGeneralData ();
            });

            $('#season_id').change (function () {
                updateGeneralData ();
            });

            $('#name').keyup (function () {
                updateGeneralData ();
            });

            $('#confirmDeletePackBtn').click (function () {
                $.ajax({
                    url: '{{route ('api.user.packs.destroy', ['pack' => $pack->id]  )}}',
                    type: 'DELETE',
                    success: function(result) {
                        window.location = '{{route ('user.packs.index')}}';
                    }
                });
            });

            $('#visible').change (function () {
                if ($(this).val () == '1')
                    $('#pack-is-hidden-alert').hide ();
                else
                    $('#pack-is-hidden-alert').show ();
            });

            $('#loginBtn').click (function () {
                $.post ('{{route ('api.public.login')}}', {
                    'email': $('#loginEmail').val (),
                    'password': $('#loginPassword').val ()
                }, function (data) {

                    if (data.message == 'Authorized')
                    {
                        $.ajax({
                            url: '{{route ('api.user.packs.update', ['pack' => $pack->id])}}',
                            type: 'PUT',
                            data: {
                                'user_id': data.user_id
                            },
                            success: function() {
                                location.reload();
                            }
                        });
                    }
                    else
                    {
                        $('#loginErrorMessage').removeClass('d-none');
                    }
                }).fail(function() {
                    $('#loginErrorMessage').removeClass('d-none');
                });
            });

            $('#registerBtn').click (function () {
                $.post ('{{route ('api.public.register')}}', {
                    'session_id': '{{Session::getId()}}',
                    'name': $('#registerName').val (),
                    'email': $('#registerEmail').val (),
                    'password': $('#registerPassword').val (),
                    'confirm_password': $('#registerPasswordConfirmation').val (),
                }, function (data) {

                    if (data.message == 'Error')
                    {
                        $('#registerErrorMessage').removeClass('d-none').html (data.error);
                    }
                    else
                    {
                        location.reload();
                    }
                }).fail(function() {
                    $('#registerErrorMessage').removeClass('d-none').html ('Error, something went wrong.');
                });
            });

            setItemsFunctions ();

            updateWeightDisplay ();
        }

        function ouncesConvertToPretty (convertTo)
        {
            if (convertTo == 'metric')
            {
                $('.convertOunces').each (function () {

                    var n = $(this).text ().indexOf("kg");

                    if (n == -1)
                    {
                        var ounces = parseInt($(this).text ());
                        $(this).text ((ounces / 35.27).toFixed (1) + ' kg.');
                    }

                });
            }
            else if (convertTo == 'imperial')
            {
                $('.convertOunces').each (function () {

                    var n = $(this).text ().indexOf("lb");

                    if (n == -1)
                    {
                        var ounces = parseInt($(this).text ());
                        $(this).text ((ounces / 16).toFixed (1) + ' lb.');
                    }

                });
            }
        }

        function ouncesConvertToPrettySingle (element, convertTo)
        {
            var n = element.text ().indexOf("lb");

            if (convertTo == 'metric')
            {
                var ounces = parseInt(element.text ());
                element.text ((ounces / 35.27).toFixed (1) + ' kg.');
            }
            else if (convertTo == 'imperial')
            {
                var ounces = parseInt(element.text ());
                element.text ((ounces / 16).toFixed (1) + ' lb.');
            }
        }

        function getSmallConvertToPretty (ounces)
        {
            var convertToUnits = '{{$pack_weight_units}}';

            if (convertToUnits == 'imperial')
            {
                return parseInt(ounces).toFixed (1) + ' oz.';
            }
            else if (convertToUnits == 'metric')
            {
                var intOunces = parseInt(ounces);
                return (intOunces * 28).toFixed (0) + ' g.';
            }
        }

        function setItemsFunctions ()
        {
            $('.confirmDeleteItemBtn').unbind ().click (function () {
                var splitNameId = $(this).attr ('id').split ('-');
                var id = splitNameId[1];

                $('#deleteItem-'+id).modal('hide');

                var url = '{{route ('api.user.pack_items.destroy', ['id' => 123])}}';
                url = url.replace ('123', id);

                xhr = $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function() {
                        $('#item-'+id).remove ();
                        updateWeightDisplay ();
                    }
                });
            });

            $('.editItemBtn').unbind ().click (function () {
                var splitNameId = $(this).attr ('id').split ('-');
                var id = splitNameId[1];

                $('#editItemModal').modal('show');

                $('#editItemModal .image-content').hide ();
                $('#edit-item-asset-image').val ('');

                $('#edit_item_id').val (id);
                $('#editItemName').val ($('#item-'+id + ' #itemName').val ());
                $('#editItemDescription').val ($('#item-'+id + ' #itemDescription').val ());
                $('#editItemPrice').val ($('#item-'+id + ' #itemCost').val ());
                $('#editItemWeight').val ($('#item-'+id + ' #itemWeight').val ());
                $('#editItemQuantity').val ($('#item-'+id + ' #itemQuantity').val ());

                if ($('#item-'+id + ' #itemImage').val ())
                {
                    $('#editItemModal .image-content').show ();
                    $('#editItemModal .image-content img').attr ('src', $('#item-'+id + ' #itemImage').val ());
                }

                $("#editItemCategory > option").each(function() {

                    if ($('#item-'+id + ' #itemCategoryId').val () == this.value)
                        $(this).prop("selected","selected").change();
                    else
                        $(this).prop("selected",false);
                });

            });

            $('.sortableHandle').unbind ().click (function (e) {
                e.preventDefault ();
            });

        }

        function updateGeneralData ()
        {
            if (xhr)
                xhr.abort ();

            xhr = $.ajax({
                url: '{{route ('api.user.packs.update', ['pack' => $pack->id])}}',
                type: 'PUT',
                data: {
                    'name': $('#name').val (),
                    'is_visible': $('#visible').val (),
                    'season_id': $('#season_id').val (),
                    'image': $('#pack-asset-image').val ()
                },
                success: function() {
                    xhr = false;

                    $('.saved-badge').show ();
                    setTimeout ("$('.saved-badge').hide ();", 1000);
                    $('#pack-asset-image').val ('');
                }
            });


        }

        function updateWeightDisplay ()
        {

            var total_base_weight = 0;
            var total_pack_weight = 0;
            var total_weight = 0;
            var total_item_count = 0;

            var total_base_weight_cost = 0;
            var total_pack_weight_cost = 0;
            var total_cost = 0;

            var itemCost = 0;
            var itemWeight = 0;
            var itemQuantity = 0;

            var include_in_base_weight = false;
            var include_in_pack_weight = false;
            var category_total_cost = 0;
            var category_total_weight = 0;

            $('.category-card').each (function () {

                category_total_cost = 0;
                category_total_weight = 0;

                include_in_base_weight = false;
                if ($(this).find ('#category_include_in_base_weight').val () == '1')
                    include_in_base_weight = true;

                include_in_pack_weight = false;
                if ($(this).find ('#category_include_in_pack_weight').val () == '1')
                    include_in_pack_weight = true;

                $(this).find('.view-pack-row').each (function () {

                    itemCost = $(this).find ('#itemCost').val ();
                    if (!itemCost) itemCost = '0';
                    itemWeight = $(this).find ('#itemWeight').val ();
                    if (!itemWeight) itemWeight = '0';
                    itemQuantity = $(this).find ('#itemQuantity').val ();
                    if (!itemQuantity) itemQuantity = '0';

                    category_total_cost += parseFloat (itemCost) * parseFloat (itemQuantity);
                    category_total_weight += parseFloat (itemWeight) * parseFloat (itemQuantity);

                    //$(this).find ('.convertOunces').html (itemWeight);

                    total_item_count++;

                    //ouncesConvertToPrettySingle ($(this).find ('.convertOunces'), '{{$pack_weight_units}}');
                });

                if (include_in_base_weight)
                {
                    total_base_weight += category_total_weight;
                    total_base_weight_cost += category_total_cost;
                }

                if (include_in_pack_weight)
                {
                    total_pack_weight += category_total_weight;
                    total_pack_weight_cost += category_total_cost;
                }

                total_weight += category_total_weight;
                total_cost += category_total_cost;




            });

            category_total_weight = parseFloat (category_total_weight).toFixed(1);
            category_total_cost = parseFloat (category_total_cost).toFixed(2);
            total_base_weight = parseFloat (total_base_weight).toFixed(1);
            total_pack_weight = parseFloat (total_pack_weight).toFixed(1);
            total_weight = parseFloat (total_weight).toFixed(1);
            total_cost = parseFloat (total_cost).toFixed(2);

            $(this).find ('.categoryOunces').html (getSmallConvertToPretty(category_total_weight));
            $(this).find ('.card-header').find ('.convertOunces').html (category_total_weight);
            $(this).find ('.categoryCost').html (category_total_cost);

            ouncesConvertToPrettySingle ($(this).find ('.card-header').find ('.convertOunces'), '{{$pack_weight_units}}');

            $('#pack_base_weight_ounces_display').html (getSmallConvertToPretty(total_base_weight));
            $('#pack_base_weight_pretty_display').html (total_base_weight);
            ouncesConvertToPrettySingle ($('#pack_base_weight_pretty_display'), '{{$pack_weight_units}}');

            $('#pack_total_weight_ounces_display').html (getSmallConvertToPretty(total_pack_weight));
            $('#pack_total_weight_pretty_display').html (total_pack_weight);
            ouncesConvertToPrettySingle ($('#pack_total_weight_pretty_display'), '{{$pack_weight_units}}');

            $('#pack_skin_out_weight_ounces_display').html (getSmallConvertToPretty(total_weight));
            $('#pack_skin_out_weight_pretty_display').html (total_weight);
            ouncesConvertToPrettySingle ($('#pack_skin_out_weight_pretty_display'), '{{$pack_weight_units}}');

            $('#pack_cost_display').html (total_cost);
            $('#pack_item_count_display').html (total_item_count);
        }

    </script>
@endsection