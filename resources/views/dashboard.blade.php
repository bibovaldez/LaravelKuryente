<x-app-layout>
    <div class="py-12 flex flex-wrap h-max">
        <div class="w-2/3 h-max">

            <div class="flex flex-wrap flex-col h-max">

                <div class="bg-slate-400 h-1/6 w-full">
                    <div class="flex gap-2" x-data="{ present: 'Loading...' , previous: 'Loading...' , total: 'Loading...' }">
                        <p>Consumption </p>
                        {{-- Previous --}}
                        <div class="w-1/2 flex" x-init="setInterval(() => {
                            fetch('/dashboard/Consumption') // replace with your API endpoint
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                    previous = data.previous_reading.toFixed(2);
                                })
                                .catch(error => console.error('Error:', error));
                        }, 1000)">
                            <p>Prev:</p>
                            <p x-text="previous"></p>
                            <p>kw</p>
                        </div>
                        {{-- Present --}}
                        <div class="w-1/2 flex" x-init="setInterval(() => {
                            fetch('/dashboard/Consumption') // replace with your API endpoint
                                .then(response => response.json())
                                .then(data => {
                                    present = data.present_reading.toFixed(2);
                                    total = (data.present_reading - data.previous_reading).toFixed(2);
                                })
                                .catch(error => console.error('Error:', error));
                        }, 1000)">
                            <p>Pres:</p>
                            <p x-text="present"></p>
                            <p>kw</p>
                        </div>
                        {{-- Total --}}
                        <div class="w-1/2 flex">
                            <p>Total kWh used:</p>
                            <p x-text="total"></p>
                            <p>kW</p>
                        </div>
                    </div>
                </div>

                {{--  sa time ako na dito basta yung desing ilagay mo nalan kasi masisingitan to ng function pati sa chart i love you --}}
                <div class="bg-slate-300 h-1/6 w-full">
                    <h3>Time</h3>
                    <div class="flex gap-2" onclick="setTimeUnit('min')">1m</div>
                    <div class="flex gap-2" onclick="setTimeUnit('hour')">1h</div>
                    <div class="flex gap-2" onclick="setTimeUnit('day')">1d</div>
                    <div class="flex gap-2" onclick="setTimeUnit('month')">1M</div>
                    <div class="flex gap-2" onclick="setTimeUnit('year')">1y</div>

                </div>

                <div class="bg-slate-200 h-full w-full">
                    {{-- chartjs --}}
                    <canvas id="myChart"
                        class="
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



                <div class="bg-slate-400" x-data="{ data: [], selectedYear: '' }" x-init=" data = await (async function() {
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
                    <div class="flex gap-2">
                        <p>Bill</p>
                        <select name="year" id="year" x-model="selectedYear">
                            <option value="">Select Year</option>
                            <template x-for="year in Object.keys(data)">
                                <option x-bind:value="year" x-text="year"></option>
                            </template>
                        </select>
                    </div>
                    <div x-show="selectedYear">
                        <table>
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Bill Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="entry in data[selectedYear]">
                                    <tr>
                                        <td x-text="entry.year_month"></td>
                                        <td x-text="entry.bill_amount"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>


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
