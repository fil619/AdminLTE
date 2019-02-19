<template lang="html">
<div class="Container">
  <md-tabs md-alignment="fixed">
    <md-tab id="tab-home" md-label="Assets" >
    <md-field>
    <label>Name:</label>
    <md-input v-model="Asset"></md-input>
    </md-field>
        <md-field>
        <label>Amount:</label>
        <md-input v-model="amount" type="number"></md-input>
        </md-field>

        <md-button class="md-raised md-primary" @click="addAsset">Submit</md-button>
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
    AssetType: null,
    Asset: null,
    amount:null,
    assetlist:[]

}),
methods:{
  addAsset()
{
  var todaydate = moment().format('YYYY/MM/DD');
    axios.post('/asset', {
    type:'Assets',
    ledger: this.Asset,
    assettype:'Current Assets' ,
    amount:this.amount,
  })
      .then(response => {
      // this.Asset='';
      // this.AssetType='';
      // this.amount='';
      })

      axios.post('/asset/subcash',{
        amount: this.amount,
      })
          .then(response => {
            this.Asset='';
            this.AssetType='';
            this.amount='';
          })
},
}
}
</script>

<style lang="css" scoped>
.md-autocomplete + strong {
  margin-top: 36px;
  display: block;
}
</style>
