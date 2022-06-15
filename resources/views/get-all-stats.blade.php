<!DOCTYPE html>
<html>
<head>
	<!-- Used to optimized Website for mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<style>
        * {
            font-family: sans-serif;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .aggregation {
            display: flex;
            width: 100%;
            justify-content: center;
            gap: 100px;
        }
        .table {
            margin-top: 30px;
        }
        .min, .max, .avg {
            display: flex;
            flex-direction: column;
        }
        th {
            padding: 10px;
            background: #fef3c7;
        }
	</style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>DATA PRODUKSI</h1>
        </div>
        {{-- <div class="aggregation">
            @php
                $min = 0;
                $max = max(array_column($stats, 'weight'));
                $avg = 0;
                foreach($stats as $key => $value) {

                }
            @endphp
            <div class="min">
                <span style="font-weight: bold; font-size: 18px">Min</span>
                <span>Kg</span>
            </div>
            <div class="max">
                <span style="font-weight: bold; font-size: 18px">Max</span>
                <span>{{ $max }} Kg</span>
            </div>
            <div class="avg">
                <span style="font-weight: bold; font-size: 18px">Rata-rata</span>
                <span>12.7 Kg</span>
            </div>
        </div> --}}

        <div class="table">
            <table style="border: 2px solid #f3f4f6">
                <thead>
                    <tr>
                        <th style="width: max-content">No.</th>
                        <th style="width: 100px;">Berat (Kg)</th>
                        <th style="width: 200px;">Tanggal/Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($stats as $stat)
                        <tr style="text-align: center">
                            @php
                                $no++
                            @endphp
                            <td style="padding: 10px; {{ $no % 2 == 0 ? 'background: #e5e7eb' : 'background: #f3f4f6' }}">{{ $no - 1 }}.</td>
                            <td style="padding: 10px; {{ $no % 2 == 0 ? 'background: #e5e7eb' : 'background: #f3f4f6' }}">{{ $stat->weight }}</td>
                            <td style="padding: 10px; {{ $no % 2 == 0 ? 'background: #e5e7eb' : 'background: #f3f4f6' }}">{{ $stat->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
