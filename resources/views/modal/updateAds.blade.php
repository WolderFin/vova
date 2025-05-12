<div class="hystmodal" id="updateAd" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Редактирование объявления</p>
                </div>
                <img src="#" alt="" id="adImage" class="modal-ad-product">
                <form id="editAdForm" action="" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" name="name" id="adName" placeholder="Название объявления" required>
                    <input type="text" name="price" id="adPrice" placeholder="Цена" required>
                    <input type="text" name="description" id="adDescription" placeholder="Описание" required>

                    <select name="city_id" id="adCity">
                        @foreach($globalCity as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>

                    <select name="category_id" id="adCategory">
                        @foreach($globalCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @auth()
                        @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                            <select name="status" id="adStatus">
                                <option value="Размещено">Размещено</option>
                                <option value="Отклонено">Отклонено</option>
                                <option value="На модерации">На модерации</option>
                            </select>
                        @else
                            <input type="hidden" name="status" id="adStatus">
                        @endif
                    @endauth
                    <button type="submit">Обновить объявление</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    IMask(
        document.getElementById('adPrice'),
        {
            mask: Number,
            min: 0,
            thousandsSeparator: ' '
        }
    )

</script>
