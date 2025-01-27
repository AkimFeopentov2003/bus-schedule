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
            @click="selectBus(bus)">
            <h5>@{{ bus.route }}</h5>
            <p>Ближайшие прибытия: @{{ bus.next_arrivals.join(', ') }}</p>
            <div v-if="bus.stops.length > 0" class="mt-4">
                <h5>Остановки для маршрута @{{ selectedRoute }}:</h5>
                <ul>
                    <li v-for="(stop, index) in bus.stops" :key="index">@{{ stop.name }}</li>
                </ul>
                <!-- Селект для выбора остановки -->
                <div class="mt-3">
                    <label for="stopsSelect">Выберите остановку для добавления :</label>
                    <select
                        id="stopsSelect"
                        class="form-select"
                        v-model="selectedStop"
                        :disabled="stopsInput === null"
                    >
                        <option v-for="(stop, index) in stopsInput" :key="index" :value="stop.stop_id">
                            @{{ stop.name }}
                        </option>
                    </select>
                    <button
                        class="btn btn-primary mt-2"
                        :disabled="!selectedStop"
                        @click.stop="addStopToRoute(bus, selectedStop)"
                    >
                        Добавить остановку
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@3.2.30/dist/vue.global.prod.js"></script>
<script>
    const app = Vue.createApp({
        data() {
            return {
                fromId: '',
                toId: '',
                from: '',
                to: '',
                buses: [],
                stopsInput: null,
                selectedStop: null,
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
                    // console.log(data);
                    this.buses = data.buses;
                    this.fromId = data.fromId;
                    this.toId = data.toId;
                } catch (error) {
                    console.error('Ошибка подключения:', error);
                }
            },
            async selectBus(bus) {
                const requestData = {
                    routeId: bus.routeId,
                    stops : bus.stops,
                    from: this.from,
                    to: this.to
                };
                const csrfToken = document.getElementById('token').value;
                console.log(requestData)
                try {
                    const response = await fetch('/api/get-stops', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(requestData)
                    });

                    const data = await response.json();
                    if(data.stops.length > 0){
                        this.stopsInput = data.stops;
                    }
                    console.log(this.stopsInput);
                } catch (error) {
                    console.error('Ошибка подключения:', error);
                }
            },
            async addStopToRoute(bus, selectedStopId){
                const requestData = {
                    routeId: bus.routeId,
                    stops : bus.stops,
                    selectedStopId: selectedStopId
                };
                const csrfToken = document.getElementById('token').value;
                console.log(requestData)
                try {
                    const response = await fetch('/api/add-stop', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(requestData)
                    });

                    const data = await response.json();
                    console.log(data);
                    bus.stops = data.stops;
                    this.stopsInput = null;
                    this.selectedStop = null;
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
