<template>
    <div class="container-fluid">
<br>
<md-card>
   <md-card-header>
   <div class="md-title" style="">ADD INDIRECT EXPENSE</div>
</md-card-header>

<md-card-content>
  <v-autocomplete
    v-model="selectedledger"
    :items="ledgers"
    persistent-hint
  >
    <v-slide-x-reverse-transition
      slot="append-outer"
      mode="out-in"
    >

    </v-slide-x-reverse-transition>
  </v-autocomplete>

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
    mounted()
    {
        this.getindirectledger();
    },
    data: () => ({
      selectedledger: null,
      amount:null,
      selectedDate:null,
      narration:null,
      ledgers: []
    }),
    methods: {
      noop () {
        window.alert('noop')
      },
      add()
      {
        this.selectedDate = moment(this.selectedDate).format('YYYY/MM/DD');
          axios.post('/setexpense', {
          type:'Indirect',
          ledger:this.selectedledger,
          amount: this.amount,
          date: this.selectedDate,
          narration: this.narration,
        })
            .then(response => {
                console.log(response.data);
            })
            // .catch(error => {
            //     this.errors = [];
            //     if (error.response.data.errors.title) {
            //         this.errors.push(error.response.data.errors.title[0]);
            //     }
            //
            //     if (error.response.data.errors.description) {
            //         this.errors.push(error.response.data.errors.description[0]);
            //     }
            // });
      },
      reset(){
        this.selectedledger = '';
        this.amount = '';
        this.selectedDate = null;
        this.narration = '';
      },
      getindirectledger()
      {
        axios.get('ledger/indirect').then(response => {
        this.ledgers = response.data.ledger  ;
         })
      }
    }
  }
</script>

<style lang="scss">
@import "~vue-material/dist/theme/engine.scss";
.v-menu__content
{
  top:30px !important;
  left:0px !important;
}
</style>
