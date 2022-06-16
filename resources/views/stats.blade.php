@extends('layouts.app')

@section('slot')
    @push('top')
        <h1 style="font-weight: 800;">{{ __('Statistik') }}</h1>
        <p class="text-xs hidden">ID mesin : <span id="machine-id-value">{{ isset($machineid) ? $machineid : 'belum terhubung' }}</span></p>
    @endpush
    <div class="stats flex flex-col justify-center items-center gap-4 py-5">
        <div id="chart-wrapper" class="w-11/12 md:w-2/3">
            <canvas id="stat-chart" class="bg-white rounded-lg border-2 border-zinc-200 lg:p-2"></canvas>
        </div>
        <div id="form-tambah-produksi" class="flex flex-col items-center gap-3">
            <label for="berat" class="text-sm mr-2" style="font-weight: 600;">Tambah Produksi</label>
            <input type="text" name="berat" id="berat" placeholder="Masukkan berat dalam gram" class="h-10 w-72 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md placeholder:text-sm text-sm">
            <input type="hidden" value="{{ isset($machineid) ? $machineid : 'belum terhubung' }}">
            <button class="w-28 h-10 rounded-full appearance-none bg-red-100 text-red-500 cursor-pointer outline-none border-0" id="tambah-produksi">Tambah</button>
        </div>
        <div class="filter-date-wrapper flex gap-3">
            <div onclick="changeChartType()" id="change-chart-type" class="flex rounded-full gap-4 w-32 h-10 items-center justify-center cursor-pointer" style="background-color: rgb(255, 244, 198)">
                <span id="type-label" style="color: #e4ad21">Garis</span>
                <div id="data-bar" class="hidden">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M5.75 3a2.25 2.25 0 0 1 2.248 2.25v13.5a2.25 2.25 0 1 1-4.498 0V5.25A2.25 2.25 0 0 1 5.75 3Zm6.5 4a2.25 2.25 0 0 1 2.248 2.25v9.5a2.25 2.25 0 1 1-4.498 0v-9.5A2.25 2.25 0 0 1 12.25 7Zm6.5 4a2.25 2.25 0 0 1 2.248 2.25v5.5a2.25 2.25 0 1 1-4.498 0v-5.5A2.249 2.249 0 0 1 18.75 11Z" fill="#fbbf24"/></svg>
                </div>
                <div id="data-line" class="block">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M16 6a3 3 0 1 1 2.524 2.962l-2.038 3.358a3 3 0 0 1-4.749 3.65l-3.741 1.87a3 3 0 1 1-.461-1.446l3.531-1.765a3 3 0 0 1 4.275-3.313l1.798-2.963A2.995 2.995 0 0 1 16 6Z" fill="#fbbf24"/></svg>
                </div>
            </div>
            <select onchange="update()" class="w-28 h-10 rounded-full appearance-none pl-3 bg-teal-100 text-teal-500 cursor-pointer outline-none border-0" name="filter-date" id="filter-date">
                <option value="hari">Hari ini</option>
                <option value="pekan">7 Hari</option>
                <option value="bulan">Bulan ini</option>
            </select>
        </div>
        <!--<div class="w-28 h-10 rounded-full appearance-none bg-indigo-100 text-indigo-500 cursor-pointer outline-none border-0 flex justify-center items-center"><a href="{{ route('downloadallstats') }}">Ekspor PDF</a></div>-->
    </div>

@push('styles')
    <style>
        #filter-date {
            background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4.22 8.47a.75.75 0 0 1 1.06 0L12 15.19l6.72-6.72a.75.75 0 1 1 1.06 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L4.22 9.53a.75.75 0 0 1 0-1.06Z' fill='%2314b8a6'/%3E%3C/svg%3E");
            background-position: 90% center;
            background-repeat: no-repeat;
        }
    </style>
@endpush

@push('scripts')
<script>
    const filterDate = document.getElementById('filter-date')
    const id = document.getElementById('machine-id-value')
    const canvasWrapper = document.getElementById('chart-wrapper')
    const chartCanvas = document.getElementById('stat-chart').getContext('2d')
    const btnTambahProduksi = document.getElementById('tambah-produksi')
    const berat = document.getElementById('berat')

    berat.addEventListener("keyup", ({key}) => {
        if (key === "Enter") {
            btnTambahProduksi.click()
        }
    })
    btnTambahProduksi.addEventListener('click', () => {
        if(id.innerText != 'belum terhubung' && !isNaN(berat.value) && berat.value.length != 0) {
            fetch(`${window.location.origin}/api/simpanproduksi`, {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({
                                machineid: id.innerText,
                                berat: parseFloat(berat.value)
                                }),
                            })
                            .then((response) => {
                                if(response.status == 200) {
                                    return response.json()
                                }
                                else {
                                    alert('tambah produksi gagal')
                                }
                                // document.location.reload()
                            })
                            .then((data) => {
                                alert(data.message)
                            })
                            .catch(err => console.log(err))
        }else {
            alert('tidak terhubung ke mesin atau\nberat yang diisikan salah')
        }
    })

    let delayed
    let gradient = chartCanvas.createLinearGradient(0,0,0,450)
    gradient.addColorStop(0, 'rgba(253,230,138, 1)');
    gradient.addColorStop(0.5, 'rgba(253,230,138, 0.5)');
    gradient.addColorStop(1, 'rgba(253,230,138, 0.2)');

    let dummyData = {
            labels: ['08/05', '09/05', '10/05', '11/05', '12/05', '13/05', '14/05'],
            data: [2.1, 3.4, 5.3, 0.3, 2.7, 1.2, 3.3]
    }

    const getData = async () => {
        let url = `${window.location.origin}/api/get-prod?filter=${filterDate.value}&machineid=${id.innerText}`
        let response = await fetch(url)
        let data = await response.json()
        console.log(data)
        let formattedWeight
        let formattedDate

        if(filterDate.value == 'pekan' || filterDate.value == 'bulan') {
            const reducedArray = data.reduce((acc, next) => {
            const lastItemIndex = acc.length -1;
            const accHasContent = acc.length >= 1;

            if(filterDate.value == 'pekan' || filterDate.value == 'bulan') {
                if(accHasContent && acc[lastItemIndex].created_at.split(' ')[0] == next.created_at.split(' ')[0]) {
                    acc[lastItemIndex].weight += next.weight;
                } else {
                    acc[lastItemIndex +1] = next;
                }
            }

            return acc;
            }, []);
            formattedWeight = reducedArray.map(e => e.weight.toFixed(1))
            formattedDate = reducedArray.map(e => e.created_at.split(' ')[0].substring(5).replace('-', '/'))
        } else {
            formattedWeight = data.map((e) => e.weight.toFixed(1))
            formattedDate = data.map((e) => e.created_at.split(' ')[1].substring(0, 5))
        }
        return {
            title: filterDate.value === 'hari' ? 'Produksi hari ini' : filterDate.value === 'pekan' ? 'Produksi selama 7 hari' : 'Produksi selama 30 hari',
            data: formattedWeight,
            labels: formattedDate
        }
    }
    // e.created_at.split(' ')[0].substring(5).replace('-', '/')

    let datasets = {
        labels: [],
        datasets: [{
            backgroundColor: gradient,
            borderWidth: 3,
            hoverBorderWidth: 4,
            pointRadius: 4,
            pointHoverRadius: 8,
            tension: 0.1,
            hitRadius: 30,
            pointBackgroundColor: 'rgba(255, 255, 255, 1)',
            borderColor: '#fbbf24',
            fill: true,
            data: []
        }]
    }

    let config = {
        type: 'line',
        data: datasets,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === 'data' && context.mode === 'default' && !delayed) {
                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                },
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: '',
                    padding: {
                        bottom: 20,
                        top: 20
                    }
                },
                tooltip: {
                    padding: 10,
                    enabled: true,
                    backgroundColor: 'rgb(39,39,42)',
                    displayColors: false,
                    callbacks: {
                        title: (tooltipItem) => {
                            return 'Waktu Produksi : ' + tooltipItem[0].label
                        },
                        label: (tooltipItem) => {
                            return 'Berat : ' + tooltipItem.formattedValue + ' gram'
                        }
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: (value, index, ticks) => {
                            return Number(value).toFixed(1) + ' gr'
                        }
                    },
                    beginAtZero: true
                }
            },
        },
    }

    const update = async () => {
        // console.log(filterDate.value)
        try {
            // throw 'yaah eror'
            let newData = await getData()
            // console.log(newData)
            statChart['data']['labels'] = newData.labels
            statChart.data.datasets.forEach((dataset) => {
                dataset['data'] = newData.data
            })
            statChart.options.plugins.title.text = newData.title
            statChart.options.plugins.tooltip.callbacks.title = (tooltipItem) => {
                const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                if(filterDate.value == 'pekan' || filterDate.value == 'bulan') {
                    return 'Waktu Produksi : ' + tooltipItem[0].label.split('/')[1] + ' ' + monthNames[parseInt(tooltipItem[0].label.split('/')[0] -1)]
                } else {
                    return 'Waktu Produksi : Pukul ' + tooltipItem[0].label
                }
            }
            statChart.update()
        } catch (error) {
            alert(error.stack)
        }
    }

    const changeChartType = () => {
        try {
            if(config.type == 'line') {
                config.type = 'bar'
                statChart.update()
                document.getElementById('data-line').classList.replace('block', 'hidden')
                document.getElementById('data-bar').classList.replace('hidden', 'block')
                document.getElementById('type-label').innerText = 'Batang'
            }else if(config.type == 'bar') {
                config.type = 'line'
                statChart.update()
                document.getElementById('data-bar').classList.replace('block', 'hidden')
                document.getElementById('data-line').classList.replace('hidden', 'block')
                document.getElementById('type-label').innerText = 'Garis'
            }
        } catch (error) {
            alert(error.stack)
        }
    }

    let statChart = new Chart(chartCanvas, config)

    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            if(id.innerText == 'belum terhubung') {
                emitError()
                statChart.options.plugins.title.text = 'id mesin belum dihubungkan'
                statChart.update()
            } else {
                filterDate.value = 'hari'
                filterDate.dispatchEvent(new Event('change'))
            }
        },200)
    })
</script>
@endpush
@endsection
