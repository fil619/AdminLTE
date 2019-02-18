<template lang="html">
  <div class="container">
    <br>
    <div class="row">
      <div class="col-md-6">

        <table class="table table-condensed">
          <tbody>
            <tr >
              <th colspan="2" style="text-align: center;">Liabilities as at {{date.year}}-{{date.month+1}}-{{date.day}}</th>
            </tr>
            <tr id='start'>
              <th @click="togglediv" >Capital Account</th>
              <td>{{liabilities.capital}}</td>
            </tr>
            <tr>
              <div id="myDIV" style="display:none">
                <ul v-for="(capital , index ) in capital">
                  <li>{{capital.ledger}} - {{capital.amount}}</li>
                </ul>
              </div>
            </tr>
            <tr>
              <th @click="toggleloan">Loan</th>
              <td>{{liabilities.Loan}}</td>
            </tr>
            <tr>
              <div id="loandiv" style="display:none">
                <ul v-for="(loan , index ) in loan">
                  <li>{{loan.ledger}} - {{loan.amount}}</li>
                </ul>
              </div>
            </tr>
            <tr>
              <th @click="toggleCur" >Current Liabilities</th>
              <td>{{liabilities.Current}}</td>
            </tr>
            <tr>
              <div id="curdiv" style="display:none">
                <ul v-for="(current , index ) in current">
                  <li>{{current.ledger}} - {{current.amount}}</li>
                </ul>
              </div>
            </tr>
          </tbody>
        </table>
        <div class="absolute"><p style="text-align:left;">Total:<span style="float:right;font-weight: bold"> {{liabilities.Liabilities}}</span></p></div>
      </div>
      <div class="col-md-6">


        <table class="table table-condensed">
          <tbody>
            <tr >
              <th colspan="2" style="text-align: center;">Assets as at {{date.year}}-{{date.month+1}}-{{date.day}}</th>
            </tr>
            <tr id='start'>
              <th @click="togglecurrentassets" >Current Assets</th>
              <td>{{Assets.current}}</td>
            </tr>
            <tr>
              <div id="c_assets" style="display:none">
                <ul v-for="(currentassets , index ) in currentassets">
                  <li>{{currentassets.ledger}} - {{currentassets.amount}}</li>
                </ul>
              </div>
            </tr>
            <tr>
              <th @click="togglefixedassets">Fixed Assets</th>
              <td>{{Assets.fixed}}</td>
            </tr>
            <tr>
              <div id="f_assets" style="display:none">
                <ul v-for="(fixedassets , index ) in fixedassets">
                  <li>{{fixedassets.ledger}} - {{fixedassets.amount}}</li>
                </ul>
              </div>
            </tr>
          </tbody>
        </table>
        <div class="absolute"><p style="text-align:left;">Total:<span style="float:right;font-weight: bold"> {{Assets.assets}}</span></p></div>
      </div>
    </div>

  </div>
</template>

<script>
export default
{
  data(){
      return {
          liabilities: {
            Liabilities:'',
            capital:'',
            Loan:'',
            Current:''
          },
          Assets: {
            assets:'',
            current:'',
            fixed:''
          },
          capital: {
          name:'',
          amount:''
          },
          loan: {
          name:'',
          amount:''
          },
          current: {
          name:'',
          amount:''
          },
          date:{
            year:'',
            month:'',
            day:'',
          },
          fixedassets: {},
          currentassets: {}
      }
  },
  mounted()
  {
      this.getliabilities();
      this.assetssum();
      this.liabdetail();
      this.assets();

      var day = new Date();
      this.date.year = day.getFullYear();
      this.date.month = day.getMonth();
      this.date.day = day.getDate();
  },
    computed:
    {



    },
  methods:
  {
    liabdetail()
    {
      axios.get('balancesheet/getdetails')
          .then(response => {
            this.capital = response.data.capital;
            this.loan = response.data.Loan;
            this.current = response.data.Current;
          });
    },
    getliabilities()
    {
      axios.get('/balancesheet/getliabsum')
          .then(response => {
              this.liabilities = response.data;
          });
    },
    assets()
    {
      axios.get('/asset')
      .then(response => {
        this.fixedassets = response.data.Fixed;
        this.currentassets = response.data.Current;
      });

    },
    assetssum()
    {
      axios.get('/asset/sum')
          .then(response => {
              this.Assets = response.data;
          });
    },
    togglediv()
    {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";

        }
    },
    toggleloan()
    {
        var x = document.getElementById("loandiv");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";

        }
    },
    toggleCur()
    {
        var x = document.getElementById("curdiv");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";

        }
    },
    togglecurrentassets()
    {
        var x = document.getElementById("c_assets");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";

        }
    },
    togglefixedassets()
    {
        var x = document.getElementById("f_assets");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";

        }
    }
  }
}
</script>

<style lang="css" scoped>
.col-md-6
{
  height: 80vh;
  border: 2px solid black;
}
tr
{
  font-size: 15px;
  color:black;
}
div.absolute {
  position: absolute;
  width: 95%;
  bottom: 0px;
  border-top:  1px solid black;
  font-size: 25px;
  color:black;
}
th:hover
{
  cursor: pointer;
}
li{
  font-size: 12px;

}
</style>
