@extends('share.dashboardLayout')
@section("taskTitle", "Trashed Products")
@section("taskTrashProductActive", "page-active-dasboard")
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
                                <th>CODE</th>
                                <th>PRODUCT NAME</th>
                                <th>CATEGORY</th>
                                <th>BRAND</th>
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
                                        <td>{{ $product->brand }}</td>
                                        <td>{{ number_format($product->original_price, 2) }}</td>
                                        <td>{!! ($product->is_online ? '<span class="text-success">Online</span>' : '<span class="text-danger">Offline</span>') !!}</td>
                                        <td>
                                            <a href="{{ Route::has('productDetails') ? Route('productDetails', ['id'=>$product->productID]) : 'javascript:;' }}" class="btn btn-success" title="View product details"><span class="fa fa-eye"></span></a>
                                            @if(Auth::check() && (Auth::user()->id == $product->userID))
                                                <a href="{{ Route::has('restoreProduct') ? Route('restoreProduct', ['id'=>$product->productID]) : 'javascript:;' }}" class="btn btn-warning" title="Restore Product"><span class="fa fa-refresh"></span></a>
                                                <a href="javascript:;" class="btn btn-danger" title="Delete product" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal{{$key}}"><span class="fa fa-trash"></span></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @includeIf('share.deleteConfirmationPopupModal',['deleteKey'=>'deleteConfirmModal'.$key, 'deleteMessage'=>'You are about to delete this record permanently. Are you sure you want to continue?', 'deleteRoute'=>'deleteProductTotally', 'parameter'=>$product->productID])
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
