<template>
  <v-container grid-list-xl>
    <v-layout
      flex-child
      wrap
    >
      <v-flex
        xs12
        md6
        d-flex
      >
        <v-sheet
          class="d-flex"
          color="grey lighten-3"
          height="585"
        >
        <v-layout row wrap>
        <v-flex xs12 sm12>
             <v-text-field
               v-model="displayasset.ledger"
               label="Asset"
               outline
               disabled
             ></v-text-field>
           </v-flex>
           <v-flex xs12 sm12>
                <v-text-field
                  v-model="displayasset.amount"
                  label="Amount"
                  outline
                  disabled
                ></v-text-field>
              </v-flex>
              </v-layout>
              <v-layout row wrap>
            <v-flex xs12 sm6 md6>
             <v-text-field
               label="%"
               outline
             ></v-text-field>
           </v-flex>

         <v-flex xs12 sm6 md6>
           <v-text-field
             label="Depriciation Amount"
             outline
           ></v-text-field>
         </v-flex>
       </v-layout>
        </v-sheet>
      </v-flex>

      <v-flex
        xs12
        md6
      >
      <v-sheet


        <v-sheet
          class="d-flex"
          color="teal lighten-3"
        >
        <v-data-table
          :rows-per-page-items = [10]
           :headers="headers"
           :items="fixedassets"
           class="elevation-1"
         >

           <template slot="items" slot-scope="props" >
             <td class="text-xs-center" @click="assetselected(props.item)" onmouseover="this.style.cursor='pointer'">{{ props.item.ledger }}</td>
             <td class="text-xs-center" @click="assetselected(props.item)" onmouseover="this.style.cursor='pointer'">{{ props.item.amount }}</td>
           </template>
         </v-data-table>

        </v-sheet>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  mounted(){
    this.assets();
  },
  data(){
      return {
        fixedassets: [],
        displayasset: [],
        headers: [
          {
            text: 'Fixed Asset',
            align: 'center',
            sortable: true,
            value: 'ledger'
          },
          {
            text: 'Amount',
            align: 'center',
            sortable: true,
            value: 'amount'
          },
        ]
      }
    },
    methods:{
    assets()
    {
      axios.get('/asset')
      .then(response => {
        let assetsarray = Object.keys(response.data.Fixed).map((key) => {
         return response.data.Fixed[key]
       })
       this.fixedassets = assetsarray;
      });
    },
    assetselected(asset)
    {
      this.displayasset = asset;
    }
    }
}
</script>

<style lang="css">
.theme--light.v-input--is-disabled .v-label, input, .v-input--is-disabled textarea {
    color: black !important;
}
</style>
