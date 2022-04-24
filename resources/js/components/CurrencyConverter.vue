<template>
    <div class="flex flex-col m-auto shadow-lg p-8 lg:p-20 rounded-md gap-8 bg-white">
        <h1 class="text-sky-900 font-bold text-xl">Krypto valiutos konverteris</h1>
        <div class="flex gap-8 flex-col lg:flex-row">
            <div class="flex flex-col w-full">
                <label class="text-sm text-black font-bold mb-1">Pasirinkite valiutą</label>
                <select class="" v-model="fields.currency" class="h-10 drop-shadow-xl border border-slate-200 rounded px-4 focus:outline-none focus:border-sky-500">
                    <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
                </select>
            </div>
            <div class="flex flex-col w-full">
                <label class="text-sm text-black font-bold mb-1">Įveskite sumą</label>
                <input type="number" min="1" v-model="fields.amount" class="h-10 border border-slate-200 rounded drop-shadow-xl px-4 focus:outline-none focus:border-sky-500">
            </div>
            <div class="flex flex-col w-full">
                <label class="text-sm text-black font-bold mb-1">Įveskite kripto valiutą</label>
                <input type="text" v-model="fields.crypto" class="h-10 border border-slate-200 rounded drop-shadow-xl px-4 focus:outline-none focus:border-sky-500">
            </div>
        </div>
        <div class="flex">
            <div class="flex flex-col">
                <p class="text-neutral-600">{{ fields.amount }} {{ fields.currency }} =</p>
                <p class="text-sky-900 font-bold text-xl" v-if="fields.result">{{ fields.result }} {{ fields.crypto }}</p>
            </div>
            <button class="rounded-md bg-green-300 hover:bg-green-400 drop-shadow-xl hover:transition-all py-2 px-4 text-white w-fit ml-auto mr-0" v-on:click="getResults">Convert</button>
        </div>        
    </div>
</template>
<script>
    export default {
        data() {
            return {
                currencies: ['EUR', 'USD', 'PLN'],
                fields: {
                    result: null,
                    currency: 'EUR',
                    crypto: '',
                    amount: 1
                }
            }
        },
        watch: {
            /*amount(value) { this.getResults(); },
            crypto(value) { this.crypto = this.getResults(); },
            currency(value) { this.getResults(); }*/
        },
        methods: {
            getResults() {
                axios.get('https://api.exchangerate.host/convert?from=' + this.fields.currency + '&to=' + this.fields.crypto + '&amount=' + this.fields.amount + '&source=crypto')
                .then(response => { this.fields.result = response.data.result, this.insertQuery() });
            },
            insertQuery() {
                axios.post('api/currency', this.fields)
                .then(response => { this.$router.push('/') });
            }
            
            
        }
    } 
</script>