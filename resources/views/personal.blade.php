<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <x-header />
    <main class="container ">
        @if (Auth::user()->role == 'admin')
            <h1 class="mb-4">Все доступные комнаты</h1>
            <div class="container pb-5">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <a class="btn btn-primary mt-auto" href="{{ Route('roomform') }}">Добавить комнату</a>
                </div>
                <div class="row row-cols-1 row-cols-md-4 row-cols-xl-3 g-4">
                    @foreach ($rooms as $room)
                        <div class="col">
                            <div class="card" style="width: 355px;">
                                <img src="{{ asset($room->photo) }}" class="card-img-top w-100 object-fit-cover"
                                    style="height: 220px" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->room_name }}</h5>
                                    <p class="card-text">{{ $room->description }}</p>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Действие
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ Route('delete', [$room->id]) }}"
                                                    class="dropdown-item">Удалить</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ Route('roomeditform', [$room->id]) }}">Редактировать</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h2 class="h4 card-title text-center">{{ $room->room_name }}</h2>
                                    <h2 class="h4 card-title text-center">{{ $room->description }}</h2>
                                    <img src="{{asset($room->photo)}}" class="overflow-hidden rounded" style="height: 250px;"
                                        alt="...">

                                    <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Действие
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ Route('delete', [$room->id]) }}" class="dropdown-item">Удалить</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ Route('roomeditform', [$room->id]) }}">Редактировать</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                </div>
            </div>
        @endif
        @if (Auth::user()->role == 'admin')
            <h1 class="mb-4">Все заявки</h1>
        @else
            <h1 class="mb-4">Мои заявки</h1>
        @endif
        <table class="table align-middle">
            <thead>
                <tr>
                    <th >Номер заявки</th>
                    <th>Название комнаты</th>
                    <th >Название мероприятия</th>
                    <th>Дата</th>
                    <th>Оплата</th>
                    <th>Статус</th>
                    @if (Auth::user()->role == 'admin')
                        <th class="text-nowrap">Изменить статус</th>
                    @endif
                    @if (Auth::user()->role == 'user')
                        <th class="text-nowrap">Оставить отзыв</th>
                    @endif
                    <th>Отзывы</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $app)
                    <tr>
                        <td class="text-nowrap w-15">№ {{ $loop->count - $loop->index}}</td>
                        <td class="text-nowrap w-15">{{ $app->room->room_name }}</td>
                        <td class="text-nowrap w-15">{{ $app->app_name }}</td>
                        <td class="text-nowrap w-15">{{ $app->date->format('d.m.Y') }}</td>
                        <td class="text-nowrap w-15">{{ $app->payment }}</td>
                        <td class="text-nowrap w-15">{{ $app->status }}</td>
                        @if (Auth::user()->role == 'admin')
                            <td class="text-nowrap w-15">
                                <form action="{{ Route('changeStatus', $app) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm mb-1">
                                        <option value="Новая" @selected($app->status == 'Новая')>Новая</option>
                                        <option value="Мероприятие назначено" @selected($app->status == 'Мероприятие назначено')>
                                            Мероприятие назначено</option>
                                        <option value="Завершено" @selected($app->status == 'Завершено')>Завершено</option>
                                    </select>
                                    <button class="btn btn-sm btn-primary w-100" type="submit">Сохранить</button>
                                </form>
                            </td>
                        @endif
                        @if (Auth::user()->role == 'user')
                            <td class="w-25">
                                @if ($app->status == 'Завершено')
                                    <form action="{{ Route('commentadd', $app) }}" method="POST">
                                        @csrf
                                        <input name="comment" class="form-control form-control-sm mb-1"
                                            rows="1"></input>
                                        <button class="btn btn-sm btn-primary w-100 " type="submit "
                                            {{ $app->comments->isEmpty() ?: 'disabled' }}>Добавить</button>
                                    </form>
                                @endif
                            </td>
                        @endif
                        <td class="w-25">
                            @if ($app->status == 'Завершено')
                                @foreach ($app->comments as $comment)
                                    <p class="mb-1 small text-break">{{ $comment->comment }}</p>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    <x-script />
</body>

</html>
