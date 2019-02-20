<template>
  <v-container fluid>
    <v-layout row justify-center>
      <v-flex xs12 order-lg12 justify-center  >
        <v-card dark tile flat color="error">
          <v-card-text class="text-lg-center">
            Profit And Loss
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>

    <v-layout row id="profitloss">
      <v-flex xs6 order-lg2 style="border:1px solid black ; color:black">
        <v-card tile flat  >
          <v-card-text class="black--text">
            <div class="absolute"><p style="text-align:left;">Opening Stock:<span style="float:right;font-weight: bold"> {{opening}}</span></p></div>
            <div class="absolute"><p style="text-align:left;">Purchases:<span style="float:right;font-weight: bold"> {{Purchases}}</span></p></div>
            <div class="absolute"><p style="text-align:left;">Direct Expenses:<span style="float:right;font-weight: bold"> {{Direct}}</span></p></div>
            <div class="absolute"><p style="text-align:left;"> Gross Profit:<span style="float:right;font-weight: bold"> {{grossprofit}}</span></p></div>
            <br>
            <div class="absolute"><p style="text-align:left;">Inirect Expenses:<span style="float:right;font-weight: bold"> {{inDirect}}</span></p></div>
            <br>
            <div class="absolute"><p style="text-align:left;"> Net Profit:<span style="float:right;font-weight: bold"> {{netprofit}}</span></p></div>

          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs6 order-lg2 style="border:1px solid black ; color:black">
        <v-card  tile flat>
          <v-card-text class="black--text">
            <div class="absolute"><p style="text-align:left;">Closing Stock:<span style="float:right;font-weight: bold"> {{closing}}</span></p></div>
            <div class="absolute"><p style="text-align:left;">Sales:<span style="float:right;font-weight: bold"> {{Sales}}</span></p></div>

          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>

  </v-container>
</template>
<script>
export default
{
  mounted()
  {
    this.getdata();
  },
  data(){
      return {
        opening:'',
        closing:'',
        Sales:'',
        Direct:'',
        inDirect:'',
        grossprofit:'',
        netprofit:'',
        Purchases:''
      }
    },
    methods:{
      getdata()
      {
        this.opening = 1;
        this.closing = 1;
        this.Sales = 1;
        this.Direct = 1;
        this.inDirect = 1;
        this.Purchases = 1;
        this.grossprofit = 1;
        this.netprofit = 1;

      }
    }
  }
</script>
<style media="screen" scoped>
  #profitloss
  {
    /* height: 80vh !important; */
    background-color: white ;
  }
</style>
