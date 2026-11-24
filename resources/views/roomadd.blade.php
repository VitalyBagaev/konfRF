<!DOCTYPE html>
<html lang="en">

<x-head />

<body>

    <x-header />
    <div class="container pb-5" style="max-width: 760px;">
        <h1 class="mb-4">
            @isset($room)
                Редактировать
            @else
                Добавить
            @endisset комнату
        </h1>
        <form
            action="@isset($room) {{ Route('roomedit', [$room->id]) }}@else {{ Route('roomadd') }}@endisset"
            method="POST" class="card card-body shadow-sm" enctype="multipart/form-data">@csrf
            <div class="mb-3"><label for="name" class="form-label">Название комнаты</label><input
                    class="form-control" id="name" name="room_name"
                    @isset($room) value="{{ $room->room_name }}" @endisset
                    value=" {{ old('room_name') }}">
                @error('room_name')
                    <div class="alert alert-danger">{{ $message }}
                    </div>
                @enderror
                <br>
                
                <div class="mb-3"><label for="name" class="form-label">Описание комнаты</label><input
                        class="form-control" id="name" name="description"
                        @isset($room) value="{{ $room->description }}" @endisset
                        value=" {{ old('description') }}">
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Изображение для комнаты</label>
                    <input class="form-control" type="file" name="photo">
                </div>
                
                @error('photo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                @isset($room)
                    <img src="{{ asset($room->photo) }}" class="overflow-hidden rounded" style="height: 250px;"
                        alt="...">
                @endisset
                <div class="d-flex gap-2"><button class="btn btn-primary" type="submit">Сохранить комнату</button>
                    {{-- <a class="btn btn-outline-secondary" href="{{ Route('index') }}">Отмена</a> --}}
                    </div>
        </form>
    </div>


    <x-script />
</body>

</html>
