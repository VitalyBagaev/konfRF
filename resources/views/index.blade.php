<!DOCTYPE html>
<html lang="en">

<x-head />

<body>

    <x-header />


    <div class="container pb-5">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h1 class="mb-1">Комнаты для мероприятий</h1>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-4">
                    @foreach ($rooms as $room)
                        <div class="col">
                            <div class="card" style="width: 355px;">
                                <img src="{{ asset($room->photo) }}" class="card-img-top w-100 object-fit-cover"
                                    style="height: 220px" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->room_name }}</h5>
                                    <p class="card-text">{{ $room->description }}</p>
                                    <a class="btn btn-primary mt-auto @guest disabled @endguest"  href="{{ Route('reservation', [$room->id]) }}">Забронировать</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    </div>

    <x-script />
</body>

</html>
