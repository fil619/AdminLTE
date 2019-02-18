<template>
    <div class="container-fluid">
<br>
<md-card>
   <md-card-header>
   <div class="md-title" style="">ADD DIRECT EXPENSE</div>
</md-card-header>

<md-card-content>
<md-autocomplete v-model="selectedledger" :md-options="ledgers" md-dense>
  <label>Type</label>

  <template slot="md-autocomplete-item" slot-scope="{ item, term }">
    <md-highlight-text :md-term="term">{{ item }}</md-highlight-text>
  </template>

  <template slot="md-autocomplete-empty" slot-scope="{ term }">
    No Ledgers matching "{{ term }}" were found. <a @click="noop()">Create a new</a> one!
  </template>
</md-autocomplete>
<md-field>
   <label>Amount</label>
   <md-input v-model="amount" type="number"></md-input>
   <md-icon>attach_money</md-icon>
 </md-field>

<md-datepicker v-model="selectedDate" md-immediately />

<md-field>
    <label>Narration</label>
    <md-textarea v-model="narration"></md-textarea>
  </md-field>

</md-card-content>
         <md-card-actions>
           <md-button class="md-raised md-primary" @click="reset" >Clear</md-button>
           <md-button class="md-raised md-primary" @click="add" >Submit</md-button>
         </md-card-actions>
       </md-card>

<div class="Disp">
  <!-- <DisplayExpenses></DisplayExpenses> -->
</div>

    </div>
</template>

<script>
import moment from 'moment'
  export default {
    data: () => ({
      selectedledger: null,
      amount:null,
      selectedDate:null,
      narration:null,
      ledgers: []
    }),
    mounted()
    {
        this.getdirectledger();
    },
    methods: {
      noop () {
        window.alert('noop')
      },
      add()
      {
        this.selectedDate = moment(this.selectedDate).format('YYYY/MM/DD');
          axios.post('/setexpense', {
          type:'Direct',
          ledger:this.selectedledger,
          amount: this.amount,
          date: this.selectedDate,
          narration: this.narration,
        })
            .then(response => {
            })

      },
      reset(){
        this.selectedledger = '';
        this.amount = '';
        this.selectedDate = null;
        this.narration = '';
      },
      getdirectledger()
      {
        axios.get('ledger/direct').then(response => {
        this.ledgers = response.data.ledger  ;
         })
      }
    }
  }
</script>

<style lang="scss" scoped>
@import "~vue-material/dist/theme/engine.scss";

  .md-autocomplete + strong {
    margin-top: 36px;
    display: block;
  }
  .container-fluid
  {
flex: auto;
float: left;
  }
</style>
