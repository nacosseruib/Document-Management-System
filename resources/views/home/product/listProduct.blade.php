@extends('share.dashboardLayout')
@section("taskTitle", "My Advert")
@section("taskAllProductActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}

                <div class="table-responsive">
                    <table class="table table-hover table-responsive table-condensed">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>PRODUCT ID</th>
                                <th>PRODUCT NAME</th>
                                <th>CATEGORY</th>
                                <th>MAKER</th>
                                <th>PRICE</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($allProducts) && $allProducts)
                                @foreach ($allProducts as $key=>$product)
                                    <tr>
                                        <td>{{ ($allProducts->currentpage()-1) * $allProducts->perpage() + (1+$key) }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->category_name }}</td>
                                        <td>{{ $product->vehicle_maker }}</td>
                                        <td>{{ number_format($product->display_price, 2) }}</td>
                                        <td>{!! ($product->is_online ? '<span class="text-success">Online</span>' : '<span class="text-danger">Offline</span>') !!}</td>
                                        <td>
                                            <a href="{{ Route::has('productDetails') ? Route('productDetails', ['pid'=>$product->productID]) : 'javascript:;' }}" class="btn btn-success" title="View product details"><span class="fa fa-eye"></span></a>
                                            @if(Auth::check() && (Auth::user()->id == $product->userID))
                                                <a href="{{ Route::has('editProduct') ? Route('editProduct', ['id'=>$product->productID]) : 'javascript:;' }}" class="btn btn-info" title="Edit product"><span class="fa fa-edit"></span></a>
                                                <a href="javascript:;" class="btn btn-danger" title="Delete product" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal{{$key}}"><span class="fa fa-trash"></span></a>
                                            @endif
                                            {{-- <a href="#" class="btn btn-warning" title="Suspend this product"><span class="fa fa-pause"></span></a>
                                            @if(Auth::check() && (Auth::user()->user_role == 1 || Auth::user()->user_role == 2))
                                                <a href="#" class="btn btn-warning" title="Block or Suspend this product"><span class="fa fa-lock"></span></a>
                                            @endif --}}
                                        </td>
                                    </tr>
                                    @includeIf('share.deleteConfirmationPopupModal',['deleteKey'=>'deleteConfirmModal'.$key, 'deleteMessage'=>'Your record will be moved to trash. You can recover this product from trash', 'deleteRoute'=>'deleteProduct', 'parameter'=>$product->productID])
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div align="right" class="col-md-12 m-1 p-1">
                            <hr />
                            @if(isset($allProducts))
                                Showing {{($allProducts->currentpage()-1)*$allProducts->perpage()+1}}
                                to {{$allProducts->currentpage()*$allProducts->perpage()}}
                                of  {{$allProducts->total()}} entries
                                <div class="hidden-print pull-left">{{ $allProducts->links() }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

@endsection
