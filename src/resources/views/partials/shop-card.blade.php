<div class="shop-card"
    data-area-id="{{ $shop->area->id }}"
    data-genre-id="{{ $shop->genre->id }}"
    data-rating="{{ $shop->average_rating ?? 0 }}">
    <form class="shop-card__form" action="/detail/{{ $shop->id }}" method="get">
        @csrf
        <div class="shop-card__img">
            <img class="shop-card__img" src="{{ asset($shop->image) }}" alt="{{ $shop->shop_name }}">
        </div>
        <div class="shop-card__txt">
            <div class="shop-card__rated-flex">
                <h3 class="shop-card__shop-name">{{ $shop->shop_name }}</h3>
                @if(!Request::is('evaluation/editing/*','mypage'))

                @if(isset($shop->average_rating))
                <p class="shop-card__rating">
                    <span class="rating-star">★</span>{{ $shop->average_rating }}
                </p>
                @else
                <p class="shop-card__rating">★0.00</p>
                @endif

                @endif
            </div>
            <div class="shop-card__txt-flex">
                <p class="shop-card__area">#{{ $shop->area->area_name }}</p>
                <p class="shop-card_genre">#{{ $shop->genre->genre_name }}</p>
            </div>
            <div class="shop-card__btn">
                <button class="btn-submit" type="submit">詳しくみる</button>
                @if(!Request::is('admin/*'))
                <button>
                    <svg class="favorite-btn {{ in_array($shop->id, $favoriteShopIds) ? 'favorited' : '' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-id="{{ $shop->id }}">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </form>
</div>