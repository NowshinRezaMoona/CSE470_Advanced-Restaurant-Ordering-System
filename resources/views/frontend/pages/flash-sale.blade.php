@extends('frontend.layouts.master')

@section('content')
    <!--============================
            BREADCRUMB START
        ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Offer Details</h4>
                        <ul>
                            <li><a href="#">daily deals</a></li>
                            <li><a href="#">offer details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
            BREADCRUMB END
        ==============================-->


    <!--============================
            DAILY DEALS DETAILS START
        ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">

                       
                    </div>
                    
                    </div>
                </div>

                

                <div class="row">
                    @foreach ($flashSaleItems as $item)
                    @php
                        $product=\App\Models\Product::find($item->product_id);
                    @endphp
                    <div class="col-xl-3 col-sm-6 col-lg-4">
                                       
                        
                        <div class="wsus__product_item">
                            <span class="wsus__new">{{ productType($product->product_type) }}</span>
                            @if(checkDiscount($product))
                            <span class="wsus__minus">{{ calculateDiscountPercent($product->price,$product->offer_price) }}%</span>
                            @endif
                            <a class="wsus__pro_link" href="product_details.html">
                                <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1" />
                                <img src="
                                @if(isset($product->productImageGalleries[0]->image))
                                   {{ asset($product->productImageGalleries[0]->image) }}
                                @else
                                   {{ asset($product->thumb_image) }}
                                @endif
                                " alt="product" class="img-fluid w-100 img_2" />
                            </a>
                            <ul class="wsus__single_pro_icon">
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="far fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-random"></i></a>
                            </ul>
                            <div class="wsus__product_details">
                                <a class="wsus__category" href="#">{{ $product->category->name }}</a>
                                <p class="wsus__pro_rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>(no review)</span>
                                </p>
                                <a class="wsus__pro_name" href="#">{{ $product->name }}</a>
                                @if(checkDiscount($product))
        
                                    <p class="wsus__price">${{ $product->offer_price }}<del>${{ $product->price }}</del></p>
                                @else
                                    <p class="wsus__price">{{ $product->price }}</p>
                                @endif
        
        
                                <a class="add_cart" href="#">add to cart</a>
                            </div>
                        </div>             
                    </div>
                    @endforeach

                </div>
                <div class="mt-5">
                    @if($flashSaleItems->hasPages())
                       {{ $flashSaleItems->links() }}
                    @endif()
                </div>
            </div>
        </div>
    </section>
    <!--============================
            DAILY DEALS DETAILS END
        ==============================-->
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="path/to/simplyCountdown.js"></script>

<div class="simply-countdown-one"></div>

<script>
    $(document).ready(function() {
        @if(isset($flashSaleDate) && isset($flashSaleDate->end_date))
            var countdownDate = {
                year: {{ date('Y', strtotime($flashSaleDate->end_date)) }},
                month: {{ date('m', strtotime($flashSaleDate->end_date)) }},
                day: {{ date('d', strtotime($flashSaleDate->end_date)) }},
            };
            console.log(countdownDate); // Log the date values
            simplyCountdown('.simply-countdown-one', countdownDate);
        @else
            console.error('Flash sale date is not defined.');
        @endif
    });
</script>
@endpush