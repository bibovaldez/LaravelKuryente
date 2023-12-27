<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex flex-wrap h-max">
        <div class="w-2/3 h-max">

            <div class="flex flex-wrap flex-col h-max">

                <div class="bg-slate-400 h-1/6 w-full">
                    <div class="flex gap-2">
                        <p>Consumption </p>
                        {{-- Previous --}}
                        <div class="w-1/2 flex">
                            <p>Prev:</p>
                            <p>{{ number_format($meterinfo->previous_reading, 2) }}</p>
                            <p>kw</p>
                        </div>
                        {{-- Present --}}
                        <div class="w-1/2 flex">
                            <p>Pres:</p>
                            <p>{{ number_format($meterinfo->present_reading, 2) }}</p>
                            <p>kw</p>
                        </div>
                        {{-- Total --}}
                        <div class="w-1/2 flex">
                            <p>Total kWh used:</p>
                            <p>{{ number_format($meterinfo->present_reading - $meterinfo->previous_reading, 2) }}</p>
                            <p>kW</p>
                        </div>
                    </div>
                </div>

                {{--  sa time ako na dito basta yung desing ilagay mo nalan kasi masisingitan to ng function pati sa chart i love you --}}
                <div class="bg-slate-300 h-1/6 w-full">
                    <h3>Time</h3>
                </div>

                <div class="bg-slate-200 h-full w-full">
                    {{-- chartjs --}}
                    <canvas id="myChart" class="
                        w-full
                        h-full
                    "></canvas>
                </div>

            </div>

        </div>

        <div class="bg-slate-200 w-1/3">
            <div>
                <div class="bg-slate-200">
                    <div>
                        {{ date('M. j. Y') }}
                    </div>
                    <div>
                        {{ date('g:i a') }}
                    </div>
                </div>
                <div class="bg-slate-400">Consumption bill
                    {{-- ul dapat to love pero wala pa d ko pa naayo back end  --}}
                </div>
                <div class="bg-slate-300">
                    <h4>Meter status</h4>
                    <span class="flex">
                        <p>Status:</p>
                        <p>{{ $meterinfo->status }}</p>
                    </span>
                    <span class="flex">
                        <p>Owner:</p>
                        <p>{{ $meterinfo->Owner }}</p>
                    </span>
                    <span class="flex">
                        <p>Address:</p>
                        <p>{{ $meterinfo->Address }}</p>
                    </span>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
