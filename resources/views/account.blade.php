@extends('layout.index')
@section('main')
    <h1>Ваши объявления</h1> <br>
    <div class="grid-container">
        @if($ads->isEmpty())
            <p>Пока нет доступных объявлений</p>
        @else
            @foreach($ads as $ad)
                <!-- Проверяем статус объявления и делаем ссылку не кликабельной -->
                @if($ad->status == 'На модерации' || $ad->status == 'Отклонено')
                    <div class="grid-item">
                        <div class="grid-item__img">
                            <img src="{{ '/storage/' . $ad->image }}" alt="">
                            <div class="admin-table__item-action">
                                <a href="#" data-hystmodal="#updateAd" class="edit-ad" data-id="{{ $ad->id }}" data-name="{{ $ad->name }}" data-image="{{ '/storage/' . $ad->image }}" data-price="{{ $ad->price }}" data-description="{{ $ad->description }}" data-status="{{ $ad->status }}" data-category="{{ $ad->category->name }}" data-city="{{ $ad->city->name }}" data-url="{{ $ad->url }}">
                                    <div class="admin-table__action-edit">
                                        <div class="action-edit__ico"></div>
                                    </div>
                                </a>
                                <form action="{{ route('ads.delete', $ad->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; padding: 0;">
                                        <div class="admin-table__action-delete">
                                            <div class="action-delete__ico"></div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="grid-item__content">
                            <div class="grid-item__content-price">
                                <p>{{$ad->name}}</p>
                                <p>{{$ad->price}} РУБ.</p>
                            </div>
                            <div class="grid-item__content-city">
                                <p>{{$ad->city->name}}, {{ $ad->created_at->format('d.m.Y') }}</p>
                            </div>
                            <!-- Плашка с статусом -->
                            <div class="grid-item__status">
                            <span class="status-label {{ $ad->status == 'Активно' ? 'active' : ($ad->status == 'Продано' ? 'sold' : '') }}">
                                {{ $ad->status }}
                            </span>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('ads.show', $ad->url) }}">
                        <div class="grid-item">
                            <div class="grid-item__img">
                                <img src="{{ '/storage/' . $ad->image }}" alt="">
                                <div class="admin-table__item-action">
                                    <a href="#" data-hystmodal="#updateAd" class="edit-ad" data-id="{{ $ad->id }}" data-name="{{ $ad->name }}" data-image="{{ '/storage/' . $ad->image }}" data-price="{{ $ad->price }}" data-description="{{ $ad->description }}" data-status="{{ $ad->status }}" data-category="{{ $ad->category->name }}" data-city="{{ $ad->city->name }}" data-url="{{ $ad->url }}">
                                        <div class="admin-table__action-edit">
                                            <div class="action-edit__ico"></div>
                                        </div>
                                    </a>
                                    <form action="{{ route('ads.delete', $ad->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; padding: 0;">
                                            <div class="admin-table__action-delete">
                                                <div class="action-delete__ico"></div>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="grid-item__content">
                                <div class="grid-item__content-price">
                                    <p>{{$ad->name}}</p>
                                    <p>{{$ad->price}} РУБ.</p>
                                </div>
                                <div class="grid-item__content-city">
                                    <p>{{$ad->city->name}}, {{ $ad->created_at->format('d.m.Y') }}</p>
                                </div>
                                <!-- Плашка с статусом -->
                                <div class="grid-item__status">
                                <span class="status-label {{ $ad->status == 'Активно' ? 'active' : ($ad->status == 'Продано' ? 'sold' : '') }}">
                                    {{ $ad->status }}
                                </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        @endif
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.edit-ad').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Получаем данные объявления из атрибутов data-*
                    const adId = this.getAttribute('data-id');
                    const adImage = this.getAttribute('data-image');
                    const adName = this.getAttribute('data-name');
                    const adPrice = this.getAttribute('data-price');
                    const adDescription = this.getAttribute('data-description');
                    const adStatus = this.getAttribute('data-status');
                    const adCityId = this.getAttribute('data-city'); // ID города
                    const adCategoryId = this.getAttribute('data-category'); // ID категории

                    // Устанавливаем значения полей ввода в модалке
                    document.getElementById('adName').value = adName;
                    document.getElementById('adImage').src  = adImage;
                    document.getElementById('adPrice').value = adPrice;
                    document.getElementById('adDescription').value = adDescription;
                    document.getElementById('adStatus').value = adStatus;

                    // Настроим город
                    const citySelect = document.getElementById('adCity');
                    for (let option of citySelect.options) {
                        if (option.value == adCityId) {
                            option.selected = true;  // Выбираем город, который был выбран
                            break;
                        }
                    }

                    // Настроим категорию
                    const categorySelect = document.getElementById('adCategory');
                    for (let option of categorySelect.options) {
                        if (option.value == adCategoryId) {
                            option.selected = true;  // Выбираем категорию, которая была выбрана
                            break;
                        }
                    }

                    // Настроим действие формы на правильный маршрут для обновления объявления
                    const editForm = document.getElementById('editAdForm');
                    editForm.action = '/admin/ads/update/' + adId; // Путь для обновления объявления

                });
            });
        });
    </script>

@endsection
