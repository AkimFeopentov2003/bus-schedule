<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск маршрута</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Поиск маршрута</h1>

    <form id="findBusForm">
        <div class="mb-3">
            <label for="from" class="form-label">Откуда</label>
            <select class="form-select" id="from" v-model="from" required>
                <option value="" disabled selected>Выберите остановку</option>
                @foreach ($stops as $stop)
                    <option value="{{ $stop->id }}">{{ $stop->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="to" class="form-label">Куда</label>
            <select class="form-select" id="to" v-model="to" required>
                <option value="" disabled selected>Выберите остановку</option>
                @foreach ($stops as $stop)
                    <option value="{{ $stop->id }}">{{ $stop->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary">Найти автобус</button>
    </form>

    <div id="busResults" class="mt-4">
        <div v-if="buses.length === 0" class="alert alert-warning">
            По данному маршруту нет автобусов
        </div>
        <div
            v-for="(bus, index) in buses"
            :key="index"
            class="alert alert-info"
            @click="selectBus(bus.route)">
            <h5>@{{ bus.route }}</h5>
            <p>Ближайшие прибытия: @{{ bus.next_arrivals.join(', ') }}</p>
            <div v-if="stops.length > 0" class="mt-4">
                <h5>Остановки для маршрута @{{ selectedRoute }}:</h5>
                <ul>
                    <li v-for="(stop, index) in stops" :key="index">@{{ stop.name }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@3.2.30/dist/vue.global.prod.js"></script>
<script>
    const app = Vue.createApp({
        data() {
            return {
                from: '',
                to: '',
                buses: [],
                selectedRoute: '', // Хранение выбранного маршрута
                stops: [] // Хранение остановок
            };
        },
        methods: {
            async findBus() {
                const csrfToken = document.getElementById('token').value; // Получение CSRF токена
                this.stops = [];
                const requestData = {
                    from: this.from,
                    to: this.to
                };

                try {
                    const response = await fetch('/api/find-bus', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(requestData)
                    });
                    const data = await response.json();
                    console.log(data);
                    if(data.buses.length > 0){
                        this.stops.push({ name: data.from, id: data.fromId});
                        this.stops.push({ name: data.to, id: data.toId });
                    }
                    this.buses = data.buses;
                } catch (error) {
                    console.error('Ошибка подключения:', error);
                }
            },
            async selectBus(route) {
                const csrfToken = document.getElementById('token').value;

                try {
                    const response = await fetch('/api/get-stops', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ route })
                    });

                    const data = await response.json();
                    console.log(data);
                    this.selectedRoute = route;
                    this.stops = data.stops; // Полученные остановки
                } catch (error) {
                    console.error('Ошибка подключения:', error);
                }
            }
        }
    }).mount('body');

    document.getElementById('findBusForm').addEventListener('submit', function(e) {
        e.preventDefault();
        app.findBus();
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
