<template lang="html">
<div class="Container">
  <md-tabs md-alignment="fixed">
    <md-tab id="tab-home" md-label="Capital Account" >
      <md-autocomplete v-model="selectedcapital" :md-options="capitallist" md-dense>
        <label>Capital Account</label>
    </md-autocomplete>
        <md-field>
        <label>Amount:</label>
        <md-input v-model="amount" type="number"></md-input>
        </md-field>
        <md-button class="md-raised md-primary" @click="addCA">Submit</md-button>
    </md-tab>
    <md-tab id="tab-pages" md-label="Liabilities">
      <md-autocomplete v-model="selectedliability" :md-options="liablist" md-dense>
        <label>Liabilities</label>
    </md-autocomplete>
        <md-field>
        <label>Amount:</label>
        <md-input v-model="liabamount" type="number"></md-input>
        </md-field>
        <md-button class="md-raised md-primary" @click="addLi">Submit</md-button>

    </md-tab>
    <md-tab id="tab-posts" md-label="Loans">
      <md-autocomplete v-model="selectedloan" :md-options="loan" md-dense>
        <label>Liabilities</label>
    </md-autocomplete>
        <md-field>
        <label>Amount:</label>
        <md-input v-model="loanamount" type="number"></md-input>
        </md-field>
        <md-button class="md-raised md-primary" @click="addLoan">Submit</md-button>
    </md-tab>
  </md-tabs>
</div>
</template>

<script>
import moment from 'moment'

export default {
  mounted()
  {
    this.getcapacc();
  },
  data: () => ({
    ledger: null,
    amount: null,
    liabamount:null,
    loanamount:null,
    narration: null,
    selectedcapital: null,
    selectedliability: null,
    selectedloan: null,
    capitallist:[],
    liablist:[],
    loan:[]

}),
methods:{
  addCA()
{
  var todaydate = moment().format('YYYY/MM/DD');
    axios.post('/balancesheet', {
    type:'Capital Accounts',
    ledger: this.selectedcapital,
    amount:this.amount,
    date: todaydate,
  })
      .then(response => {
      this.selectedcapital='';
      this.amount='';

      })
},
addLi()
{
var todaydate = moment().format('YYYY/MM/DD');
  axios.post('/balancesheet', {
  type:'Current Liabilities',
  ledger: this.selectedliability,
  amount:this.liabamount,
  date: todaydate,
})
    .then(response => {
    this.selectedliability='';
    this.liabamount='';

    })
},
addLoan()
{
var todaydate = moment().format('YYYY/MM/DD');
  axios.post('/balancesheet', {
  type:'Loans',
  ledger: this.selectedloan,
  amount:this.loanamount,
  date: todaydate,
})
    .then(response => {
    this.selectedloan='';
    this.loanamount='';

    })
},
getcapacc()
{
  axios.get('ledger/capital').then(response => {
  this.capitallist = response.data.capital  ;
   })

   axios.get('ledger/liab').then(response => {
     this.liablist = response.data.liablity  ;
     this.loan = response.data.loan  ;
    })

}
}
}
</script>

<style lang="css" scoped>
.md-autocomplete + strong {
  margin-top: 36px;
  display: block;
}
</style>
