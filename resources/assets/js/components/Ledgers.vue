<template lang="html">
<div class="">

      <md-dialog :md-active.sync="active">
        <md-dialog-title>Preferences</md-dialog-title>

        <md-tabs md-dynamic-height>
          <md-tab md-label="Edit">
            <md-field>
             <label>Initial Value</label>
             <md-input v-model="selected.type"></md-input>
           </md-field>
           <md-field>
             <label>Initial Value</label>
             <md-input v-model="selected.name"></md-input>
           </md-field>
          </md-tab>
        </md-tabs>

        <md-dialog-actions>
          <md-button class="md-primary" @click="active = false">Close</md-button>
          <md-button class="md-primary" @click="active = false , updateledger() ">Save</md-button>
        </md-dialog-actions>
      </md-dialog>

  <md-card>
   <md-card-content>

     <div class="md-layout md-gutter md-alignment-center">
    <div class="md-layout-item md-medium-size-33 md-small-size-50 md-xsmall-size-100">
      <md-field>
      <label>Ledger</label>
      <md-input v-model="ledger.name" placeholder="Enter Ledger Name.."></md-input>
    </md-field>
  </div>
    <div class="md-layout-item md-medium-size-33 md-small-size-50 md-xsmall-size-100">
      <div class="md-layout-item">
           <md-field>
             <label for="country">Type</label>
             <md-select v-model="ledger.type" name="ledtype" id="ledtype" md-dense>
               <md-option value="Direct Expense">Direct Expense</md-option>
               <md-option value="Indirect Expense">Indirect Expense</md-option>
               <md-option value="Capital Accounts">Capital Accounts</md-option>
               <md-option value="Current Assets">Current Assets</md-option>
               <md-option value="Current Liabilities">Current Liabilities</md-option>
               <md-option value="Loans">Loans</md-option>
               <md-option value="Fixed Assets">Fixed Assets</md-option>
               <!-- <md-option value=""></md-option>
               <md-option value=""></md-option>
               <md-option value=""></md-option> -->
               <!-- <md-option value=""></md-option> -->
             </md-select>
           </md-field>
         </div>
    </div>
    <div class="md-layout-item md-medium-size-33 md-small-size-50 md-xsmall-size-100"><md-button class="md-raised md-primary" @click="createledger()">Add</md-button></div>
  </div>
   </md-card-content>

   <div>
      <md-card ref="table">
        <md-card-content>
          <div>
  <md-table v-model="ledgerarray" md-sort="name" md-sort-order="asc" md-card md-fixed-header @md-selected="onSelect" >
    <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="single">
      <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
      <md-table-cell md-label="Type" md-sort-by="type">{{ item.type }}</md-table-cell>
      <md-table-cell md-label="Name" md-sort-by="name" >{{ item.name }}</md-table-cell>
      <md-table-cell md-label="Created" md-sort-by="created_at" >{{ item.created_at }}</md-table-cell>
    </md-table-row>
  </md-table>
</div>
        </md-card-content>
      </md-card>
    </div>

 </md-card>

</div>
</template>

<script>
export default {
  mounted()
  {
      this.getledger();
  },
  data(){
      return {
        selected: [],
        active:false,
        ledger:{
        type:'',
        name:''
      },
      ledgerarray:[]
    }
      },
methods: {
createledger()
{
  axios.post('/ledger', {
  name:this.ledger.name,
  type:this.ledger.type
}).then(response => {
  this.getledger();
this.ledger.name= '';
this.ledger.type= '';
 })
},
getledger()
{
  axios.get('ledger').then(response => {
    this.ledgerarray = response.data.ledger  ;

   })
},
onSelect (item) {
this.selected = item;
this.active = true;
},
updateledger()
{
  axios.patch('/ledger/update'+ this.selected.id, {
    id:this.selected.id,
    name: this.selected.name,
    type: this.selected.type,
  })

}
}
}
</script>

<style lang="css" scoped>
.md-table-cell{
}
</style>
