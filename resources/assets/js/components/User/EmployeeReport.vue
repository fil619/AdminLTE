<template>
<v-app>
  <div style="padding-top:10px">
 <div class="headline font-weight-black" style="color:#B71C1C">
 <i class="fas fa-calendar-alt" ></i> Generate Report
</div>
  <v-divider></v-divider>
  <v-form v-model="valid" ref="form" lazy-validation >
    <v-container fluid style="background-color:#FFEBEE">
        <v-layout row wrap>
          <v-flex xs12 sm6 md3>
                <v-select
                label="Select"
                :rules="[  v => !!v || 'Select an Employee']"
                v-bind:items="staff"
                v-model="employee"
                item-text="`${data.item.name}  ${data.item.group}`"
                item-value="employee_id"
                autofocus
                >
                <template slot="selection" slot-scope="data">
                  {{ data.item.first_name}} {{data.item.last_name}}
                </template>
                <template slot="item" slot-scope="data">
                    <v-list-tile-content>
                      <v-list-tile-title v-html="`${data.item.first_name} ${data.item.last_name}`">
                      </v-list-tile-title>
                      <v-list-tile-sub-title v-html="data.item.type"></v-list-tile-sub-title>
                    </v-list-tile-content>
                  </template>
                </v-select>
          </v-flex>
          <v-flex xs12 sm6 md3 >
                <v-text-field
                  v-model="startdate"
                  label="Start Date"
                  type="date"
                  required
                ></v-text-field>
          </v-flex>
          <v-flex xs12 sm6 md3 >
                <v-text-field
                  v-model="enddate"
                  label="End Date"
                  type="date"
                  required
                ></v-text-field>
          </v-flex>
          <v-flex xs12 sm6 md3>
                <v-btn
                  color="success"
                  @click="generate"
                >
                  Generate
                </v-btn>
          </v-flex>
        </v-layout>
      </v-container>
    </v-form>

    <!-- <v-container grid-list-md text-xs-center> -->
      <v-layout row wrap justify-center style="padding-top:10px">
        <v-flex sm6 md6>
          <div class="text-xs-center">
            <strong style="color:#c62828" class="subheading font-weight-bold">Report Of:</strong >
              <strong class="subheading font-weight-bold"> {{getName}}</strong>
          </div>
        </v-flex>
        <v-flex sm6 md6>
          <!-- <div class="text-xs-center"> -->
          <strong style="color:#c62828" class="subheading font-weight-bold">For:</strong >
            <strong class="subheading font-weight-bold" v-if="enddate && onlystart"> {{startdate}}  <i class="fas fa-long-arrow-alt-right" ></i> {{enddate}}</strong>
          <strong class="subheading font-weight-bold" v-else> {{startdate}}</strong>
          <!-- </div> -->
        </v-flex>
      </v-layout>
    <!-- </v-container> -->

    <v-container style="overflow-x:auto;">
      <v-layout justify-center align-start>

        <table v-if="report">
        <tr>
          <th style="background-color:#c62828">No.</th>
          <th style="background-color:#c62828">Work Done</th>
          <th style="background-color:#c62828">Bill No.</th>
          <th style="background-color:#c62828">Vehicle No.</th>
          <th style="background-color:#c62828">Date</th>
          <th style="background-color:#c62828">Amount</th>
        </tr>

        <tr  v-for="(report , index ) in report">
          <td>{{index}}</td>
          <td>{{report.servicedetails}}</td>
          <td>{{report.billno}}</td>
          <td>{{report.servicecharge}}</td>
          <td>{{report.date}}</td>
          <td>{{report.servicecharge}}</td>
        </tr>
        <tr v-if="report">
          <th colspan="4"></th>
          <th>Earned:</th>
          <th>{{earned}}</th>
        </tr>
        <tr>
          <th style="background-color:#26C6DA">No.</th>
          <th style="background-color:#26C6DA"  colspan="3">Advance Taken For</th>
          <th style="background-color:#26C6DA">Date</th>
          <th style="background-color:#26C6DA">Amount</th>
        </tr>

        <tr  v-for="(advancereport , index ) in advancereport" align="right">
          <td>{{index}}</td>
          <td colspan="3">{{advancereport.reason}}</td>
          <td>{{advancereport.date}}</td>
          <td>{{advancereport.amount}}</td>
        </tr>
        <tr v-if="report">
          <th colspan="4"></th>
          <th>To be Deducted:</th>
          <th>{{deducted}}</th>
        </tr>
        <tr v-if="report">
          <th colspan="4" style="background-color:#B2FF59"></th>
          <th style="background-color:#B2FF59">Payable:</th>
          <th style="background-color:#B2FF59">{{total}}</th>
        </tr>
      </table>
    </v-layout>
  </v-container>
</div>
</v-app>
</template>

<script>
export default {
  mounted()
  {
    this.getstaff();
  },
  computed:
{
  getName()
  {
for (var i = 0; i < this.staff.length; i++)
{
if ( this.employee == this.staff[i].employee_id)
{
return this.staff[i].first_name +' '+ this.staff[i].last_name;
}
    }
  },
  earned()
  {
    var sum = 0;
    for (var i = 0; i < this.report.length; i++) {
      sum = sum + this.report[i].servicecharge;
    }
    this.income = sum;
    return sum;
  },
  deducted()
  {
    var sum = 0;
    for (var i = 0; i < this.advancereport.length; i++) {
      sum = sum + this.advancereport[i].amount;
    }
    this.advance = sum;
    return sum;
  },
  total()
  {
  var to
    return this.income - this.advance;
  }
},
  data(){
      return {
employee:'',
startdate:new Date().toISOString().substr(0, 10),
enddate:'',
income:'',
onlystart:'',
advance:'',
report:'',
advancereport:'',
valid:true,
staff:[]
      }
  },
  methods:
  {
    generate () {
      if (this.$refs.form.validate()) {
        this.onlystart = true;
        if(!this.enddate)
        {
          this.enddate = this.startdate;
          this.onlystart = false;
        }
        axios.get('/repair/empreport',{
          params: {
                employee_id:this.employee,
                startdate:this.startdate,
                enddate:this.enddate,
                   }
        }).then(response => {
          this.report = response.data  ;
         })


           axios.get('/advance/report',{
             params: {
                   employee_id:this.employee,
                   startdate:this.startdate,
                   enddate:this.enddate,
                      }
           }).then(response => {
             this.advancereport = response.data  ;
             console.log(this.advancereport);
            })

      }
    },
    getstaff()
    {
      axios.get('/employee/staff').then(response => {
        this.staff = response.data  ;
       })
    }
  }
}
</script>

<style lang="css" scoped>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>
