<div class="hystmodal" id="create" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Разместить объявление</p>
                </div>
                <form action="{{ route('ads.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="text" name="name" placeholder="Название объявления">

                    <select name="city_id">
                        <option disabled selected>Выберите город</option>
                        @foreach($globalCity as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>

                    <label for="photo" class="photo-label">Загрузить фото</label>
                    <input type="file" name="photo" id="photo" class="photo-input">

                    <input type="text" name="description" placeholder="Описания объявления">

                    <select name="category_id">
                        <option disabled selected>Выберите категорию</option>
                        @foreach($globalCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="price" id="create-price" placeholder="Цена">

                    <button type="submit">Создать</button>
                </form>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    IMask(
        document.getElementById('create-price'),
        {
            mask: Number,
            min: 0,
            thousandsSeparator: ' '
        }
    )
</script>
