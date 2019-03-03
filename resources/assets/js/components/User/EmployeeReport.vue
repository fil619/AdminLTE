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

    <v-container grid-list-md text-xs-center>
      <v-layout row wrap>
        <v-flex sm6 md6>
          <strong style="color:#c62828" class="subheading font-weight-bold">Report Of:</strong >
          <strong class="subheading font-weight-bold"> {{getName}}</strong>
        </v-flex>
        <v-flex sm6 md6>
          <strong style="color:#c62828" class="subheading font-weight-bold">For:</strong >
            <strong class="subheading font-weight-bold" v-if="enddate"> {{startdate}} to {{enddate}}</strong>
          <strong class="subheading font-weight-bold" v-else> {{startdate}}</strong>

        </v-flex>
      </v-layout>
    </v-container>

    <v-container style="overflow-x:auto;">
      <v-layout justify-center align-start>

        <table>
        <tr>
          <th style="background-color:#c62828">No.</th>
          <th style="background-color:#c62828">Work Done</th>
          <th style="background-color:#c62828">Bill No.</th>
          <th style="background-color:#c62828">Vehicle No.</th>
          <th style="background-color:#c62828">Date</th>
          <th style="background-color:#c62828">Amount</th>
        </tr>

        <tr>
          <td>Jill</td>
          <td>Smith</td>
          <td>50</td>
          <td>50</td>
          <td>50</td>
          <td>50</td>
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
  computed: {
            getName()
            {
for (var i = 0; i < this.staff.length; i++)
{
if ( this.employee == this.staff[i].employee_id)
{
  return this.staff[i].first_name +' '+ this.staff[i].last_name;
}
              }
            }
        },
  data(){
      return {

employee:'',
startdate:new Date().toISOString().substr(0, 10),
enddate:'',
valid:true,
staff:[]
      }
  },
  methods:
  {
    generate () {
      if (this.$refs.form.validate()) {
        console.log(this.employee);
        console.log(this.startdate);
        console.log(this.enddate);
        this.$refs.form.reset();
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
