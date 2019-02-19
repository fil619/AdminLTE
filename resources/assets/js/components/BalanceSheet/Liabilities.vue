<template lang="html">
<div class="Container">
  <md-tabs md-alignment="fixed">
    <md-tab id="tab-home" md-label="Investment" >
        <md-field>
        <label>Name:</label>
        <md-input v-model="selectedcapital"></md-input>
        </md-field>

        <md-field>
        <label>Amount:</label>
        <md-input v-model="amount" type="number"></md-input>
        </md-field>
        <md-button class="md-raised md-primary" @click="addCA">Submit</md-button>
    </md-tab>

    <md-tab id="tab-posts" md-label="Loans">

    <md-field>
    <label>Name:</label>
    <md-input v-model="selectedloan"></md-input>
    </md-field>

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
  },
  data: () => ({
    ledger: null,
    amount: null,
    loanamount:null,
    narration: null,
    selectedcapital: null,
    selectedloan: null

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


      })

      axios.post('/asset/addcash',{
        amount: this.amount,
      })
          .then(response => {
            this.selectedcapital='';
            this.amount='';
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
    })
    axios.post('/asset/addcash',{
      amount: this.loanamount,
    })
        .then(response => {
          this.selectedcapital='';
          this.loanamount='';
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
