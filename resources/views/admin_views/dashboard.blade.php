@extends('layouts.app', ['title' => ' Admin Dashboard'])

@section('content')

    <div class="container">
        <div>
            <div class="Header-List">
                <p>ADMIN DASHBOARD</p>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-center">
            <div class="Header-List">
                ARTIST
            </div>
            <div class="d-flex justify-content-center mt-3 mb-2 w-100">
                <input type="text" name="artist_name" id="artist" list="artist-list" class="dashboard-input" data-select2>
                <datalist id="artist-list">
                    @foreach ($artists as $artist)
                    @php
                        $crypt_artist = Crypt::encrypt($artist -> id);
                    @endphp
                        <option value="{{$artist -> name}}" data-hidden-value="{{$crypt_artist}}"></option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <div>
                    <a href="/add_artist/" id="add_artist">ADD</a>
                </div>
                <div>

                </div>
                <div>
                    
                </div>
            </div>
        </div>

    </div>

<script>
    $(document).ready(function() {
        $('input[list="artist-list"]').on('input', function() {
            var artistName = $(this).val();
            var artistOption = $('option[value="' + artistName + '"]', this.list);
            var artistId = artistOption.data('hidden-value');
            var link = '/artist/' + artistId;
            $('a[href="/add_artist/"').attr('href', link);
            artistOption.prop('selected', true);
        });
    });
</script>
@endsection