<template lang="html">
<div class="Container">
  <md-tabs md-alignment="fixed">
    <md-tab id="tab-home" md-label="Assets" >

      <md-autocomplete v-model="Asset" :md-options="assetlist" md-dense>
        <label>Asset</label>
    </md-autocomplete>

    <md-autocomplete v-model="AssetType" :md-options="assettypelist" md-dense>
      <label>Type</label>
    </md-autocomplete>

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
    this.getAsset();
  },
  data: () => ({
    AssetType: null,
    Asset: null,
    amount:null,
    assettypelist:[
      'Current Assets',
       'Fixed Assets'
    ],
    assetlist:[]

}),
methods:{
  addAsset()
{
  var todaydate = moment().format('YYYY/MM/DD');
    axios.post('/asset', {
    type:'Assets',
    ledger: this.Asset,
    assettype:this.AssetType,
    amount:this.amount,
    date: todaydate,
  })
      .then(response => {
      this.Asset='';
      this.AssetType='';
      this.amount='';

      })
},
getAsset()
{
  axios.get('ledger/asset').then(response => {
  this.assetlist = response.data.asset  ;
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
