<script>
import { getLeads } from "../js/Api/Bitrix.js";
export default {
    async created() {
        this.leads = await getLeads();
    },
    data() {
        return {
            leads: null,
        };
    },
    methods: {
        getLeads: getLeads,

        calculateSales(data = []) {
            return data.reduce((acc, el) => {
                if (el.STAGE_ID === "WON") return (acc += 1);
                return acc;
            }, 0);
        },

        calculateTotalSales() {
            let sumOfLeads = 0;
            for (const key in this.leads) {
                sumOfLeads += this.calculateSales(this.leads[key]);
            }
            return sumOfLeads;
        },
        calculateTotalBids() {
            let sumOfBids = 0;
            for (const key in this.leads) {
                sumOfBids += this.leads[key].length;
            }
            return sumOfBids;
        },
        calculateIncome(data) {
            return (
                data.reduce((acc, el) => {
                    if (el.STAGE_ID === "WON") {
                        return (acc = +el.OPPORTUNITY);
                    }
                }, 0) ?? 0
            );
        },
        calculateProfit(data) {
            return (
                data.reduce((acc, el) => {
                    if (el.STAGE_ID === "WON") {
                        return (acc = +el.PROFIT);
                    }
                }, 0) ?? 0
            );
        },
        calculateTotalIncome() {
            let sumOfIncome = 0;
            for (let key in this.leads) {
                sumOfIncome += this.calculateIncome(this.leads[key]);
            }
            return sumOfIncome;
        },
        calculateTotalProfit() {
            let sumOfProfit = 0;
            for (let key in this.leads) {
                sumOfProfit += this.calculateProfit(this.leads[key]);
            }
            return sumOfProfit;
        },
    },
};
</script>
<template>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Название канала</th>
                <th scope="col">Заявки</th>
                <th scope="col">Продажи</th>
                <th scope="col">Выручка</th>
                <th scope="col">Средний чек</th>
                <th scope="col">Прибыль</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(data, source) in leads">
                <th scope="row">{{ source }}</th>
                <td>{{ (length = data.length) }}</td>
                <td>
                    {{ calculateSales(data) }}
                </td>
                <td>{{ (income = calculateIncome(data)) }} ₽</td>
                <td>{{ income / length }} ₽</td>
                <td>{{ calculateProfit(data) }} ₽</td>
            </tr>
        </tbody>
        <tfoot>
            <th>Итого</th>
            <th>{{ calculateTotalBids() }}</th>
            <th>{{ (totalSales = calculateTotalSales()) }}</th>
            <th>{{ (totalIncome = calculateTotalIncome()) }} ₽</th>
            <th>{{ totalSales && parseInt(totalIncome / totalSales) }} ₽</th>
            <th>{{ calculateTotalProfit() }} ₽</th>
        </tfoot>
    </table>
</template>
