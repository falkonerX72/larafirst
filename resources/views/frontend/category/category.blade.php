@extends('frontend.frontend_dashboard')
@section('main')
    <section class="category-section category-page centred mr-0 pt-120 pb-90">
        <div class="auto-container">
            <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <ul class="category-list clearfix">
                    @foreach ($allcategory as $category)
                        <li>
                            <div class="category-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="{{ $category->type_icon }}"></i></div>
                                    <h5><a href="{{ route('property.type', $category->id) }}">{{ $category->type_name }}</a>
                                    </h5>
                                    <span>52</span>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </section>
@endsection
