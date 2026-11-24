<!DOCTYPE html>
<html lang="en">

<x-head />

<body>

    <x-header />
    <div class="container">
        <form action="{{ Route('application', [$room->id]) }}" method="POST">
            @csrf
            <div class="mb-3"><label for="name" class="form-label">Название мероприятия</label><input class="form-control"
                    id="name" name="app_name"
                    
                    value=" {{ old('app_name') }}">
                @error('app_name')
                    <div class="alert alert-danger">{{ $message }}
                    </div>
                @enderror
                <br>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Дата проведения</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" name="date">
                </div>

                @error('date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Тип оплаты</label>
                    <select class="form-select" id="inputGroupSelect01" name="payment">
                        <option value="очно">Очная</option>
                        <option value="СБП">СБП</option>
                    </select>
                </div>
                @error('payment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                <button type="submit" class="btn btn-primary">Забронировать</button>
        </form>

    </div>
    {{-- <img src="{{ asset('storage/image.png')}}" alt="Логотип" class="overflow-hidden rounded"
            style="height: 250px;"> --}}
    <x-script />
</body>

</html>
