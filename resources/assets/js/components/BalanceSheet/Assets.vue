<template lang="html">
  <v-app>
<div class="Container">
  <md-tabs md-alignment="fixed">
    <md-tab id="tab-home" md-label="Assets" >
    <md-field>
    <label>Name:</label>
    <md-input v-model="Asset"></md-input>
    </md-field>

    <v-flex xs12 sm6 d-flex>
        <v-select
        v-model="AssetType"
          :items="type"
          label="Type"
        ></v-select>
      </v-flex>

        <md-field>
        <label>Amount:</label>
        <md-input v-model="amount" type="number"></md-input>
        </md-field>

        <md-button class="md-raised md-primary" @click="addAsset">Submit</md-button>
    </md-tab>

    <md-tab id="tab-Depriciation" md-label="Depriciation" >
      <Depriciation></Depriciation>
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
  },
  data: () => ({
    AssetType: null,
    Asset: null,
    amount:null,
    type: ['Current Assets', 'Fixed Asset'],
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
