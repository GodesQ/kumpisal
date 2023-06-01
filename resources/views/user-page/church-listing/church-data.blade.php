<div class="area-places">
    @forelse ($churches as $church)
        <div class="place-item layout-02 place-hover" data-maps_name="mattone_restaurant">
            <div class="place-inner">
                <div class="place-thumb">
                    <a class="entry-thumb" href="{{ route('churches.detailPage', ['uuid' => $church->church_uuid, 'name' => $church->name]) }}"><img src="{{ asset('admin-assets/images/churches' . '/' . $church->church_image )}}"
                            alt=""></a>
                    {{-- <a href="#" class="golo-add-to-wishlist btn-add-to-wishlist "
                        data-place-id="185">
                        <span class="icon-heart">
                            <i class="la la-bookmark large"></i>
                        </span>
                    </a> --}}
                </div>
                <div class="entry-detail">
                    <div class="entry-head">
                        <div class="place-type list-item">
                            {{ Str::ucfirst($church->criteria) }}
                        </div>
                        @if(isset($church->distance))
                            <div class="place-city">
                                <a href="#">{{ number_format($church->distance, 2) }} km</a>
                            </div>
                        @else
                            <div class="place-city">
                                <a href="#">{{ $church->feast_date }}</a>
                            </div>
                        @endif
                    </div>
                    <h3 class="place-title">
                        <a href="{{ route('churches.detailPage', ['uuid' => $church->church_uuid, 'name' => $church->name]) }}">
                            {{ strlen($church->name) > 40 ? substr($church->name, 0, 40) . '...' : $church->name }}
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    @empty
        <h3>No Church Found</h3>
    @endforelse
</div>

{{ $churches->links() }}

