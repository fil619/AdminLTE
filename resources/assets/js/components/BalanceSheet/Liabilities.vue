<template lang="html">
  <v-app>
<div class="Container">
  <md-tabs md-alignment="fixed">

    <md-tab id="tab-ledger" md-label="Ledger" >
        <md-field>
        <label>Liabilities Ledger:</label>
        <md-input v-model="ledgername"></md-input>
        </md-field>

        <v-select
        v-model="ledgertype"
       :items="liabilitytype"
       label="Type"
     ></v-select>

        <md-field>
        <label>Opening Amount:</label>
        <md-input v-model="openingamount" type="number"></md-input>
        </md-field>


        <md-button class="md-raised md-primary" @click="addLedger">Submit</md-button>
    </md-tab>


    <md-tab id="tab-home" md-label="Investment" >
      <v-autocomplete
        v-model="selectedcapital"
        :items="get_capital"
        persistent-hint
      >
        <v-slide-x-reverse-transition
          slot="append-outer"
          mode="out-in"
        >

        </v-slide-x-reverse-transition>
      </v-autocomplete>

        <md-field>
        <label>Amount:</label>
        <md-input v-model="amount" type="number"></md-input>
        </md-field>

        <v-select
        v-model="invwithdraw"
       :items="credit"
       label="Type"
     ></v-select>

        <md-button class="md-raised md-primary" @click="addCA">Submit</md-button>
    </md-tab>

    <md-tab id="tab-posts" md-label="Loans">

      <v-autocomplete
        v-model="selectedloan"
        :items="get_loan"
        persistent-hint
      >
        <v-slide-x-reverse-transition
          slot="append-outer"
          mode="out-in"
        >

        </v-slide-x-reverse-transition>
      </v-autocomplete>

        <md-field>
        <label>Amount:</label>
        <md-input v-model="loanamount" type="number"></md-input>
        </md-field>

        <v-select
        v-model="loanwithdraw"
       :items="loancredit"
       label="Type"
     ></v-select>

        <md-button class="md-raised md-primary" @click="addLoan">Submit</md-button>
    </md-tab>
  </md-tabs>
</div>
</v-app>
</template>

<script>
import moment from 'moment'

export default {
  mounted()
  {
      this.get_liaBILITIES();
  },
  data: () => ({
    ledger: null,
    amount: null,
    loanamount:null,
    narration: null,
    selectedcapital: null,
    selectedloan: null,

    invwithdraw: null,
    loanwithdraw: null,

    get_capital: null,
    get_loan: null,

    ledgername: null,
    ledgertype: null,
    openingamount:0,
    liabilitytype: ['Investment', 'Loan'],
    credit: ['Add', 'Withdraw'],
    loancredit: ['Add', 'Pay Installment']

}),
methods:{
  get_liaBILITIES()
  {
    axios.get('balancesheet/getcolumn')
        .then(response => {
          this.get_capital = response.data.capital;
          this.get_loan = response.data.Loan;
        });
  },
  addCA()
{
  var todaydate = moment().format('YYYY/MM/DD');
  axios.patch('/balancesheet/update', {
    investor: this.selectedcapital,
    amount: this.amount,
    type: this.invwithdraw,
  })
if (this.invwithdraw == 'Add')
{
  axios.post('/asset/addcash',{
    amount: this.amount,
  })
  .then(response => {
    this.selectedcapital='';
    this.amount='';
    this.invwithdraw='';
  })
}
else if (this.invwithdraw == 'Withdraw')
{
  axios.post('/asset/subcash',{
    amount: this.amount,
  })
  axios.post('/drawing',{
    type: 'Investment' ,
    from: this.selectedcapital,
    description: 'Drawings from '+this.selectedcapital ,
    amount: this.amount,
  })
  .then(response => {
    this.selectedcapital='';
    this.amount='';
    this.invwithdraw='';
    this.get_liaBILITIES();
      })
}
},
addLoan()
{
  var todaydate = moment().format('YYYY/MM/DD');
  axios.patch('/balancesheet/update', {
    investor: this.selectedloan,
    amount: this.loanamount,
    type: this.loanwithdraw,
  })
if (this.loanwithdraw == 'Add')
{
  axios.post('/asset/addcash',{
    amount: this.loanamount,
  })
  .then(response => {
    this.selectedloan='';
    this.loanamount='';
    this.loanwithdraw='';
  })
}
else if (this.loanwithdraw == 'Pay Installment')
{
  axios.post('/asset/subcash',{
    amount: this.loanamount,
  })
  axios.post('/drawing',{
    type: 'Loan' ,
    from: this.selectedloan,
    description:this.selectedloan+': Installment Paid on '+todaydate,
    amount: this.loanamount,
  })
  .then(response => {
    this.selectedcapital='';
    this.amount='';
    this.invwithdraw='';
    this.get_liaBILITIES();
      })
}

},
addLedger()
{
  axios.post('/ledger', {
  name:this.ledgername,
  type:this.ledgertype,
}).then(response => {
if(this.ledgertype== 'Investment')
{
  var todaydate = moment().format('YYYY/MM/DD');
    axios.post('/balancesheet', {
    type:this.ledgertype,
    ledger: this.ledgername,
    amount:this.openingamount,
    date: todaydate,
  })
      axios.post('/asset/addcash',{
        amount: this.openingamount,
      })
          .then(response => {
            this.ledgername='';
            this.ledgertype='';
            this.openingamount=0;
          })
          this.get_liaBILITIES();
}
else if (this.ledgertype== 'Loan')
  {
  var todaydate = moment().format('YYYY/MM/DD');
    axios.post('/balancesheet', {
    type:this.ledgertype,
    ledger: this.ledgername,
    amount:this.openingamount,
    date: todaydate,
  })
      axios.post('/asset/addcash',{
        amount: this.openingamount,
      })
          .then(response => {
            this.ledgername='';
            this.ledgertype='';
            this.openingamount=0;
            this.get_liaBILITIES();
          })
}
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
