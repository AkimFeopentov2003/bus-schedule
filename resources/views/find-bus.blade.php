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

{{--    <div id="busResults" class="mt-4">--}}
{{--        <div v-for="bus in buses" class="alert alert-info">--}}
{{--            <h5>{{ bus.route }}</h5>--}}
{{--            <p>Ближайшие прибытия: {{ bus.next_arrivals.join(', ') }}</p>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@3.2.30/dist/vue.global.prod.js"></script>
<script>
    const app = Vue.createApp({
        data() {
            return {
                from: '',
                to: '',
                buses: []
            };
        },
        methods: {
            async findBus() {
                const response = await fetch('/find-bus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        from: this.from,
                        to: this.to
                    })
                });

                const data = await response.json();
                this.buses = data.buses;
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
