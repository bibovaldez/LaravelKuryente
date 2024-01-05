<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overview') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap border-t-2 border-blue border-opacity-80 ">
        <div class="w-2/3 h-max">

            <div class="flex flex-wrap flex-col h-max">

                <div
                    class="bg-blue-dark bg-opacity-25 h-1/6 w-full py-2  border-b-2 border-black-dark border-opacity-10 leading-tight">

                    <div class="sm:px-6 lg:px-8 flex gap-3 " x-data="{ present: 'Loading...', previous: 'Loading...', total: 'Loading...' }">

                        <p class="w-1/3 font-extrabold ">Consumption |</p>

                        {{-- Previous --}}
                        <div class="w-1/2 flex font-extrabold opacity-75 tracking-wide" x-init="setInterval(() => {
                            fetch('/dashboard/Consumption') // replace with your API endpoint
                                .then(response => response.json())
                                .then(data => {
                                    previous = parseFloat(data.previous_reading).toFixed(2);
                                })
                                .catch(error => console.error('Error:', error));
                        }, 1000)">
                            <p>Prev:</p>
                            <p class="text-red-dark" x-text="previous"> </p>
                            <p>kw</p>
                        </div>

                        {{-- Present --}}
                        <div class="w-1/2 flex font-extrabold opacity-75 tracking-wide" x-init="setInterval(() => {
                            fetch('/dashboard/Consumption') // replace with your API endpoint
                                .then(response => response.json())
                                .then(data => {
                                    present = parseFloat(data.present_reading).toFixed(2);
                                    total = (parseFloat(data.present_reading) - parseFloat(data.previous_reading)).toFixed(2);
                                })
                                .catch(error => console.error('Error:', error));
                        }, 1000)">
                            <p>Pres:</p>
                            <p class="text-red-dark" x-text="present"> </p>
                            <p>kw</p>
                        </div>
                        {{-- Total --}}
                        <div class="w-1/2 flex font-extrabold opacity-75 tracking-wide ">
                            <p>Total kWh used:</p>
                            <p class="text-red-dark" x-text="total"></p>
                            <p>kW</p>
                        </div>
                    </div>
                </div>

                {{-- Time --}}
                <div
                    class="bg-blue-dark bg-opacity-25 w-full py-2  border-b-2 border-black-dark border-opacity-10 leading-tight">
                    <div class="flex gap-3"style="padding-left: 5.9rem; padding-right: 5.9rem">
                        <p class="font-extrabold" style="width:23%">Time |</p>
                        {{-- 1 minute --}}
                        <div class="font-extrabold opacity-75 tracking-wide" style="width:10%">
                            <button class="outline-none " onclick="setTimeUnit('min')">
                                <p class="hover:text-blue cursor-pointer transition ease-in-out duration-150 ">1m</p>
                            </button>
                        </div>
                        {{-- 1 hour --}}
                        <div class="font-extrabold opacity-75 tracking-wide" style="width:10%">
                            <button class="outline-none " onclick="setTimeUnit('hour')">
                                <p class="hover:text-blue cursor-pointer transition ease-in-out duration-150 ">1h</p>
                            </button>
                        </div>

                        {{-- 1 day --}}
                        <div class="font-extrabold opacity-75 tracking-wide" style="width:10%">
                            <button class="outline-none " onclick="setTimeUnit('day')">
                                <p class="hover:text-blue cursor-pointer transition ease-in-out duration-150 ">1D</p>
                            </button>
                        </div>

                        {{-- 1 month --}}
                        <div class="font-extrabold opacity-75 tracking-wide" style="width:10%">
                            <button class="outline-none " onclick="setTimeUnit('month')">
                                <p class="hover:text-blue cursor-pointer transition ease-in-out duration-150 ">1M</p>
                            </button>
                        </div>

                        {{-- 1 year --}}
                        <div class="font-extrabold opacity-75 tracking-wide" style="width:10%">
                            <button class="outline-none " onclick="setTimeUnit('year')">
                                <p class="hover:text-blue cursor-pointer transition ease-in-out duration-150 ">1Y</p>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-dark bg-opacity-25 h-full w-full">
                    {{-- chartjs --}}
                    <canvas id="myChart"
                        class="
                        w-full
                        h-full
                    "></canvas>
                </div>
                {{-- Download info --}}
                <div>
                    
                </div>

            </div>

        </div>

        <div class="w-1/3 h-border-l-2 border-black-dark border-opacity-15 flex-1 ">
            <div class="flex flex-col">
                {{-- Present Date and Time --}}
                <div class="bg-white  flex flex-col flex-wrap border-b-2 border-black-dark border-opacity-15 ">
                    <div class="flex items-center justify-center space-x-14 relative">
                        <span class="flex space-x-2">
                            <x-application-date /> {{-- love nag-dagdag ako ng component pangit kasi pag andito i love you --}}
                            <span>{{ date('M. j, Y') }}</span>
                        </span>

                        <div class="border-l-2 border-black-dark border-opacity-15 h-11"></div>

                        <span class="flex space-x-2">
                            <x-application-clock /> {{-- love nag-dagdag ako ng component pangit kasi pag andito i love you --}}
                            <span>{{ date('g:i a') }}</span>
                        </span>
                    </div>
                </div>
            </div>
            {{-- Consumption Bill --}}
            <div class="bg-blue-dark bg-opacity-25 ">
                <div class="text-center text-xl font-glacial font-semibold opacity-70 tracking-normal py-1 ">Consumption
                    Bill</div>
            </div>

            {{-- Type and Rate --}}
            <div
                class="bg-white border-t-2 border-black-dark border-opacity-10 py-1 px-10  tracking-wide items-center text-lg">
                <div class="flex space-x-10">
                    <div class="flex">
                        <p class="font-extrabold">Type:</p>
                        <p class="font-normal">{{ $meterinfo->type }}</p>
                    </div>

                    <div class="flex ">
                        <p class="font-extrabold">Rate:</p>
                        <p class="font-normal text-green-dark">Php {{ $meterinfo->rate }}</p>
                        <p class="font-normal text-red-dark"> kWh</p>
                    </div>

                </div>
            </div>



            <div x-data="{ data: [], selectedYear: '' }" x-init=" data = await (async function() {
                 const response = await fetch(`/dashboard/fetch_meter_bill`);
                 const data = await response.json();
                 // Process data to group by years
                 const years = Array.from(new Set(data.map(item => item.year_month.slice(0, 4))));
                 const dataByYear = {};
                 years.forEach(year => {
                     dataByYear[year] = data.filter(item => item.year_month.startsWith(year));
                 });
                 return dataByYear;
             })();">

                <div class=" border-b-2 border-t-2 border-black-dark border-opacity-10 bg-white">
                    <label for="year_select" class="sr-only">Year Select</label>
                    <select
                        class="block w-auto mx-auto py-1 text-center text-lg font-bold font-glacial opacity-80 bg-white border-none focus:ring-0 focus:border-gray-200 peer leading-tight"
                        name="year" id="year" x-model="selectedYear"
                        x-on:change="selectedYear = $event.target.value">
                        <option value="">Select Year</option>
                        <template x-for="year in Object.keys(data)">
                            <option x-bind:value="year" x-text="year"></option>
                        </template>
                    </select>
                </div>
                <div class="border-b-2 border-black-dark border-opacity-10"></div>

                <div class=" max-h-48 overflow-x-auto overflow-y-auto space-y-1 font-extrabold tracking-wide"
                    x-show="selectedYear" style="height: 250px;">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Month</th>
                                <th
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bill Amount</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="entry in data[selectedYear]">
                                <tr>
                                    <td class="px-2 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <span x-text="entry.year_month"></span>
                                        </div>
                                    </td>
                                    <td class="px-2 py-4 whitespace-nowrap">
                                        <div class="text-green-dark font-normal">
                                            <span x-text="Number(entry.bill_amount).toFixed(2)"></span>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>


                </div>


            </div>





            <div class="bg-slate-300">
                <div class="bg-blue-dark bg-opacity-25  border-b-2 border-black-dark border-opacity-10 ">
                    <div class="text-center text-xl font-glacial font-semibold opacity-70 tracking-normal py-1 ">
                        Meter Status</div>
                </div>
                {{-- Meter Status Details --}}
                <div
                    class="bg-white  border-b-2 border-black-dark border-opacity-20 px-10 space-y-2 font-extrabold tracking-wide ">
                    <span class="flex space-x-2 ">
                        <p>Status:</p>
                        {{-- <p></p> --}}
                        <p class="text-green-dark font-normal">{{ $meterinfo->status }}</p>
                    </span>
                    <span class="flex space-x-2">
                        <p>Owner:</p>
                        {{-- <p></p> --}}
                        <p class="text-green-dark font-normal">{{ $meterinfo->Owner }}</p>
                    </span>
                    <span class="flex space-x-2">
                        <p>Address:</p>
                        {{-- <p></p> --}}
                        <p class="text-green-dark font-normal">{{ $meterinfo->Address }}</p>
                    </span>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
